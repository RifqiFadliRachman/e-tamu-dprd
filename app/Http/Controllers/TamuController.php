<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon; // Import Carbon untuk menangani waktu

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
            'status' => 'belum_di_proses',
            'keterangan' => null, // Inisialisasi keterangan
            'status_updated_at' => null, // Inisialisasi timestamp
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

        // Menyimpan data status dan waktu perubahannya
        $tamu->update([
            'status' => $request->status,
            'status_updated_at' => Carbon::now() // Menggunakan waktu saat ini
        ]);

        return redirect()->route('admin.daftar-tamu')->with('success', 'Status tamu berhasil diperbarui.');
    }

    /**
     * Mengupdate keterangan tamu.
     */
    public function updateKeterangan(Request $request, Tamu $tamu): RedirectResponse
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
        ]);

        $tamu->update(['keterangan' => $request->keterangan]);

        return back()->with('success', 'Keterangan berhasil disimpan.');
    }
}
