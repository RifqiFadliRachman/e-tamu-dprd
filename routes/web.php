<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\NotificationController; // Ditambahkan

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
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

Route::get('/jadwal-kunjungan', fn() => view('schedule'))->name('jadwal.kunjungan');
Route::post('/jadwal-kunjungan', function (Request $request) {
    $validated = $request->validate(['tanggal_kunjungan' => 'required|date', 'waktu_kunjungan' => 'required|string']);
    $request->session()->put('step2_data', $validated);
    return redirect()->route('detail.kunjungan');
})->name('jadwal.kunjungan.store');

Route::get('/detail-kunjungan', fn(Request $request) => view('details', ['step2Data' => $request->session()->get('step2_data', [])]))->name('detail.kunjungan');
Route::post('/detail-kunjungan', function (Request $request) {
    $validated = $request->validate([
        'jenis_kunjungan' => 'required|string', 'topik_kunjungan' => 'required|string|max:255',
        'jumlah_peserta' => 'required|integer|min:1', 'surat_pemberitahuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', 'tanggal_kunjungan' => 'required|date',
        'waktu_kunjungan' => 'required|string',
    ]);
    $sessionData = $request->except(['_token', 'surat_pemberitahuan', 'surat_tugas']);
    session(['step2_data' => array_merge($request->session()->get('step2_data', []), $sessionData)]);

    if ($request->hasFile('surat_pemberitahuan')) {
        session(['surat_pemberitahuan_path' => $request->file('surat_pemberitahuan')->store('documents', 'public')]);
    }

    if ($request->hasFile('surat_tugas')) {
        session(['surat_tugas_path' => $request->file('surat_tugas')->store('documents', 'public')]);
    }

    return redirect()->route('form.tamu');
})->name('detail.kunjungan.store');

Route::get('/form-tamu', fn(Request $request) => view('form', ['step3Data' => $request->session()->get('step3_data', [])]))->name('form.tamu');
Route::post('/form-tamu', function (Request $request) {
    $validated = $request->validate([
        'nama_penanggung_jawab' => 'required|string|max:255', 'posisi_jabatan' => 'required|string',
        'nomor_kontak' => 'required|string|regex:/^[0-9]{10,15}$/', 'nama_fraksi_komisi' => 'required|string',
        'alamat_instansi' => 'required|string|max:500',
    ]);
    session(['step3_data' => $validated]);
    return redirect()->route('konfirmasi');
})->name('form.tamu.store');

Route::get('/konfirmasi', fn(Request $request) => view('konfirmasi', ['step2Data' => $request->session()->get('step2_data', []), 'step3Data' => $request->session()->get('step3_data', [])]))->name('konfirmasi');
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

    Route::get('/surat', [SuratController::class, 'index'])->name('admin.surat');
    Route::get('/surat/search', [SuratController::class, 'search'])->name('admin.surat.search');
    Route::delete('/surat/{tamu}', [SuratController::class, 'destroy'])->name('admin.surat.destroy');

    // Rute untuk manajemen admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
    // RUTE BARU UNTUK LIVE SEARCH ADMIN
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.admin.search');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // RUTE UNTUK NOTIFIKASI (DITAMBAHKAN)
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
});
