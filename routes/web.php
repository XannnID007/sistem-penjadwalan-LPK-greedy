<?php
// routes/web.php - Final Complete Version
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\PenjadwalanController;
use App\Http\Controllers\Admin\PesertaController as AdminPesertaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\PendaftaranController as PesertaPendaftaranController;
use App\Http\Controllers\Peserta\ProfilController;
use App\Http\Controllers\Peserta\JadwalController as PesertaJadwalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage - Landing Page
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('peserta.dashboard');
        }
    }
    return redirect()->route('login'); // Langsung ke login
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Pendaftaran Management
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/', [AdminPendaftaranController::class, 'index'])->name('index');
        Route::get('/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('show');
        Route::post('/{pendaftaran}/verifikasi', [AdminPendaftaranController::class, 'verifikasi'])->name('verifikasi');
        Route::post('/{pendaftaran}/tolak', [AdminPendaftaranController::class, 'tolak'])->name('tolak');
        Route::post('/dokumen/{dokumen}/verifikasi', [AdminPendaftaranController::class, 'verifikasiDokumen'])->name('dokumen.verifikasi');
    });

    // Jadwal Management
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [AdminJadwalController::class, 'index'])->name('index');
        Route::get('/create', [AdminJadwalController::class, 'create'])->name('create');
        Route::post('/', [AdminJadwalController::class, 'store'])->name('store');
        Route::get('/{jadwal}', [AdminJadwalController::class, 'show'])->name('show');
        Route::get('/{jadwal}/edit', [AdminJadwalController::class, 'edit'])->name('edit');
        Route::put('/{jadwal}', [AdminJadwalController::class, 'update'])->name('update');
        Route::delete('/{jadwal}', [AdminJadwalController::class, 'destroy'])->name('destroy');
    });

    // Penjadwalan Otomatis (Greedy Algorithm)
    Route::prefix('penjadwalan')->name('penjadwalan.')->group(function () {
        Route::get('/', [PenjadwalanController::class, 'index'])->name('index');
        Route::post('/execute', [PenjadwalanController::class, 'execute'])->name('execute');
    });

    // Peserta Management
    Route::prefix('peserta')->name('peserta.')->group(function () {
        Route::get('/', [AdminPesertaController::class, 'index'])->name('index');
        Route::get('/{user}', [AdminPesertaController::class, 'show'])->name('show');
        Route::delete('/{user}', [AdminPesertaController::class, 'destroy'])->name('destroy');
    });

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/pendaftaran', [LaporanController::class, 'pendaftaran'])->name('pendaftaran');
        Route::get('/keberangkatan', [LaporanController::class, 'keberangkatan'])->name('keberangkatan');
        Route::get('/export/excel', [LaporanController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [LaporanController::class, 'exportPdf'])->name('export.pdf');
    });
});

// Peserta Routes
Route::middleware(['auth', 'peserta'])->prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/dashboard', [PesertaDashboardController::class, 'index'])->name('dashboard');

    // Pendaftaran
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/', [PesertaPendaftaranController::class, 'index'])->name('index');
        Route::get('/create', [PesertaPendaftaranController::class, 'create'])->name('create');
        Route::post('/', [PesertaPendaftaranController::class, 'store'])->name('store');
        Route::get('/show', [PesertaPendaftaranController::class, 'show'])->name('show'); // Route untuk show
        Route::post('/upload-dokumen', [PesertaPendaftaranController::class, 'uploadDokumen'])->name('upload.dokumen');
        Route::delete('/dokumen/{dokumen}', [PesertaPendaftaranController::class, 'deleteDokumen'])->name('delete.dokumen');
    });

    // Profil
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/edit', [ProfilController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfilController::class, 'update'])->name('update');
    });

    // Jadwal
    Route::get('/jadwal', [PesertaJadwalController::class, 'index'])->name('jadwal');
});

// Auto redirect berdasarkan role setelah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('peserta.dashboard');
        }
    })->name('dashboard');
});

// Download file dokumen (dengan authorization)
Route::get('/storage/dokumen/{file}', function ($file) {
    $user = auth()->user();

    if (!$user) {
        abort(401);
    }

    // Admin bisa akses semua file
    if ($user->isAdmin()) {
        return response()->file(storage_path('app/public/dokumen/' . $file));
    }

    // Peserta hanya bisa akses file miliknya sendiri
    $dokumen = App\Models\Dokumen::where('file_path', 'dokumen/' . $file)->first();
    if ($dokumen && $dokumen->pendaftaran->user_id === $user->id) {
        return response()->file(storage_path('app/public/dokumen/' . $file));
    }

    abort(403);
})->middleware('auth')->name('file.dokumen');

// Download file profil (dengan authorization)
Route::get('/storage/profil/{file}', function ($file) {
    $user = auth()->user();

    if (!$user) {
        abort(401);
    }

    // User hanya bisa akses foto profilnya sendiri, kecuali admin
    if ($user->isAdmin() || str_contains($file, 'profil_' . $user->id . '_')) {
        return response()->file(storage_path('app/public/profil/' . $file));
    }

    abort(403);
})->middleware('auth')->name('file.profil');

// 404 Fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
