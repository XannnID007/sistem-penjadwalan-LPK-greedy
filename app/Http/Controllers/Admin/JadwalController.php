<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKeberangkatan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKeberangkatan::with('peserta.pendaftaran.user')
            ->orderBy('tanggal_keberangkatan')
            ->paginate(10);

        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_batch' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date|after:today',
            'kapasitas' => 'required|integer|min:1|max:100',
            'keterangan' => 'nullable|string|max:500'
        ]);

        JadwalKeberangkatan::create([
            'nama_batch' => $request->nama_batch,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'kapasitas' => $request->kapasitas,
            'keterangan' => $request->keterangan,
            'terisi' => 0,
            'status' => 'aktif'
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal keberangkatan berhasil dibuat!');
    }

    public function show(JadwalKeberangkatan $jadwal)
    {
        $jadwal->load('peserta.pendaftaran.user');
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(JadwalKeberangkatan $jadwal)
    {
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalKeberangkatan $jadwal)
    {
        $request->validate([
            'nama_batch' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'kapasitas' => 'required|integer|min:' . $jadwal->terisi . '|max:100',
            'keterangan' => 'nullable|string|max:500',
            'status' => 'required|in:aktif,penuh,selesai'
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal keberangkatan berhasil diperbarui!');
    }

    public function destroy(JadwalKeberangkatan $jadwal)
    {
        if ($jadwal->terisi > 0) {
            return redirect()->route('admin.jadwal.index')
                ->with('error', 'Tidak dapat menghapus jadwal yang sudah memiliki peserta!');
        }

        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal keberangkatan berhasil dihapus!');
    }
}
