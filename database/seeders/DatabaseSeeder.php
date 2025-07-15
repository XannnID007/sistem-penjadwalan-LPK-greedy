<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JadwalKeberangkatan;
use App\Models\Pendaftaran;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        $admin = User::create([
            'nama' => 'Administrator LPK',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_telepon' => '081234567890',
            'tanggal_lahir' => '1985-01-01',
            'alamat' => 'Jakarta, Indonesia',
            'pendidikan_terakhir' => 'S1',
        ]);

        // Create Sample Peserta
        $peserta1 = User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'peserta',
            'no_telepon' => '081234567891',
            'tanggal_lahir' => '1995-05-15',
            'alamat' => 'Bandung, Jawa Barat',
            'pendidikan_terakhir' => 'SMA/SMK',
        ]);

        $peserta2 = User::create([
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'role' => 'peserta',
            'no_telepon' => '081234567892',
            'tanggal_lahir' => '1997-08-20',
            'alamat' => 'Surabaya, Jawa Timur',
            'pendidikan_terakhir' => 'D3',
        ]);

        $peserta3 = User::create([
            'nama' => 'Ahmad Wijaya',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password123'),
            'role' => 'peserta',
            'no_telepon' => '081234567893',
            'tanggal_lahir' => '1996-03-10',
            'alamat' => 'Yogyakarta, DIY',
            'pendidikan_terakhir' => 'S1',
        ]);

        $peserta4 = User::create([
            'nama' => 'Diana Putri',
            'email' => 'diana@example.com',
            'password' => Hash::make('password123'),
            'role' => 'peserta',
            'no_telepon' => '081234567894',
            'tanggal_lahir' => '1998-12-05',
            'alamat' => 'Medan, Sumatera Utara',
            'pendidikan_terakhir' => 'SMA/SMK',
        ]);

        $peserta5 = User::create([
            'nama' => 'Rizki Pratama',
            'email' => 'rizki@example.com',
            'password' => Hash::make('password123'),
            'role' => 'peserta',
            'no_telepon' => '081234567895',
            'tanggal_lahir' => '1994-07-22',
            'alamat' => 'Makassar, Sulawesi Selatan',
            'pendidikan_terakhir' => 'D3',
        ]);

        // Create Sample Jadwal Keberangkatan
        $jadwal1 = JadwalKeberangkatan::create([
            'nama_batch' => 'Batch A - Tokyo 2025',
            'tanggal_keberangkatan' => '2025-09-15',
            'kapasitas' => 20,
            'terisi' => 0,
            'keterangan' => 'Program 3 tahun di Tokyo - bidang manufaktur dan otomotif',
            'status' => 'aktif'
        ]);

        $jadwal2 = JadwalKeberangkatan::create([
            'nama_batch' => 'Batch B - Osaka 2025',
            'tanggal_keberangkatan' => '2025-10-20',
            'kapasitas' => 15,
            'terisi' => 0,
            'keterangan' => 'Program 3 tahun di Osaka - bidang pertanian dan perikanan',
            'status' => 'aktif'
        ]);

        $jadwal3 = JadwalKeberangkatan::create([
            'nama_batch' => 'Batch C - Nagoya 2025',
            'tanggal_keberangkatan' => '2025-11-10',
            'kapasitas' => 18,
            'terisi' => 0,
            'keterangan' => 'Program 3 tahun di Nagoya - bidang konstruksi dan bangunan',
            'status' => 'aktif'
        ]);

        $jadwal4 = JadwalKeberangkatan::create([
            'nama_batch' => 'Batch D - Fukuoka 2026',
            'tanggal_keberangkatan' => '2026-01-15',
            'kapasitas' => 12,
            'terisi' => 0,
            'keterangan' => 'Program 3 tahun di Fukuoka - bidang kuliner dan hospitality',
            'status' => 'aktif'
        ]);

        $jadwal5 = JadwalKeberangkatan::create([
            'nama_batch' => 'Batch E - Sapporo 2026',
            'tanggal_keberangkatan' => '2026-03-01',
            'kapasitas' => 10,
            'terisi' => 0,
            'keterangan' => 'Program 3 tahun di Sapporo - bidang teknologi informasi',
            'status' => 'aktif'
        ]);

        // Create Sample Pendaftaran
        $pendaftaran1 = Pendaftaran::create([
            'user_id' => $peserta1->id,
            'nomor_pendaftaran' => 'LPK202501001',
            'status' => 'menunggu',
            'prioritas' => 0,
        ]);

        $pendaftaran2 = Pendaftaran::create([
            'user_id' => $peserta2->id,
            'nomor_pendaftaran' => 'LPK202501002',
            'status' => 'terverifikasi',
            'tanggal_verifikasi' => now()->subDays(3),
            'diverifikasi_oleh' => $admin->id,
            'prioritas' => 0,
        ]);

        $pendaftaran3 = Pendaftaran::create([
            'user_id' => $peserta3->id,
            'nomor_pendaftaran' => 'LPK202501003',
            'status' => 'terverifikasi',
            'tanggal_verifikasi' => now()->subDays(1),
            'diverifikasi_oleh' => $admin->id,
            'prioritas' => 0,
        ]);

        // Create Sample Dokumen
        $dokumenTypes = [
            'KTP',
            'Ijazah Terakhir',
            'Transkrip Nilai',
            'Surat Keterangan Sehat',
            'Surat Keterangan Kelakuan Baik',
            'Pas Foto 4x6',
            'Kartu Keluarga'
        ];

        // Dokumen untuk peserta 1 (belum terverifikasi)
        foreach (array_slice($dokumenTypes, 0, 4) as $type) {
            Dokumen::create([
                'pendaftaran_id' => $pendaftaran1->id,
                'nama_dokumen' => $type,
                'file_path' => 'dokumen/sample_' . strtolower(str_replace(' ', '_', $type)) . '.pdf',
                'status' => 'menunggu',
            ]);
        }

        // Dokumen untuk peserta 2 (sudah terverifikasi)
        foreach ($dokumenTypes as $type) {
            Dokumen::create([
                'pendaftaran_id' => $pendaftaran2->id,
                'nama_dokumen' => $type,
                'file_path' => 'dokumen/sample_' . strtolower(str_replace(' ', '_', $type)) . '_2.pdf',
                'status' => 'diterima',
            ]);
        }

        // Dokumen untuk peserta 3 (campuran status)
        foreach ($dokumenTypes as $index => $type) {
            $status = $index < 5 ? 'diterima' : 'menunggu';
            Dokumen::create([
                'pendaftaran_id' => $pendaftaran3->id,
                'nama_dokumen' => $type,
                'file_path' => 'dokumen/sample_' . strtolower(str_replace(' ', '_', $type)) . '_3.pdf',
                'status' => $status,
            ]);
        }

        echo "✅ Database seeded successfully!\n";
        echo "👤 Admin: admin@lpkjepang.com / password123\n";
        echo "👥 Peserta: budi@example.com / password123\n";
        echo "📊 Created " . User::count() . " users\n";
        echo "📅 Created " . JadwalKeberangkatan::count() . " jadwal keberangkatan\n";
        echo "📋 Created " . Pendaftaran::count() . " pendaftaran\n";
        echo "📄 Created " . Dokumen::count() . " dokumen\n";
    }
}
