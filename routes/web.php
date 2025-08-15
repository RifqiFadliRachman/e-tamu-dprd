<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route tamu bebas akses tanpa login.
| Admin hanya di /admin/* dengan auth middleware.
|--------------------------------------------------------------------------
*/

// ==========================================================================
// 1. RUTE UNTUK PENGGUNA TAMU (TIDAK PERLU LOGIN)
// ==========================================================================

// Halaman intro (hanya sekali muncul)
Route::get('/', function (Request $request) {
    if ($request->session()->has('intro_seen')) {
        return redirect()->route('home'); // jika sudah pernah lihat intro → langsung home
    }
    return view('intro'); // tampilkan intro
})->name('intro');

// Aksi tombol "Lanjut" di intro
Route::post('/skip-intro', function (Request $request) {
    $request->session()->put('intro_seen', true); // tandai intro sudah dilihat
    return redirect()->route('home'); // langsung ke home
})->name('skip.intro');

// Step 1: Halaman utama
Route::get('/home', function () {
    return view('index');
})->name('home');

// Step 2: Jadwal kunjungan
Route::get('/jadwal-kunjungan', fn() => view('schedule'))->name('jadwal.kunjungan');
Route::post('/jadwal-kunjungan', function (Request $request) {
    $validated = $request->validate([
        'tanggal_kunjungan' => 'required|date',
        'waktu_kunjungan'   => 'required|string'
    ]);
    $request->session()->put('step2_data', $validated);
    return redirect()->route('detail.kunjungan'); // langsung ke detail kunjungan
})->name('jadwal.kunjungan.store');

// Step 3: Detail kunjungan
Route::get('/detail-kunjungan', fn(Request $request) =>
    view('details', ['step2Data' => $request->session()->get('step2_data', [])])
)->name('detail.kunjungan');
Route::post('/detail-kunjungan', function (Request $request) {
    $validated = $request->validate([
        'jenis_kunjungan'     => 'required|string',
        'topik_kunjungan'     => 'required|string|max:255',
        'jumlah_peserta'      => 'required|integer|min:1',
        'surat_pemberitahuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tugas'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'tanggal_kunjungan'   => 'required|date',
        'waktu_kunjungan'     => 'required|string',
    ]);

    $sessionData = $request->except(['_token', 'surat_pemberitahuan', 'surat_tugas']);
    session(['step2_data' => array_merge($request->session()->get('step2_data', []), $sessionData)]);

    if ($request->hasFile('surat_pemberitahuan')) {
        session(['surat_pemberitahuan_path' => $request->file('surat_pemberitahuan')->store('documents', 'public')]);
    }
    if ($request->hasFile('surat_tugas')) {
        session(['surat_tugas_path' => $request->file('surat_tugas')->store('documents', 'public')]);
    }

    return redirect()->route('form.tamu'); // langsung ke form tamu
})->name('detail.kunjungan.store');

// Step 4: Form tamu
Route::get('/form-tamu', fn(Request $request) =>
    view('form', ['step3Data' => $request->session()->get('step3_data', [])])
)->name('form.tamu');
Route::post('/form-tamu', function (Request $request) {
    $validated = $request->validate([
        'nama_penanggung_jawab' => 'required|string|max:255',
        'posisi_jabatan'        => 'required|string',
        'nomor_kontak'          => 'required|string|regex:/^[0-9]{10,15}$/',
        'nama_fraksi_komisi'    => 'required|string',
        'alamat_instansi'       => 'required|string|max:500',
    ]);
    session(['step3_data' => $validated]);
    return redirect()->route('konfirmasi'); // langsung ke konfirmasi
})->name('form.tamu.store');

// Step 5: Konfirmasi
Route::get('/konfirmasi', fn(Request $request) => view('konfirmasi', [
    'step2Data' => $request->session()->get('step2_data', []),
    'step3Data' => $request->session()->get('step3_data', [])
]))->name('konfirmasi');
Route::post('/konfirmasi', function () {
    session(['submitted_at' => now()]);
    return redirect()->route('sukses'); // langsung ke sukses
})->name('konfirmasi.store');

// Step 6: Sukses
Route::get('/sukses', fn() => view('success'))->name('sukses');


// =======================
// LOGIN & LOGOUT ADMIN
// =======================
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// =======================
// ROUTE ADMIN (HARUS LOGIN)
// =======================
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/daftar-tamu', function () {
        return view('admin.daftar-tamu');
    })->name('admin.daftar-tamu');

    Route::get('/surat', function () {
        return view('admin.surat');
    })->name('admin.surat');

    Route::get('/admin', function () {
        return view('admin.admin');
    })->name('admin.admin');
});