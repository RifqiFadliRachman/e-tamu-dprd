<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * Menampilkan halaman Surat dengan data yang bisa dicari.
     */
    public function index(Request $request): View
    {
        $query = Tamu::where(function ($q) {
            $q->whereNotNull('surat_permohonan_path')
              ->orWhereNotNull('surat_tugas_path');
        });

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('nama', 'like', '%' . $searchTerm . '%');
        }

        $tamusWithSurat = $query->latest()->paginate(10);

        return view('admin.surat', compact('tamusWithSurat'));
    }

    /**
     * Menangani permintaan pencarian live untuk halaman surat (AJAX).
     */
    public function search(Request $request): View
    {
        $query = Tamu::where(function ($q) {
            $q->whereNotNull('surat_permohonan_path')
              ->orWhereNotNull('surat_tugas_path');
        });

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('nama', 'like', '%' . $searchTerm . '%');
        }

        // --- PERUBAHAN DI SINI: Gunakan 'tamusWithSurat' agar konsisten ---
        $tamusWithSurat = $query->latest()->paginate(10);

        return view('admin.partials.surat-content', compact('tamusWithSurat'));
    }

    /**
     * Menghapus file surat yang dipilih.
     */
    public function destroy(Request $request, Tamu $tamu)
    {
        if ($request->input('tipe') === 'permohonan' && $tamu->surat_permohonan_path) {
            Storage::disk('public')->delete($tamu->surat_permohonan_path);
            $tamu->surat_permohonan_path = null;
        }

        if ($request->input('tipe') === 'tugas' && $tamu->surat_tugas_path) {
            Storage::disk('public')->delete($tamu->surat_tugas_path);
            $tamu->surat_tugas_path = null;
        }

        $tamu->save();

        return back()->with('success', 'Surat berhasil dihapus.');
    }
}
