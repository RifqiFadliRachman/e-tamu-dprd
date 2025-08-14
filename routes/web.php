<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- TAHAP 0 & 1: Halaman Awal & Login ---
Route::get('/', fn() => view('intro'))->name('home');
Route::get('/login', fn() => view('index'))->name('index');

// =======================================================
// === TAMBAHKAN BLOK KODE INI UNTUK MEMPERBAIKI ERROR ===
// =======================================================
// Route untuk halaman pemilihan jadwal (Tahap 1.5)
Route::get('/jadwal-kunjungan', function () {
    // Pastikan Anda punya file view bernama 'schedule.blade.php'
    return view('schedule'); 
})->name('jadwal.kunjungan');
// Route POST untuk menyimpan pilihan jadwal ke session (masuk ke step2_data supaya konsisten)
Route::post('/jadwal-kunjungan', function (Request $request) {
    $validated = $request->validate([
        'tanggal_kunjungan' => 'required|date',
        'waktu_kunjungan'   => 'required|string'
    ]);

    $existing = $request->session()->get('step2_data', []);
    $request->session()->put('step2_data', array_merge($existing, $validated));

    return redirect()->route('detail.kunjungan');
})->name('jadwal.kunjungan.store');
// =======================================================


// --- TAHAP 2: Detail Kunjungan ---
Route::get('/detail-kunjungan', function (Request $request) {
    // Ambil data session agar form bisa terisi jika user kembali ke halaman ini
    $step2Data = $request->session()->get('step2_data', []);
    return view('details', compact('step2Data'));
})->name('detail.kunjungan');


Route::post('/detail-kunjungan', function (Request $request) {
    // Validasi semua input, TERMASUK tanggal dan waktu
    $validated = $request->validate([
        'jenis_kunjungan'     => 'required|string',
        'topik_kunjungan'     => 'required|string|max:255',
        'jumlah_peserta'      => 'required|integer|min:1',
        'surat_pemberitahuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tugas'         => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'tanggal_kunjungan'   => 'required|date',
        'waktu_kunjungan'     => 'required|string',
    ]);
    // PENTING: Jangan simpan objek UploadedFile ke session (menyebabkan error serialisasi)
    $existing = $request->session()->get('step2_data', []);
    // Bersihkan kemungkinan sisa file object sebelumnya
    unset($existing['surat_pemberitahuan'], $existing['surat_tugas']);

    // Ambil hanya field non-file untuk session
    $sessionData = $validated;
    unset($sessionData['surat_pemberitahuan'], $sessionData['surat_tugas']);

    session(['step2_data' => array_merge($existing, $sessionData)]);

    if ($request->hasFile('surat_pemberitahuan')) {
        $path = $request->file('surat_pemberitahuan')->store('documents', 'public');
        session(['surat_pemberitahuan_path' => $path]);
    }
    if ($request->hasFile('surat_tugas')) {
        $path = $request->file('surat_tugas')->store('documents', 'public');
        session(['surat_tugas_path' => $path]);
    }

    // Lanjut ke Tahap 3
    return redirect()->route('form.tamu');
})->name('detail.kunjungan.store');


// --- TAHAP 3: Formulir Instansi ---
Route::get('/form-tamu', function(Request $request) {
    $step3Data = $request->session()->get('step3_data', []);
    return view('form', compact('step3Data'));
})->name('form.tamu');

Route::post('/form-tamu', function (Request $request) {
    $validated = $request->validate([
        'nama_penanggung_jawab' => 'required|string|max:255',
        'posisi_jabatan'        => 'required|string',
        'nomor_kontak'          => 'required|string|regex:/^[0-9]{10,15}$/',
        'nama_fraksi_komisi'    => 'required|string',
        'alamat_instansi'       => 'required|string|max:500',
    ]);

    session(['step3_data' => $validated]);

    // Lanjut ke Tahap 4 (Konfirmasi)
    return redirect()->route('konfirmasi');
})->name('form.tamu.store');


// --- TAHAP 4: Halaman Konfirmasi ---
Route::get('/konfirmasi', function (Request $request) {
    $step2Data = $request->session()->get('step2_data', []);
    $step3Data = $request->session()->get('step3_data', []);

    if (empty($step2Data) || empty($step3Data)) {
        return redirect()->route('detail.kunjungan')->with('error', 'Silakan lengkapi data dari tahap sebelumnya.');
    }

    return view('konfirmasi', compact('step2Data', 'step3Data'));
})->name('konfirmasi');

Route::post('/konfirmasi', function () {
    // Logika untuk menyimpan ke database
    // JANGAN hapus session agar pengguna bisa kembali ke Tahap 4 dari halaman sukses.
    // Jika ingin mencegah double submit, bisa set flag:
    session(['submitted_at' => now()]);
    return redirect()->route('sukses')->with('success', 'Pendaftaran kunjungan berhasil disubmit!');
})->name('konfirmasi.store');


// --- TAHAP 5: Halaman Sukses ---
Route::get('/sukses', fn() => view('success'))->name('sukses');