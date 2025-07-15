<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JadwalKeberangkatan;

class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pendaftaran = $user->pendaftaran;

        // Jadwal yang tersedia (untuk peserta yang belum terjadwal)
        $jadwalTersedia = JadwalKeberangkatan::where('status', 'aktif')
            ->where('tanggal_keberangkatan', '>=', now())
            ->orderBy('tanggal_keberangkatan')
            ->get();

        // Jadwal peserta (jika sudah terjadwal)
        $jadwalPeserta = null;
        if ($pendaftaran && $pendaftaran->status === 'terjadwal') {
            $jadwalPeserta = $pendaftaran->jadwal->jadwal ?? null;
        }

        return view('peserta.jadwal.index', compact('jadwalTersedia', 'jadwalPeserta', 'pendaftaran'));
    }
}
