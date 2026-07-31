<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TamuController extends Controller
{
    // ==========================================================
    // LOGIKA TAHAPAN FORMULIR (USER TAMU)
    // ==========================================================

    /**
     * Tahap 1: Menampilkan halaman jadwal kunjungan.
     */
    public function showJadwal(): View
    {
        return view('schedule');
    }

    /**
     * Tahap 1: Menyimpan pilihan jadwal ke session.
     * [DIPERBARUI] Menambahkan validasi penolakan Sabtu/Minggu dan jam 08:00-16:00.
     */
    public function submitJadwal(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal_kunjungan' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (\Carbon\Carbon::parse($value)->isWeekend()) {
                        $fail('Kunjungan tidak dapat dilakukan pada hari libur (Sabtu & Minggu).');
                    }
                }
            ],
            'waktu_kunjungan' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $time = strtotime($value);
                    $start = strtotime('08:00');
                    $end = strtotime('16:00');
                    if ($time < $start || $time > $end) {
                        $fail('Waktu kunjungan harus antara pukul 08:00 hingga 16:00 WIB.');
                    }
                }
            ]
        ]);

        $request->session()->put('step2_data', $validated);
        return redirect()->route('detail.kunjungan');
    }

    /**
     * Tahap 2: Menampilkan halaman detail kunjungan.
     */
    public function showDetailKunjungan(Request $request): View
    {
        return view('details', [
            'step2Data' => $request->session()->get('step2_data', [])
        ]);
    }

    /**
     * Tahap 2: Menyimpan detail kunjungan dan file ke session.
     */
    public function submitDetailKunjungan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jenis_kunjungan' => 'required|string',
            'topik_kunjungan' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'surat_pemberitahuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tanggal_kunjungan' => 'required|date',
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
    }

    /**
     * Tahap 3: Menampilkan halaman formulir instansi/tamu.
     */
    public function showFormTamu(Request $request): View
    {
        return view('form', [
            'step3Data' => $request->session()->get('step3_data', [])
        ]);
    }

    /**
     * Tahap 3: Menyimpan data instansi ke session.
     */
    public function submitFormTamu(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_penanggung_jawab' => 'required|string|max:255',
            'posisi_jabatan' => 'required|string',
            'nomor_kontak' => 'required|string|regex:/^[0-9]{10,15}$/',
            'nama_fraksi_komisi' => 'required|string',
            'alamat_instansi' => 'required|string|max:500',
        ]);

        session(['step3_data' => $validated]);
        return redirect()->route('konfirmasi');
    }

    /**
     * Tahap 4: Menampilkan halaman konfirmasi data.
     */
    public function showKonfirmasi(Request $request): View
    {
        return view('konfirmasi', [
            'step2Data' => $request->session()->get('step2_data', []),
            'step3Data' => $request->session()->get('step3_data', [])
        ]);
    }

    /**
     * Final: Menyimpan data ke database.
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
            'tanggal_kunjungan' => $step2Data['tanggal_kunjungan'] ?? null,
            'waktu_kunjungan' => $step2Data['waktu_kunjungan'] ?? null,
            'tujuan_kunjungan' => $step2Data['topik_kunjungan'] ?? 'Tujuan tidak diisi',
            'surat_permohonan_path' => Session::get('surat_pemberitahuan_path'),
            'surat_tugas_path' => Session::get('surat_tugas_path'),
        ];

        Tamu::create($dataToSave);

        // Session::forget dikomentari agar data tetap ada saat kembali ke halaman konfirmasi
        // Session::forget(['step2_data', 'step3_data', 'surat_pemberitahuan_path', 'surat_tugas_path']);
        
        Session::put('submitted_at', now());

        return redirect()->route('sukses');
    }

    // ==========================================================
    // LOGIKA ADMIN & DASHBOARD
    // ==========================================================

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

        return view('admin.dashboard', compact('daftarTamu', 'allGuests'));
    }

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
        return view('admin.daftar-tamu', compact('daftarTamu'));
    }

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
        return view('admin.partials.daftar-tamu-content', compact('daftarTamu'));
    }

    public function showDetail(Tamu $tamu): JsonResponse
    {
        return response()->json($tamu);
    }

    public function destroy(Tamu $tamu): RedirectResponse
    {
        $tamu->delete();
        return redirect()->route('admin.daftar-tamu')->with('success', 'Data tamu berhasil dihapus.');
    }

    public function updateStatus(Request $request, Tamu $tamu): RedirectResponse
    {
        $request->validate(['status' => 'required|string|in:belum_di_proses,di_proses,di_terima,di_tolak']);
        $tamu->update(['status' => $request->status, 'status_updated_at' => Carbon::now()]);
        return redirect()->route('admin.daftar-tamu')->with('success', 'Status tamu berhasil diperbarui.');
    }

    public function updateKeterangan(Request $request, Tamu $tamu): RedirectResponse
    {
        $request->validate(['keterangan' => 'nullable|string|max:255']);
        $tamu->update(['keterangan' => $request->keterangan]);
        return back()->with('success', 'Keterangan berhasil disimpan.');
    }
}