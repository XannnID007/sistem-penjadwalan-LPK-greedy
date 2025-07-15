<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'dokumen', 'verifikator']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nama atau nomor pendaftaran
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_pendaftaran', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('nama', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $pendaftaran = $query->latest()->paginate(10);

        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['user', 'dokumen', 'verifikator']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function verifikasi(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:500'
        ]);

        $pendaftaran->update([
            'status' => 'terverifikasi',
            'catatan' => $request->catatan,
            'tanggal_verifikasi' => now(),
            'diverifikasi_oleh' => auth()->id()
        ]);

        return redirect()->route('admin.pendaftaran.show', $pendaftaran)
            ->with('success', 'Pendaftaran berhasil diverifikasi!');
    }

    public function tolak(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'catatan' => 'required|string|max:500'
        ]);

        $pendaftaran->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
            'tanggal_verifikasi' => now(),
            'diverifikasi_oleh' => auth()->id()
        ]);

        return redirect()->route('admin.pendaftaran.show', $pendaftaran)
            ->with('success', 'Pendaftaran telah ditolak!');
    }

    public function verifikasiDokumen(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'keterangan' => 'nullable|string|max:500'
        ]);

        $dokumen->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()
            ->with('success', 'Status dokumen berhasil diperbarui!');
    }
}
