<?php
// app/Services/GreedySchedulingService.php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use App\Models\PesertaJadwal;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalKeberangkatan;
use Illuminate\Support\Facades\Log;

class GreedySchedulingService
{
     /**
      * Algoritma Greedy untuk penjadwalan peserta
      * Kriteria prioritas:
      * 1. Tanggal pendaftaran (lebih awal = prioritas tinggi)
      * 2. Usia (lebih muda = prioritas tinggi untuk program Jepang)
      * 3. Pendidikan (lebih tinggi = prioritas tinggi)
      * 4. Status verifikasi dokumen lengkap
      */
     public function scheduleParticipants()
     {
          try {
               DB::beginTransaction();

               // Ambil semua peserta yang terverifikasi tapi belum dijadwalkan
               $pesertaTerverifikasi = Pendaftaran::with('user', 'dokumen')
                    ->where('status', 'terverifikasi')
                    ->get();

               if ($pesertaTerverifikasi->isEmpty()) {
                    DB::rollBack();
                    return [
                         'terjadwalkan' => 0,
                         'gagal' => 0,
                         'detail' => [],
                         'message' => 'Tidak ada peserta yang terverifikasi untuk dijadwalkan.'
                    ];
               }

               // Hitung prioritas untuk setiap peserta dan simpan dalam array
               $pesertaDenganPrioritas = [];
               foreach ($pesertaTerverifikasi as $pendaftaran) {
                    $prioritas = $this->hitungPrioritas($pendaftaran);
                    $pesertaDenganPrioritas[] = [
                         'pendaftaran' => $pendaftaran,
                         'prioritas' => $prioritas
                    ];
               }

               // Urutkan berdasarkan prioritas (descending - prioritas tinggi duluan)
               usort($pesertaDenganPrioritas, function ($a, $b) {
                    return $b['prioritas'] <=> $a['prioritas'];
               });

               // Ambil jadwal yang tersedia (masih bisa diisi)
               $jadwalTersedia = JadwalKeberangkatan::where('status', 'aktif')
                    ->whereRaw('terisi < kapasitas')
                    ->orderBy('tanggal_keberangkatan')
                    ->get();

               if ($jadwalTersedia->isEmpty()) {
                    DB::rollBack();
                    return [
                         'terjadwalkan' => 0,
                         'gagal' => $pesertaTerverifikasi->count(),
                         'detail' => [],
                         'message' => 'Tidak ada jadwal yang tersedia untuk penjadwalan.'
                    ];
               }

               $hasil = [
                    'terjadwalkan' => 0,
                    'gagal' => 0,
                    'detail' => []
               ];

               foreach ($pesertaDenganPrioritas as $item) {
                    $pendaftaran = $item['pendaftaran'];
                    $prioritas = $item['prioritas'];
                    $berhasilDijadwalkan = false;

                    foreach ($jadwalTersedia as $jadwal) {
                         if ($jadwal->sisaKapasitas() > 0) {
                              // Jadwalkan peserta ke batch ini
                              PesertaJadwal::create([
                                   'pendaftaran_id' => $pendaftaran->id,
                                   'jadwal_id' => $jadwal->id,
                                   'tanggal_dijadwalkan' => now(),
                                   'dijadwalkan_oleh' => auth()->id()
                              ]);

                              // Update status pendaftaran
                              $pendaftaran->update([
                                   'status' => 'terjadwal',
                                   'prioritas' => $prioritas
                              ]);

                              // Update jumlah terisi di jadwal
                              $jadwal->increment('terisi');

                              // Update status jadwal jika penuh
                              if ($jadwal->terisi >= $jadwal->kapasitas) {
                                   $jadwal->update(['status' => 'penuh']);
                              }

                              $hasil['terjadwalkan']++;
                              $hasil['detail'][] = [
                                   'peserta' => $pendaftaran->user->nama,
                                   'nomor_pendaftaran' => $pendaftaran->nomor_pendaftaran,
                                   'jadwal' => $jadwal->nama_batch,
                                   'tanggal_keberangkatan' => $jadwal->tanggal_keberangkatan,
                                   'prioritas' => $prioritas
                              ];

                              $berhasilDijadwalkan = true;
                              break;
                         }
                    }

                    if (!$berhasilDijadwalkan) {
                         $hasil['gagal']++;
                    }
               }

               DB::commit();
               return $hasil;
          } catch (\Exception $e) {
               DB::rollBack();
               Log::error('Error in scheduleParticipants: ' . $e->getMessage());
               throw $e;
          }
     }

     /**
      * Hitung prioritas peserta berdasarkan kriteria greedy
      */
     private function hitungPrioritas(Pendaftaran $pendaftaran)
     {
          $prioritas = 0;

          // 1. Prioritas berdasarkan tanggal pendaftaran (40% dari total)
          $hariSejakPendaftaran = $pendaftaran->created_at->diffInDays(now());
          $prioritasTanggal = max(0, 100 - $hariSejakPendaftaran); // Semakin lama semakin berkurang
          $prioritas += $prioritasTanggal * 0.4;

          // 2. Prioritas berdasarkan usia (30% dari total)
          if ($pendaftaran->user->tanggal_lahir) {
               $usia = $pendaftaran->user->tanggal_lahir->age;
               // Usia ideal 18-30 tahun untuk program Jepang
               if ($usia >= 18 && $usia <= 25) {
                    $prioritasUsia = 100;
               } elseif ($usia >= 26 && $usia <= 30) {
                    $prioritasUsia = 80;
               } elseif ($usia >= 31 && $usia <= 35) {
                    $prioritasUsia = 60;
               } else {
                    $prioritasUsia = 40;
               }
               $prioritas += $prioritasUsia * 0.3;
          }

          // 3. Prioritas berdasarkan pendidikan (20% dari total)
          $pendidikan = $pendaftaran->user->pendidikan_terakhir;
          $prioritasPendidikan = match ($pendidikan) {
               'S2' => 100,
               'S1' => 90,
               'D3' => 80,
               'SMA/SMK' => 70,
               'SMP' => 50,
               default => 40
          };
          $prioritas += $prioritasPendidikan * 0.2;

          // 4. Prioritas berdasarkan kelengkapan dokumen (10% dari total)
          $dokumenLengkap = $pendaftaran->dokumen->where('status', 'diterima')->count();
          $totalDokumen = $pendaftaran->dokumen->count();
          $persentaseDokumen = $totalDokumen > 0 ? ($dokumenLengkap / $totalDokumen) * 100 : 0;
          $prioritas += $persentaseDokumen * 0.1;

          return round($prioritas, 2);
     }

