{{-- resources/views/admin/daftar-tamu.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Custom color for Tailwind CSS */
        .bg-custom-gold {
            background-color: #E8BF6F;
        }

        .text-custom-gold {
            color: #E8BF6F;
        }

        .border-custom-gold {
            border-color: #E8BF6F;
        }

        .bg-custom-dark {
            background-color: #2D2D2D;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r shadow-md flex flex-col">
            <!-- Logo & Judul -->
            <div class="flex items-center p-4 border-b">
                <img src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="w-10 h-10 mr-2">
                <span class="font-bold text-3xl text-[#E8BF6F]">Dashboard</span>
            </div>

            <!-- Menu -->
            <nav class="flex-1 p-4 space-y-2">
                <!-- Beranda -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg font-medium
               {{ Request::is('admin/dashboard*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 22 24">
                        <path
                            d="M0 9.6V24H7.85714V17.6C7.85714 15.8327 9.26425 14.4 11 14.4C12.7358 14.4 14.1429 15.8327 14.1429 17.6V24H22V9.6L11 0L0 9.6Z" />
                    </svg>
                    Beranda
                </a>

                <!-- Daftar Tamu -->
                <a href="{{ route('admin.daftar-tamu') }}"
                    class="flex items-center px-4 py-2 rounded-lg font-medium
               {{ Request::is('admin/daftar-tamu*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" />
                    </svg>
                    Daftar Tamu
                </a>

                <!-- Surat -->
                <a href="{{ route('admin.surat') }}" class="flex items-center px-4 py-2 rounded-lg font-medium
               {{ Request::is('admin/surat*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm1 1l5 3.5L17 7H7z" />
                    </svg>
                    Surat
                </a>

                <!-- Admin -->
                <a href="{{ route('admin.admin') }}" class="flex items-center px-4 py-2 rounded-lg font-medium
               {{ Request::is('admin/admin*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                    </svg>
                    Admin
                </a>
            </nav>

        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white flex justify-between items-center py-4 px-6 border-b">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Daftar Tamu</h1>
                        <p class="text-sm text-gray-500">Melihat kunjungan kerja, kunjungan tamu, kunjungan lainnya</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <button class="relative text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative flex items-center gap-3">
                        <div @click="open = !open"
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold cursor-pointer">
                            F
                        </div>
                        <span @click="open = !open" class="cursor-pointer">Halo, Fitri</span>

                        <!-- Dropdown Logout -->
                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-12 w-32 bg-white border rounded shadow-lg py-2 z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>

                </div>
            </header>

            <main class="flex-1 p-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex gap-8 text-sm font-medium">
                            <button class="py-3 text-custom-gold border-b-2 border-custom-gold">Kunjungan Kerja</button>
                            <button class="py-3 text-gray-500 hover:text-custom-gold">Kunjungan Tamu</button>
                            <button class="py-3 text-gray-500 hover:text-custom-gold">Lainnya</button>
                        </nav>
                    </div>

                    <div class="py-4 mt-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Cari nama tamu" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg 
                   focus:outline-none focus:ring-2 focus:ring-[#E8BF6F]/50 focus:border-[#E8BF6F]">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-[#E8BF6F] font-bold uppercase">
                                <tr>
                                    <th class="py-3 px-4 border-b-2 border-gray-200">Id</th>
                                    <th class="py-3 px-4 border-b-2 border-gray-200">Nama</th>
                                    <th class="py-3 px-4 border-b-2 border-gray-200">Nomor Kontak</th>
                                    <th class="py-3 px-4 border-b-2 border-gray-200">Jenis Kunjungan</th>
                                    <th class="py-3 px-4 border-b-2 border-gray-200">Jumlah Tamu</th>
                                </tr>
                            </thead>

                            <tbody class="text-gray-700">
                                @for($i = 0; $i < 2; $i++)
                                    <tr class="hover:bg-[#E8BF6F]/20 transition-colors">
                                        <td class="py-3 px-4 border-b border-gray-200">01</td>
                                        <td class="py-3 px-4 border-b border-gray-200">George Frederik</td>
                                        <td class="py-3 px-4 border-b border-gray-200">0823828232</td>
                                        <td class="py-3 px-4 border-b border-gray-200">Kunjungan Tamu</td>
                                        <td class="py-3 px-4 border-b border-gray-200">1</td>
                                    </tr>
                                @endfor
                            </tbody>

                            <!-- Pagination di dalam tabel -->
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="py-3 px-4 border-t border-gray-200">
                                        <div class="flex justify-end items-center gap-3 text-sm text-gray-600">
                                            <button
                                                class="px-3 py-1 border border-gray-300 rounded-md bg-white hover:bg-gray-50">«</button>
                                            <span>Halaman</span>
                                            <input type="text" value="1"
                                                class="w-10 text-center border border-gray-300 rounded-md py-1">
                                            <button
                                                class="px-3 py-1 border border-gray-300 rounded-md bg-white hover:bg-gray-50">»</button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </main>
        </div>
    </div>

</body>

</html>