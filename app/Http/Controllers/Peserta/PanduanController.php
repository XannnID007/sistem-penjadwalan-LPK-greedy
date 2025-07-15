<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;

class PanduanController extends Controller
{
    public function dokumen()
    {
        return view('peserta.panduan.dokumen');
    }
}
