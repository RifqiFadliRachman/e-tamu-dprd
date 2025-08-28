<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Menandai satu notifikasi sebagai sudah dibaca.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id)
    {
        // Temukan notifikasi berdasarkan ID
        $notification = Tamu::find($id);
        
        // Jika notifikasi ditemukan, update kolom read_at
        if ($notification) {
            $notification->update(['read_at' => now()]);
        }

        // Kembalikan ke halaman sebelumnya
        return back()->with('success', 'Notifikasi telah ditandai sebagai sudah dibaca.');
    }

    /**
     * Menandai semua notifikasi yang belum dibaca sebagai sudah dibaca.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead()
    {
        // Update semua notifikasi yang belum dibaca dan set read_at menjadi waktu sekarang
        Tamu::whereNull('read_at')->update(['read_at' => now()]);

        // Kembalikan ke halaman sebelumnya
        return back()->with('success', 'Semua notifikasi telah ditandai sebagai sudah dibaca.');
    }
}
