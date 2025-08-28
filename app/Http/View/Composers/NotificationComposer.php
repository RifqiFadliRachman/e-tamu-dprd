<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Tamu;
use Illuminate\Support\Collection;

class NotificationComposer
{
    /**
     * Bind data ke view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Ambil 5 tamu terbaru yang belum dibaca
        $newTamu = Tamu::whereNull('read_at')->latest()->take(10)->get()->map(function ($tamu) {
            $tamu->notification_type = 'tamu';
            return $tamu;
        });

        // Ambil 5 surat terbaru yang belum dibaca
        $newSurat = Tamu::whereNull('read_at')->where(function ($query) {
            $query->whereNotNull('surat_permohonan_path')
                  ->orWhereNotNull('surat_tugas_path');
        })
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($tamu) {
            $tamu->notification_type = 'surat';
            return $tamu;
        });

        // Gabungkan, urutkan berdasarkan tanggal terbaru, dan ambil 10 teratas
        $notifications = $newTamu->merge($newSurat)
                                  ->sortByDesc('created_at')
                                  ->unique('id') // Hindari duplikat jika satu tamu muncul di kedua query
                                  ->take(10);

        // Hitung total notifikasi yang belum dibaca
        $totalNotifications = Tamu::whereNull('read_at')->count();

        // Kirim data ke view
        $view->with('notifications', $notifications)
             ->with('totalNotifications', $totalNotifications);
    }
}
