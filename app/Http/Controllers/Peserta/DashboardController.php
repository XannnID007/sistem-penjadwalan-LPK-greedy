<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pendaftaran = $user->pendaftaran;

        $jadwal = null;
        if ($pendaftaran && $pendaftaran->status === 'terjadwal') {
            $jadwal = $pendaftaran->jadwal->jadwal ?? null;
        }

        return view('peserta.dashboard', compact('pendaftaran', 'jadwal'));
    }
}
