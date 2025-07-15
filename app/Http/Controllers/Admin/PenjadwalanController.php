<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GreedySchedulingService;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    protected $greedyService;

    public function __construct(GreedySchedulingService $greedyService)
    {
        $this->greedyService = $greedyService;
    }

    public function index()
    {
        // Dapatkan simulasi penjadwalan
        $simulasi = $this->greedyService->simulateScheduling();

        return view('admin.penjadwalan.index', compact('simulasi'));
    }

    public function execute(Request $request)
    {
        try {
            $hasil = $this->greedyService->scheduleParticipants();

            return redirect()->route('admin.penjadwalan.index')
                ->with('success', "Penjadwalan berhasil! {$hasil['terjadwalkan']} peserta terjadwalkan, {$hasil['gagal']} gagal.");
        } catch (\Exception $e) {
            return redirect()->route('admin.penjadwalan.index')
                ->with('error', 'Terjadi kesalahan saat melakukan penjadwalan: ' . $e->getMessage());
        }
    }
}
