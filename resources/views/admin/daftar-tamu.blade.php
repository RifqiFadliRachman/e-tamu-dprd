<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 font-sans">

    {{-- Root element untuk Alpine.js --}}
    <div x-data="{ 
        showModal: false, 
        detailTamu: {},
        async openDetail(id) {
            try {
                const response = await fetch(`/admin/tamu/${id}`);
                if (!response.ok) throw new Error('Gagal mengambil data');
                const data = await response.json();
                this.detailTamu = data;
                this.showModal = true;
            } catch (error) {
                console.error('Error:', error);
                alert('Tidak dapat memuat detail tamu.');
            }
        },
        formatJenisKunjungan(jenis) {
            if (!jenis) return '-';
            return jenis.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        },
        formatDate(dateString) {
            if (!dateString) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric', timeZone: 'Asia/Jakarta' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        },
        formatTime(timeString) {
            if (!timeString) return '-';
            return `${timeString} WIB`;
        }
     }">
        <div class="flex h-screen">
            <aside class="w-64 bg-white border-r shadow-md flex flex-col">
                <div class="flex items-center p-4 border-b">
                    <img src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="w-10 h-10 mr-2">
                    <span class="font-bold text-3xl text-[#E8BF6F]">Dashboard</span>
                </div>
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/dashboard*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 22 24"><path d="M0 9.6V24H7.85714V17.6C7.85714 15.8327 9.26425 14.4 11 14.4C12.7358 14.4 14.1429 15.8327 14.1429 17.6V24H22V9.6L11 0L0 9.6Z" /></svg>
                        Beranda
                    </a>
                    <a href="{{ route('admin.daftar-tamu') }}"
                        class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/daftar-tamu*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" /></svg>
                        Daftar Tamu
                    </a>
                    <a href="{{ route('admin.surat') }}"
                        class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/surat*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm1 1l5 3.5L17 7H7z" /></svg>
                        Surat
                    </a>
                    <a href="{{ route('admin.admin') }}"
                        class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/admin*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" /></svg>
                        Admin
                    </a>
                </nav>
            </aside>

            <div class="flex-1 flex flex-col">
                <header class="bg-white flex justify-between items-center py-4 px-6 border-b">
                    <div class="flex items-center">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" /></svg>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">Daftar Tamu</h1>
                            <p class="text-sm text-gray-500">Melihat kunjungan kerja, kunjungan tamu, kunjungan lainnya</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <button class="relative text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg></button>
                        <div x-data="{ open: false }" class="relative flex items-center gap-3">
                            <div @click="open = !open" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold cursor-pointer uppercase">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span @click="open = !open" class="cursor-pointer">Halo, {{ Auth::user()->name }}</span>
                            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-12 w-32 bg-white border rounded shadow-lg py-2 z-50">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-6 overflow-y-auto">
                    <!-- Tabs -->
                    <div class="mb-4 border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <a href="{{ route('admin.daftar-tamu', ['filter' => 'semua']) }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm 
                   {{ !request('filter') || request('filter') == 'semua' ? 'border-[#E8BF6F] text-[#E8BF6F]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Semua
                            </a>
                            <a href="{{ route('admin.daftar-tamu', ['filter' => 'kunjungan_kerja']) }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm 
                   {{ request('filter') == 'kunjungan_kerja' ? 'border-[#E8BF6F] text-[#E8BF6F]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Kunjungan Kerja
                            </a>
                            <a href="{{ route('admin.daftar-tamu', ['filter' => 'kunjungan_tamu']) }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm 
                   {{ request('filter') == 'kunjungan_tamu' ? 'border-[#E8BF6F] text-[#E8BF6F]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Kunjungan Tamu
                            </a>
                            <a href="{{ route('admin.daftar-tamu', ['filter' => 'lainnya']) }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm 
                   {{ request('filter') == 'lainnya' ? 'border-[#E8BF6F] text-[#E8BF6F]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Lainnya
                            </a>
                        </nav>
                    </div>

                    <!-- Search -->
                    <div class="mb-4">
                        <form action="{{ route('admin.daftar-tamu') }}" method="GET">
                            <input type="hidden" name="filter" value="{{ request('filter', 'semua') }}">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" placeholder="Cari nama tamu"
                                    value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-full leading-5 
                                      bg-white placeholder-gray-400 focus:outline-none 
                                      focus:ring-1 focus:ring-[#E8BF6F] focus:border-[#E8BF6F] sm:text-sm">
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <table class="w-full border-collapse text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    {{-- AWAL PERUBAHAN HEADER TABEL --}}
                                    <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">ID</th>
                                    <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">NAMA</th>
                                    <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">ASAL INSTANSI</th>
                                    <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">NOMOR KONTAK</th>
                                    <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">JENIS KUNJUNGAN</th>
                                    <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">JUMLAH TAMU</th>
                                    {{-- AKHIR PERUBAHAN HEADER TABEL --}}
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($daftarTamu as $tamu)
                                <tr @click="openDetail({{ $tamu->id }})" class="hover:bg-[#FFF4E0] transition-colors duration-200 cursor-pointer">
                                    {{-- AWAL PERUBAHAN ISI TABEL --}}
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->nama }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->instansi }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->nomor_kontak }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ Str::title(str_replace('_', ' ', $tamu->jenis_kunjungan)) }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->jumlah_peserta }}</td>
                                    {{-- AKHIR PERUBAHAN ISI TABEL --}}
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-sm text-gray-500">
                                        Tidak ada data tamu untuk kriteria ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Custom Pagination -->
                        <div class="flex justify-end items-center p-4 space-x-2">
                            {{ $daftarTamu->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </main>

            </div>
        </div>

        <!-- MODAL / POPUP DETAIL TAMU -->
        <div x-show="showModal" @keydown.escape.window="showModal = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
            <div @click.outside="showModal = false" class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Detail Tamu</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Nama Penanggung Jawab</label>
                        <p x-text="detailTamu.nama || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Asal Instansi</label>
                        <p x-text="detailTamu.instansi || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                     <div>
                        <label class="text-sm font-semibold text-gray-500">Posisi / Jabatan</label>
                        <p x-text="detailTamu.jabatan || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Nomor Kontak (WhatsApp)</label>
                        <p x-text="detailTamu.nomor_kontak || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                     <div>
                        <label class="text-sm font-semibold text-gray-500">Tanggal Kunjungan</label>
                        <p x-text="formatDate(detailTamu.tanggal_kunjungan)" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Waktu Kunjungan</label>
                        <p x-text="formatTime(detailTamu.waktu_kunjungan)" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Tipe Kunjungan</label>
                        <p x-text="formatJenisKunjungan(detailTamu.jenis_kunjungan)" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Tujuan Kunjungan</label>
                        <p x-text="detailTamu.tujuan_kunjungan || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Jumlah Tamu</label>
                        <p x-text="detailTamu.jumlah_peserta || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
