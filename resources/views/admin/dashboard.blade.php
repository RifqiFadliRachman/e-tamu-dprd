<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <aside class="w-64 bg-white border-r shadow-md flex flex-col">
            <div class="flex items-center p-4 border-b">
                <img src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="w-10 h-10 mr-2">
                <span class="font-bold text-3xl text-[#E8BF6F]">Dashboard</span>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/dashboard*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 22 24">
                        <path
                            d="M0 9.6V24H7.85714V17.6C7.85714 15.8327 9.26425 14.4 11 14.4C12.7358 14.4 14.1429 15.8327 14.1429 17.6V24H22V9.6L11 0L0 9.6Z" />
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('admin.daftar-tamu') }}"
                    class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/daftar-tamu*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" />
                    </svg>
                    Daftar Tamu
                </a>
                <a href="{{ route('admin.surat') }}"
                    class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/surat*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm1 1l5 3.5L17 7H7z" />
                    </svg>
                    Surat
                </a>
                <a href="{{ route('admin.admin') }}"
                    class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/admin*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 22 24">
                        <path
                            d="M0 9.6V24H7.85714V17.6C7.85714 15.8327 9.26425 14.4 11 14.4C12.7358 14.4 14.1429 15.8327 14.1429 17.6V24H22V9.6L11 0L0 9.6Z" />
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Beranda</h1>
                        <p class="text-sm text-gray-500">Melihat total list tamu, kunjungan kerja, kunjungan tamu,
                            kunjungan lainnya</p>
                    </div>
                </div>
                {{-- ================================================================= --}}
    {{-- ================================================================= --}}
    {{-- KODE HEADER FINAL (NOTIFIKASI + PROFIL DENGAN NAMA) --}}
    {{-- ================================================================= --}}
    <div class="flex items-center gap-5">
        <button class="relative text-gray-500 hover:text-gray-800 transition-colors">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="absolute top-0.5 right-0.5 h-2 w-2 bg-red-500 rounded-full border border-white"></span>
        </button>

        <div x-data="{ open: false }" class="relative">
            <div @click="open = !open" class="flex items-center gap-3 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold uppercase ring-2 ring-offset-2 ring-gray-300 hover:ring-[#E8BF6F] transition-all">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="hidden md:inline font-medium text-gray-700">Halo, {{ Auth::user()->name }}</span>
            </div>

            <div x-show="open" 
                 @click.outside="open = false" 
                 x-transition:enter="transition ease-out duration-200" 
                 x-transition:enter-start="opacity-0 transform -translate-y-2" 
                 x-transition:enter-end="opacity-100 transform translate-y-0" 
                 x-transition:leave="transition ease-in duration-150" 
                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                 x-transition:leave-end="opacity-0 transform -translate-y-2" 
                 class="absolute right-0 mt-3 w-64 bg-[#2D2D2D] text-white rounded-xl shadow-lg p-4 z-50"
                 style="display: none;">

                <div class="flex items-center gap-4 border-b border-gray-600 pb-3 mb-3">
                    <div class="w-12 h-12 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center text-gray-300 font-bold text-xl uppercase border-2 border-gray-400">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-semibold">{{ Auth::user()->name }}</h3>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-200 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200 flex items-center gap-3">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
            </header>

            <main class="p-6 overflow-y-auto">
                <div class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-white shadow p-4 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3 text-green-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" />
                        </svg>
                        <div>
                            <p class="text-gray-500">Total Daftar Tamu</p>
                            <p class="text-2xl font-bold">{{ $allGuests->count() }}</p>
                        </div>
                    </div>

                    <div class="bg-white shadow p-4 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3 text-blue-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" />
                        </svg>
                        <div>
                            <p class="text-gray-500">Kunjungan Kerja</p>
                            <p class="text-2xl font-bold">
                                {{ $allGuests->where('jenis_kunjungan', 'kunjungan_kerja')->count() }}</p>
                        </div>
                    </div>

                    <div class="bg-white shadow p-4 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3 text-yellow-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" />
                        </svg>
                        <div>
                            <p class="text-gray-500">Kunjungan Tamu</p>
                            <p class="text-2xl font-bold">
                                {{ $allGuests->where('jenis_kunjungan', 'kunjungan_tamu')->count() }}</p>
                        </div>
                    </div>

                    <div class="bg-white shadow p-4 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3 text-red-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" />
                        </svg>
                        <div>
                            <p class="text-gray-500">Kunjungan Lainnya</p>
                            <p class="text-2xl font-bold">
                                {{ $allGuests->whereNotIn('jenis_kunjungan', ['kunjungan_kerja', 'kunjungan_tamu'])->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-4 mb-4">
                    <div class="relative w-full flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="searchInput" name="search" placeholder="Cari nama tamu"
                            value="{{ request('search') }}"
                            class="flex-1 border border-gray-300 rounded-full pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#E8BF6F] focus:border-[#E8BF6F]">
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-2 font-semibold text-lg text-[black]">Daftar Tamu Terbaru</div>
                    <table class="w-full border-collapse text-center">
                        <thead class="text-[#E8BF6F] uppercase">
                            <tr>
                                <th class="border px-4 py-2">Id</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Nomor Kontak</th>
                                <th class="border px-4 py-2">Jenis Kunjungan</th>
                                <th class="border px-4 py-2">Jumlah Tamu</th>
                            </tr>
                        </thead>
                        <tbody id="tamuTableBody">
                           @include('admin.partials.tamu-table', ['daftarTamu' => $daftarTamu])
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('tamuTableBody');
            let searchTimeout;

            searchInput.addEventListener('input', function () {
                const query = this.value;

                // Hapus timeout sebelumnya untuk debounce
                clearTimeout(searchTimeout);

                // Atur timeout baru
                searchTimeout = setTimeout(() => {
                    fetch(`{{ route('admin.tamu.search') }}?search=${encodeURIComponent(query)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.text();
                        })
                        .then(html => {
                            tableBody.innerHTML = html;
                        })
                        .catch(error => {
                            console.error('Error fetching search results:', error);
                            tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Terjadi kesalahan saat memuat data.</td></tr>';
                        });
                }, 300); // Waktu tunda 300ms sebelum mengirim request
            });
        });
    </script>
</body>

</html>
