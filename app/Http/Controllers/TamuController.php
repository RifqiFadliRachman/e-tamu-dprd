<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class TamuController extends Controller
{
    /**
     * Menyimpan data dari semua langkah formulir ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $step2Data = Session::get('step2_data', []);
        $step3Data = Session::get('step3_data', []);

        $dataToSave = [
            'nama' => $step3Data['nama_penanggung_jawab'] ?? 'Data tidak ada',
            'instansi' => $step3Data['alamat_instansi'] ?? 'Data tidak ada',
            'jabatan' => $step3Data['posisi_jabatan'] ?? 'Data tidak ada',
            'nomor_kontak' => $step3Data['nomor_kontak'] ?? 'Data tidak ada',
            'jenis_kunjungan' => $step2Data['jenis_kunjungan'] ?? 'Data tidak ada',
            'jumlah_peserta' => $step2Data['jumlah_peserta'] ?? 1,
        ];

        Tamu::create($dataToSave);

        Session::forget(['step2_data', 'step3_data', 'surat_pemberitahuan_path', 'surat_tugas_path', 'intro_seen']);
        Session::put('submitted_at', now());

        return redirect()->route('sukses');
    }

    /**
     * Menampilkan data tamu di dashboard admin.
     */
    public function dashboard(Request $request): View
    {
        // Data untuk kartu ringkasan (selalu mengambil semua data)
        $allGuests = Tamu::all();

        // Query untuk tabel (bisa difilter dengan pencarian)
        $query = Tamu::query();

        // Logika untuk pencarian berdasarkan nama
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('nama', 'like', '%' . $searchTerm . '%');
        }

        // Ambil data untuk tabel, urutkan dari yang terbaru
        $daftarTamu = $query->latest()->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.dashboard', [
            'daftarTamu' => $daftarTamu, // Untuk tabel
            'allGuests' => $allGuests,   // Untuk kartu ringkasan
        ]);
    }

    /**
     * Menampilkan halaman Daftar Tamu dengan data yang bisa difilter dan dicari.
     */
    public function showDaftarTamu(Request $request): View
    {
        $query = Tamu::query();

        if ($request->has('filter') && $request->filter != 'semua') {
            $filterValue = $request->filter;
            if ($filterValue === 'lainnya') {
                $query->whereNotIn('jenis_kunjungan', ['kunjungan_kerja', 'kunjungan_tamu']);
            } else {
                $query->where('jenis_kunjungan', $filterValue);
            }
        }

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('nama', 'like', '%' . $searchTerm . '%');
        }

        $daftarTamu = $query->latest()->paginate(10);

        return view('admin.daftar-tamu', [
            'daftarTamu' => $daftarTamu
        ]);
    }
}
