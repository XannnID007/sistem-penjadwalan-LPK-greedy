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
        // Implementasi export Excel (untuk development)
        $pendaftaran = Pendaftaran::with(['user', 'verifikator']);

        // Apply same filters as pendaftaran method
        if ($request->has('dari') && $request->dari) {
            $pendaftaran->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->has('sampai') && $request->sampai) {
            $pendaftaran->whereDate('created_at', '<=', $request->sampai);
        }
        if ($request->has('status') && $request->status) {
            $pendaftaran->where('status', $request->status);
        }

        $data = $pendaftaran->latest()->get();

        // Generate CSV for now (can be enhanced with Excel package later)
        $filename = 'laporan_pendaftaran_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, [
                'No',
                'Nomor Pendaftaran',
                'Nama Peserta',
                'Email',
                'No. Telepon',
                'Pendidikan',
                'Status',
                'Tanggal Daftar',
                'Verifikator'
            ]);

            // Data CSV
            foreach ($data as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->nomor_pendaftaran,
                    $item->user->nama,
                    $item->user->email,
                    $item->user->no_telepon ?? '-',
                    $item->user->pendidikan_terakhir ?? '-',
                    ucfirst($item->status),
                    $item->created_at->format('d/m/Y'),
                    $item->verifikator->nama ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        // Implementasi export PDF (untuk development)
        return redirect()->back()->with('info', 'Fitur export PDF akan segera tersedia! Gunakan export Excel terlebih dahulu.');
    }
}
