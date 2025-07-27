<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\JadwalKeberangkatan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftar' => User::where('role', 'peserta')->count(),
            'menunggu_verifikasi' => Pendaftaran::where('status', 'menunggu')->count(),
            'terverifikasi' => Pendaftaran::where('status', 'terverifikasi')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
            'terjadwal' => Pendaftaran::where('status', 'terjadwal')->count(),
            'total_jadwal' => JadwalKeberangkatan::count(),
            'jadwal_aktif' => JadwalKeberangkatan::where('status', 'aktif')->count(),
        ];

        // Statistik pendaftaran per bulan (6 bulan terakhir)
        $pendaftaranPerBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $count = Pendaftaran::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->count();
            $pendaftaranPerBulan[] = [
                'bulan' => $bulan->format('M Y'),
                'jumlah' => $count
            ];
        }

        return view('admin.laporan.index', compact('stats', 'pendaftaranPerBulan'));
    }

    public function pendaftaran(Request $request)
    {
        $query = Pendaftaran::with(['user', 'verifikator']);

        // Filter tanggal
        if ($request->has('dari') && $request->dari) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->has('sampai') && $request->sampai) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        // Filter status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pendaftaran = $query->latest()->get();

        return view('admin.laporan.pendaftaran', compact('pendaftaran'));
    }

    public function keberangkatan(Request $request)
    {
        $query = JadwalKeberangkatan::with('peserta.pendaftaran.user');

        // Filter tanggal
        if ($request->has('dari') && $request->dari) {
            $query->whereDate('tanggal_keberangkatan', '>=', $request->dari);
        }
        if ($request->has('sampai') && $request->sampai) {
            $query->whereDate('tanggal_keberangkatan', '<=', $request->sampai);
        }

        $jadwal = $query->orderBy('tanggal_keberangkatan')->get();

        return view('admin.laporan.keberangkatan', compact('jadwal'));
    }

    public function exportExcel(Request $request)
    {
        // Ambil data pendaftaran dengan filter yang sama
        $query = Pendaftaran::with(['user', 'verifikator']);

        // Apply filters
        if ($request->has('dari') && $request->dari) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->has('sampai') && $request->sampai) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->get();

        // Generate CSV
        $filename = 'laporan_pendaftaran_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($file, [
                'No',
                'Nomor Pendaftaran',
                'Nama Peserta',
                'Email',
                'No. Telepon',
                'Tanggal Lahir',
                'Usia',
                'Pendidikan',
                'Alamat',
                'Status',
                'Tanggal Daftar',
                'Tanggal Verifikasi',
                'Verifikator',
                'Catatan'
            ]);

            // Data CSV
            foreach ($data as $index => $item) {
                $usia = $item->user->tanggal_lahir ? $item->user->tanggal_lahir->age : '-';

                fputcsv($file, [
                    $index + 1,
                    $item->nomor_pendaftaran,
                    $item->user->nama,
                    $item->user->email,
                    $item->user->no_telepon ?? '-',
                    $item->user->tanggal_lahir ? $item->user->tanggal_lahir->format('d/m/Y') : '-',
                    $usia,
                    $item->user->pendidikan_terakhir ?? '-',
                    $item->user->alamat ?? '-',
                    ucfirst($item->status),
                    $item->created_at->format('d/m/Y H:i'),
                    $item->tanggal_verifikasi ? $item->tanggal_verifikasi->format('d/m/Y H:i') : '-',
                    $item->verifikator->nama ?? '-',
                    $item->catatan ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        // Simple HTML to PDF export
        $query = Pendaftaran::with(['user', 'verifikator']);

        // Apply filters
        if ($request->has('dari') && $request->dari) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->has('sampai') && $request->sampai) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->get();
        $filename = 'laporan_pendaftaran_' . date('Y-m-d_H-i-s') . '.html';

        $html = $this->generatePdfHtml($data, $request);

        return response($html, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function generatePdfHtml($data, $request)
    {
        $filterInfo = '';
        if ($request->dari || $request->sampai || $request->status) {
            $filterInfo = '<p style="margin-bottom: 20px; color: #666;">';
            $filterInfo .= '<strong>Filter:</strong> ';

            if ($request->dari) {
                $filterInfo .= 'Dari: ' . date('d/m/Y', strtotime($request->dari)) . ' ';
            }
            if ($request->sampai) {
                $filterInfo .= 'Sampai: ' . date('d/m/Y', strtotime($request->sampai)) . ' ';
            }
            if ($request->status) {
                $filterInfo .= 'Status: ' . ucfirst($request->status);
            }

            $filterInfo .= '</p>';
        }

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Laporan Pendaftaran LPK Jepang</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .header h1 { color: #16a34a; margin: 0; }
                .header h2 { color: #374151; margin: 5px 0; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f3f4f6; font-weight: bold; }
                tr:nth-child(even) { background-color: #f9f9f9; }
                .status-menunggu { color: #d97706; }
                .status-terverifikasi { color: #059669; }
                .status-ditolak { color: #dc2626; }
                .status-terjadwal { color: #7c3aed; }
                .footer { margin-top: 30px; text-align: right; color: #666; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>LPK JEPANG</h1>
                <h2>Laporan Data Pendaftaran</h2>
                <p>Dicetak pada: ' . date('d F Y H:i') . '</p>
            </div>
            
            ' . $filterInfo . '
            
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nomor Pendaftaran</th>
                        <th width="20%">Nama Peserta</th>
                        <th width="15%">Email</th>
                        <th width="10%">Telepon</th>
                        <th width="8%">Usia</th>
                        <th width="12%">Status</th>
                        <th width="15%">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($data as $index => $item) {
            $usia = $item->user->tanggal_lahir ? $item->user->tanggal_lahir->age . ' tahun' : '-';
            $statusClass = 'status-' . $item->status;

            $html .= '
                    <tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . htmlspecialchars($item->nomor_pendaftaran) . '</td>
                        <td>' . htmlspecialchars($item->user->nama) . '</td>
                        <td>' . htmlspecialchars($item->user->email) . '</td>
                        <td>' . htmlspecialchars($item->user->no_telepon ?? '-') . '</td>
                        <td>' . htmlspecialchars($usia) . '</td>
                        <td class="' . $statusClass . '">' . ucfirst($item->status) . '</td>
                        <td>' . $item->created_at->format('d/m/Y H:i') . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
            
            <div class="footer">
                <p>Total Data: ' . $data->count() . ' pendaftaran</p>
                <p>Laporan ini digenerate secara otomatis oleh sistem LPK Jepang</p>
            </div>
        </body>
        </html>';

        return $html;
    }

    public function exportJadwalExcel(Request $request)
    {
        // Export data jadwal keberangkatan
        $query = JadwalKeberangkatan::with('peserta.pendaftaran.user');

        // Apply filters
        if ($request->has('dari') && $request->dari) {
            $query->whereDate('tanggal_keberangkatan', '>=', $request->dari);
        }
        if ($request->has('sampai') && $request->sampai) {
            $query->whereDate('tanggal_keberangkatan', '<=', $request->sampai);
        }

        $data = $query->orderBy('tanggal_keberangkatan')->get();

        $filename = 'laporan_jadwal_keberangkatan_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($file, [
                'No',
                'Nama Batch',
                'Tanggal Keberangkatan',
                'Kapasitas',
                'Terisi',
                'Sisa Kapasitas',
                'Status',
                'Keterangan',
                'Nama Peserta',
                'Email Peserta',
                'No. Pendaftaran'
            ]);

            // Data CSV
            $no = 1;
            foreach ($data as $jadwal) {
                if ($jadwal->peserta->count() > 0) {
                    foreach ($jadwal->peserta as $pesertaJadwal) {
                        $peserta = $pesertaJadwal->pendaftaran;
                        fputcsv($file, [
                            $no++,
                            $jadwal->nama_batch,
                            $jadwal->tanggal_keberangkatan->format('d/m/Y'),
                            $jadwal->kapasitas,
                            $jadwal->terisi,
                            $jadwal->sisaKapasitas(),
                            ucfirst($jadwal->status),
                            $jadwal->keterangan ?? '-',
                            $peserta->user->nama,
                            $peserta->user->email,
                            $peserta->nomor_pendaftaran
                        ]);
                    }
                } else {
                    fputcsv($file, [
                        $no++,
                        $jadwal->nama_batch,
                        $jadwal->tanggal_keberangkatan->format('d/m/Y'),
                        $jadwal->kapasitas,
                        $jadwal->terisi,
                        $jadwal->sisaKapasitas(),
                        ucfirst($jadwal->status),
                        $jadwal->keterangan ?? '-',
                        '-',
                        '-',
                        '-',
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