     /**
      * Simulasi penjadwalan untuk melihat hasil tanpa menyimpan
      */
     public function simulateScheduling()
     {
          $pesertaTerverifikasi = Pendaftaran::with('user', 'dokumen')
               ->where('status', 'terverifikasi')
               ->get();

          if ($pesertaTerverifikasi->isEmpty()) {
               return [
                    'jadwal' => [],
                    'tidak_terjadwal' => [],
                    'message' => 'Tidak ada peserta yang terverifikasi untuk dijadwalkan.'
               ];
          }

          // Hitung prioritas untuk setiap peserta dan simpan dalam array
          $pesertaDenganPrioritas = [];
          foreach ($pesertaTerverifikasi as $pendaftaran) {
               $prioritas = $this->hitungPrioritas($pendaftaran);
               $pesertaDenganPrioritas[] = [
                    'pendaftaran' => $pendaftaran,
                    'prioritas' => $prioritas
               ];
          }

          // Urutkan berdasarkan prioritas (descending - prioritas tinggi duluan)
          usort($pesertaDenganPrioritas, function ($a, $b) {
               return $b['prioritas'] <=> $a['prioritas'];
          });

          $jadwalTersedia = JadwalKeberangkatan::where('status', 'aktif')
               ->whereRaw('terisi < kapasitas')
               ->orderBy('tanggal_keberangkatan')
               ->get();

          if ($jadwalTersedia->isEmpty()) {
               return [
                    'jadwal' => [],
                    'tidak_terjadwal' => array_map(function ($item) {
                         return [
                              'nama' => $item['pendaftaran']->user->nama,
                              'nomor_pendaftaran' => $item['pendaftaran']->nomor_pendaftaran,
                              'prioritas' => $item['prioritas']
                         ];
                    }, $pesertaDenganPrioritas),
                    'message' => 'Tidak ada jadwal yang tersedia.'
               ];
          }

          $simulasi = [
               'tidak_terjadwal' => []
          ];

          $jadwalSementara = $jadwalTersedia->map(function ($jadwal) {
               return [
                    'id' => $jadwal->id,
                    'nama_batch' => $jadwal->nama_batch,
                    'tanggal_keberangkatan' => $jadwal->tanggal_keberangkatan,
                    'kapasitas' => $jadwal->kapasitas,
                    'terisi' => $jadwal->terisi,
                    'sisa' => $jadwal->sisaKapasitas(),
                    'peserta_terjadwal' => []
               ];
          })->toArray();

          foreach ($pesertaDenganPrioritas as $item) {
               $pendaftaran = $item['pendaftaran'];
               $prioritas = $item['prioritas'];
               $berhasilDijadwalkan = false;

               foreach ($jadwalSementara as $key => $jadwal) {
                    if ($jadwal['sisa'] > 0) {
                         $jadwalSementara[$key]['peserta_terjadwal'][] = [
                              'nama' => $pendaftaran->user->nama,
                              'nomor_pendaftaran' => $pendaftaran->nomor_pendaftaran,
                              'prioritas' => $prioritas
                         ];
                         $jadwalSementara[$key]['sisa']--;
                         $berhasilDijadwalkan = true;
                         break;
                    }
               }

               if (!$berhasilDijadwalkan) {
                    $simulasi['tidak_terjadwal'][] = [
                         'nama' => $pendaftaran->user->nama,
                         'nomor_pendaftaran' => $pendaftaran->nomor_pendaftaran,
                         'prioritas' => $prioritas
                    ];
               }
          }

          $simulasi['jadwal'] = array_values($jadwalSementara);

          return $simulasi;
     }

     /**
      * Mendapatkan statistik prioritas untuk debugging
      */
     public function getStatistikPrioritas()
     {
          $pesertaTerverifikasi = Pendaftaran::with('user', 'dokumen')
               ->where('status', 'terverifikasi')
               ->get();

          $statistik = collect();

          foreach ($pesertaTerverifikasi as $pendaftaran) {
               $prioritas = $this->hitungPrioritas($pendaftaran);

               $statistik->push([
                    'nama' => $pendaftaran->user->nama,
                    'nomor_pendaftaran' => $pendaftaran->nomor_pendaftaran,
                    'usia' => $pendaftaran->user->tanggal_lahir ? $pendaftaran->user->tanggal_lahir->age : null,
                    'pendidikan' => $pendaftaran->user->pendidikan_terakhir,
                    'dokumen_lengkap' => $pendaftaran->dokumen->where('status', 'diterima')->count(),
                    'total_dokumen' => $pendaftaran->dokumen->count(),
                    'hari_sejak_daftar' => $pendaftaran->created_at->diffInDays(now()),
                    'prioritas_total' => $prioritas
               ]);
          }

          return $statistik->sortByDesc('prioritas_total');
     }
}
