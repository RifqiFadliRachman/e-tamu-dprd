<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus user lama jika ada untuk menghindari duplikat
        User::query()->delete();

        // Buat user admin baru
        User::create([
            'name' => 'Admin DPRD',
            'email' => 'admin@dprd.test',
            'password' => Hash::make('password'), // Passwordnya adalah 'password'
        ]);
    }
}
