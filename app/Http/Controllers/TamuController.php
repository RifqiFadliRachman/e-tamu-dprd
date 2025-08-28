<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
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
            'status' => 'belum_di_proses', // Status default saat data baru dibuat
            'tanggal_kunjungan' => $step2Data['tanggal_kunjungan'] ?? null,
            'waktu_kunjungan' => $step2Data['waktu_kunjungan'] ?? null,
            'tujuan_kunjungan' => $step2Data['topik_kunjungan'] ?? 'Tujuan tidak diisi',
            'surat_permohonan_path' => Session::get('surat_pemberitahuan_path'),
            'surat_tugas_path' => Session::get('surat_tugas_path'),
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
        $allGuests = Tamu::all();
        $query = Tamu::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nomor_kontak', 'like', '%' . $searchTerm . '%')
                  ->orWhere('jenis_kunjungan', 'like', '%' . $searchTerm . '%');
            });
        }

        $daftarTamu = $query->latest()->get();

        return view('admin.dashboard', [
            'daftarTamu' => $daftarTamu,
            'allGuests' => $allGuests,
        ]);
    }

    /**
     * Menangani permintaan pencarian tamu secara live untuk dashboard.
     */
    public function search(Request $request): View
    {
        $query = Tamu::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nomor_kontak', 'like', '%' . $searchTerm . '%')
                  ->orWhere('jenis_kunjungan', 'like', '%' . $searchTerm . '%');
            });
        }

        $daftarTamu = $query->latest()->get();

        return view('admin.partials.tamu-table', compact('daftarTamu'));
    }

    /**
     * Menampilkan halaman Daftar Tamu (Pemuatan Awal).
     */
    public function showDaftarTamu(Request $request): View
    {
        $query = Tamu::query();

        // Logika Filter
        if ($request->has('filter') && $request->filter != 'semua') {
            $filterValue = $request->filter;
            if ($filterValue === 'lainnya') {
                $query->whereNotIn('jenis_kunjungan', ['kunjungan_kerja', 'kunjungan_tamu']);
            } else {
                $query->where('jenis_kunjungan', $filterValue);
            }
        }

        // Logika Pencarian
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nomor_kontak', 'like', '%' . $searchTerm . '%')
                  ->orWhere('jenis_kunjungan', 'like', '%' . $searchTerm . '%');
            });
        }

        $daftarTamu = $query->latest()->paginate(10);

        return view('admin.daftar-tamu', ['daftarTamu' => $daftarTamu]);
    }
    
    /**
     * Menangani permintaan pencarian live untuk halaman daftar tamu (AJAX).
     */
    public function searchDaftarTamu(Request $request): View
    {
        $query = Tamu::query();

        // Logika Filter
        if ($request->has('filter') && $request->filter != 'semua') {
            $filterValue = $request->filter;
            if ($filterValue === 'lainnya') {
                $query->whereNotIn('jenis_kunjungan', ['kunjungan_kerja', 'kunjungan_tamu']);
            } else {
                $query->where('jenis_kunjungan', $filterValue);
            }
        }

        // Logika Pencarian
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nomor_kontak', 'like', '%' . $searchTerm . '%')
                  ->orWhere('jenis_kunjungan', 'like', '%' . $searchTerm . '%');
            });
        }

        $daftarTamu = $query->latest()->paginate(10);

        return view('admin.partials.daftar-tamu-content', ['daftarTamu' => $daftarTamu]);
    }

    /**
     * Mengambil dan menampilkan detail seorang tamu dalam format JSON.
     */
    public function showDetail(Tamu $tamu): JsonResponse
    {
        return response()->json($tamu);
    }

    /**
     * Menghapus data tamu dari database.
     */
    public function destroy(Tamu $tamu): RedirectResponse
    {
        $tamu->delete();

        return redirect()->route('admin.daftar-tamu')->with('success', 'Data tamu berhasil dihapus.');
    }

    /**
     * Mengupdate status tamu.
     */
    public function updateStatus(Request $request, Tamu $tamu): RedirectResponse
    {
        $request->validate([
            'status' => 'required|string|in:belum_di_proses,di_proses,di_terima,di_tolak',
        ]);

        $tamu->update(['status' => $request->status]);

        return redirect()->route('admin.daftar-tamu')->with('success', 'Status tamu berhasil diperbarui.');
    }
}
