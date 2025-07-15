<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\JadwalKeberangkatan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftar' => User::where('role', 'peserta')->count(),
            'menunggu_verifikasi' => Pendaftaran::where('status', 'menunggu')->count(),
            'terverifikasi' => Pendaftaran::where('status', 'terverifikasi')->count(),
            'terjadwal' => Pendaftaran::where('status', 'terjadwal')->count(),
        ];

        $pendaftaran_terbaru = Pendaftaran::with('user')
            ->latest()
            ->take(5)
            ->get();

        $jadwal_mendatang = JadwalKeberangkatan::where('tanggal_keberangkatan', '>=', now())
            ->where('status', 'aktif')
            ->orderBy('tanggal_keberangkatan')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendaftaran_terbaru', 'jadwal_mendatang'));
    }
}
