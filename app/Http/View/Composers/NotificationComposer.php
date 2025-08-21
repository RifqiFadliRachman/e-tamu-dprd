<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Tamu;
use Illuminate\Support\Collection;

class NotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Ambil 5 tamu terbaru
        $newTamu = Tamu::latest()->take(5)->get()->map(function ($tamu) {
            $tamu->notification_type = 'tamu';
            return $tamu;
        });

        // Ambil 5 surat terbaru
        $newSurat = Tamu::where(function ($query) {
            $query->whereNotNull('surat_permohonan_path')
                  ->orWhereNotNull('surat_tugas_path');
        })
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($tamu) {
            $tamu->notification_type = 'surat';
            return $tamu;
        });

        // Gabungkan, urutkan berdasarkan tanggal terbaru, dan ambil 5 teratas
        $notifications = $newTamu->merge($newSurat)
                                 ->sortByDesc('created_at')
                                 ->unique('id') // Hindari duplikat jika satu tamu muncul di kedua query
                                 ->take(5);

        // Hitung total notifikasi yang belum dibaca (logika ini bisa dikembangkan)
        $totalNotifications = $notifications->count();

        // Kirim data ke view
        $view->with('notifications', $notifications)
             ->with('totalNotifications', $totalNotifications);
    }
}
