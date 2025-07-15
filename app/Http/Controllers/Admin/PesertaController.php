<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'peserta')->with('pendaftaran');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status pendaftaran
        if ($request->has('status') && $request->status != '') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $peserta = $query->latest()->paginate(10);

        return view('admin.peserta.index', compact('peserta'));
    }

    public function show(User $user)
    {
        if (!$user->isPeserta()) {
            abort(404);
        }

        $user->load(['pendaftaran.dokumen', 'pendaftaran.jadwal.jadwal']);
        return view('admin.peserta.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if (!$user->isPeserta()) {
            abort(404);
        }

        // Cek apakah peserta sudah terjadwal
        if ($user->pendaftaran && $user->pendaftaran->status === 'terjadwal') {
            return redirect()->route('admin.peserta.index')
                ->with('error', 'Tidak dapat menghapus peserta yang sudah terjadwal!');
        }

        // Hapus foto profil jika ada
        if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // Hapus dokumen jika ada
        if ($user->pendaftaran) {
            foreach ($user->pendaftaran->dokumen as $dokumen) {
                if (Storage::disk('public')->exists($dokumen->file_path)) {
                    Storage::disk('public')->delete($dokumen->file_path);
                }
            }
        }

        $user->delete();

        return redirect()->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil dihapus!');
    }
}
