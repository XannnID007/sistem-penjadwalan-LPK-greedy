<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pendaftaran = $user->pendaftaran;

        // Jika sudah ada pendaftaran, redirect ke show
        if ($pendaftaran) {
            return redirect()->route('peserta.pendaftaran.show');
        }

        // Jika belum ada pendaftaran, redirect ke create
        return redirect()->route('peserta.pendaftaran.create');
    }

    public function create()
    {
        $user = auth()->user();

        // Cek apakah sudah pernah mendaftar
        if ($user->pendaftaran) {
            return redirect()->route('peserta.pendaftaran.show')
                ->with('info', 'Anda sudah terdaftar. Silakan melengkapi dokumen pendukung.');
        }

        return view('peserta.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Cek apakah sudah pernah mendaftar
        if ($user->pendaftaran) {
            return redirect()->route('peserta.pendaftaran.show')
                ->with('error', 'Anda sudah terdaftar sebelumnya.');
        }

        // Validasi data profil lengkap
        if (!$user->no_telepon || !$user->tanggal_lahir || !$user->pendidikan_terakhir || !$user->alamat) {
            return redirect()->route('peserta.profil.edit')
                ->with('error', 'Silakan lengkapi data profil Anda terlebih dahulu.');
        }

        $request->validate([
            'agree' => 'required|accepted'
        ]);

        $pendaftaran = new Pendaftaran();
        $nomorPendaftaran = $pendaftaran->generateNomorPendaftaran();

        $pendaftaran = Pendaftaran::create([
            'user_id' => $user->id,
            'nomor_pendaftaran' => $nomorPendaftaran,
            'status' => 'menunggu'
        ]);

        return redirect()->route('peserta.pendaftaran.show')
            ->with('success', 'Pendaftaran berhasil! Nomor pendaftaran Anda: ' . $nomorPendaftaran);
    }

    public function show()
    {
        $user = auth()->user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('peserta.pendaftaran.create')
                ->with('info', 'Anda belum mendaftar program LPK.');
        }

        $pendaftaran->load('dokumen');

        return view('peserta.pendaftaran.show', compact('pendaftaran'));
    }

    public function uploadDokumen(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file_dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string|max:500'
        ]);

        $user = auth()->user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('peserta.pendaftaran.create')
                ->with('error', 'Silakan daftar terlebih dahulu.');
        }

        // Cek apakah dokumen dengan nama yang sama sudah ada
        $existingDoc = $pendaftaran->dokumen()->where('nama_dokumen', $request->nama_dokumen)->first();
        if ($existingDoc) {
            return redirect()->route('peserta.pendaftaran.show')
                ->with('error', 'Dokumen dengan nama tersebut sudah ada.');
        }

        $file = $request->file('file_dokumen');
        $fileName = time() . '_' . $pendaftaran->nomor_pendaftaran . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('dokumen', $fileName, 'public');

        Dokumen::create([
            'pendaftaran_id' => $pendaftaran->id,
            'nama_dokumen' => $request->nama_dokumen,
            'file_path' => $filePath,
            'status' => 'menunggu',
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('peserta.pendaftaran.show')
            ->with('success', 'Dokumen berhasil diupload!');
    }

    public function deleteDokumen(Dokumen $dokumen)
    {
        $user = auth()->user();

        // Pastikan dokumen milik user yang sedang login
        if ($dokumen->pendaftaran->user_id !== $user->id) {
            abort(403);
        }

        // Hanya bisa hapus jika status pendaftaran masih menunggu
        if ($dokumen->pendaftaran->status !== 'menunggu') {
            return redirect()->route('peserta.pendaftaran.show')
                ->with('error', 'Tidak dapat menghapus dokumen karena pendaftaran sudah diproses.');
        }

        // Hapus file dari storage
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('peserta.pendaftaran.show')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
