<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import class View
use App\Http\View\Composers\NotificationComposer; // Import composer yang baru dibuat

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menerapkan NotificationComposer ke semua view di dalam direktori 'admin'
        // Ini akan membuat variabel $totalNotifications tersedia di semua halaman admin.
        View::composer('admin.*', NotificationComposer::class);
    }
}
