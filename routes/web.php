<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================================================
// RUTE UNTUK PENGGUNA TAMU (TIDAK PERLU LOGIN)
// ==========================================================================

Route::get('/', function (Request $request) {
    if ($request->session()->has('intro_seen')) {
        return redirect()->route('home');
    }
    return view('intro');
})->name('intro');

Route::post('/skip-intro', function (Request $request) {
    $request->session()->put('intro_seen', true);
    return redirect()->route('home');
})->name('skip.intro');

Route::get('/home', fn() => view('index'))->name('home');

// Tahap 1: Jadwal Kunjungan
Route::get('/jadwal-kunjungan', [TamuController::class, 'showJadwal'])->name('jadwal.kunjungan');
Route::post('/jadwal-kunjungan', [TamuController::class, 'submitJadwal'])->name('jadwal.kunjungan.store');

// Tahap 2: Detail Kunjungan
Route::get('/detail-kunjungan', [TamuController::class, 'showDetailKunjungan'])->name('detail.kunjungan');
Route::post('/detail-kunjungan', [TamuController::class, 'submitDetailKunjungan'])->name('detail.kunjungan.store');

// Tahap 3: Formulir Instansi/Tamu
Route::get('/form-tamu', [TamuController::class, 'showFormTamu'])->name('form.tamu');
Route::post('/form-tamu', [TamuController::class, 'submitFormTamu'])->name('form.tamu.store');

// Tahap 4: Konfirmasi & Simpan
Route::get('/konfirmasi', [TamuController::class, 'showKonfirmasi'])->name('konfirmasi');
Route::post('/konfirmasi', [TamuController::class, 'store'])->name('konfirmasi.store');

Route::get('/sukses', fn() => view('success'))->name('sukses');

// ==========================================================
// RUTE UNTUK LOGIN & LOGOUT ADMIN
// ==========================================================
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================================
// RUTE KHUSUS ADMIN (WAJIB LOGIN)
// ==========================================================
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [TamuController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/daftar-tamu', [TamuController::class, 'showDaftarTamu'])->name('admin.daftar-tamu');
    
    Route::get('/tamu/search', [TamuController::class, 'search'])->name('admin.tamu.search');
    Route::get('/daftar-tamu/search', [TamuController::class, 'searchDaftarTamu'])->name('admin.daftar-tamu.search');
    
    Route::get('/tamu/{tamu}', [TamuController::class, 'showDetail'])->name('admin.tamu.detail');
    Route::delete('/tamu/{tamu}', [TamuController::class, 'destroy'])->name('admin.tamu.destroy');
    Route::put('/tamu/{tamu}/status', [TamuController::class, 'updateStatus'])->name('admin.tamu.updateStatus');
    Route::put('/tamu/{tamu}/keterangan', [TamuController::class, 'updateKeterangan'])->name('admin.tamu.updateKeterangan');

    Route::get('/surat', [SuratController::class, 'index'])->name('admin.surat');
    Route::get('/surat/search', [SuratController::class, 'search'])->name('admin.surat.search');
    Route::delete('/surat/{tamu}', [SuratController::class, 'destroy'])->name('admin.surat.destroy');

    // Rute untuk manajemen admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.admin.search');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // RUTE UNTUK NOTIFIKASI
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
});