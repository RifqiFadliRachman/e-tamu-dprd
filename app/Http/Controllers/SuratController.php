<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * Menampilkan daftar surat yang telah diunggah.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil data tamu yang memiliki setidaknya satu surat
        $tamusWithSurat = Tamu::query()
            ->where(function ($query) {
                $query->whereNotNull('surat_permohonan_path')
                      ->orWhereNotNull('surat_tugas_path');
            })
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.surat', compact('tamusWithSurat', 'search'));
    }

    /**
     * Menghapus file surat (permohonan atau tugas).
     */
    public function destroy(Tamu $tamu, Request $request)
    {
        $tipeSurat = $request->input('tipe');

        if ($tipeSurat === 'permohonan' && $tamu->surat_permohonan_path) {
            Storage::disk('public')->delete($tamu->surat_permohonan_path);
            $tamu->surat_permohonan_path = null;
            $tamu->save();
            return back()->with('success', 'Surat permohonan berhasil dihapus.');
        }

        if ($tipeSurat === 'tugas' && $tamu->surat_tugas_path) {
            Storage::disk('public')->delete($tamu->surat_tugas_path);
            $tamu->surat_tugas_path = null;
            $tamu->save();
            return back()->with('success', 'Surat tugas berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus surat.');
    }
}
