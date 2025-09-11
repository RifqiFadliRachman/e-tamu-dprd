<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        .bg-custom-gold { background-color: #E8BF6F; }
        .text-custom-gold { color: #E8BF6F; }
        .border-custom-gold { border-color: #E8BF6F; }
        .bg-custom-dark { background-color: #2D2D2D; }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-white border-r shadow-md flex flex-col">
            <div class="flex items-center p-4 border-b">
                <img src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="w-10 h-10 mr-2">
                <span class="font-bold text-3xl text-[#E8BF6F]">Dashboard</span>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/dashboard*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 22 24"><path d="M0 9.6V24H7.85714V17.6C7.85714 15.8327 9.26425 14.4 11 14.4C12.7358 14.4 14.1429 15.8327 14.1429 17.6V24H22V9.6L11 0L0 9.6Z" /></svg> Beranda
                </a>
                <a href="{{ route('admin.daftar-tamu') }}" class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/daftar-tamu*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-8c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-8 0c1.66 0 3 1.34 3 3S9.66 12 8 12 5 10.66 5 9s1.34-3 3-3z" /></svg> Daftar Tamu
                </a>
                <a href="{{ route('admin.surat') }}" class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/surat*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm1 1l5 3.5L17 7H7z" /></svg> Surat
                </a>
                <a href="{{ route('admin.admin') }}" class="flex items-center px-4 py-2 rounded-lg font-medium {{ Request::is('admin/admin*') ? 'bg-[#E8BF6F] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" /></svg> Admin
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            
            {{-- Menggunakan file partial header --}}
            @include('admin.partials._header', [
                'headerContent' => view('admin.partials._header-content-admin')
            ])

            <main class="flex-1 p-6">

                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                 @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <div class="relative w-1/3">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></div>
                            <input type="text" id="searchInputAdmin" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau email admin" class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#E8BF6F]/50 focus:border-[#E8BF6F] placeholder-gray-400 text-gray-700">
                        </div>
                        <a href="{{ route('admin.create') }}" class="bg-[#E8BF6F] text-white font-semibold px-6 py-2 rounded-full hover:opacity-90">
                            Tambah Pengguna
                        </a>
                    </div>

                    <div id="adminContentContainer">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Admin</h2>
                        @include('admin.partials.admin-content', ['users' => $users])
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInputAdmin');
            const contentContainer = document.getElementById('adminContentContainer');
            let searchTimeout;

            const fetchData = async (url) => {
                const header = contentContainer.querySelector('h2');
                const gridHeader = contentContainer.querySelector('.grid');
                if(header) header.remove();
                if(gridHeader) gridHeader.remove();

                contentContainer.style.opacity = '0.5';
                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    const html = await response.text();
                    
                    contentContainer.innerHTML = `
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Admin</h2>
                        ${html}
                    `;
                } catch (error) {
                    console.error('Fetch error:', error);
                    contentContainer.innerHTML = '<div class="p-4 text-center text-red-500">Gagal memuat data.</div>';
                } finally {
                    contentContainer.style.opacity = '1';
                }
            };

            const performSearch = (page = 1) => {
                const query = searchInput.value;
                const searchUrl = new URL('{{ route('admin.admin.search') }}');
                searchUrl.searchParams.set('search', query);
                searchUrl.searchParams.set('page', page);
                fetchData(searchUrl.toString());
            };

            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => performSearch(1), 300);
            });

            contentContainer.addEventListener('click', (event) => {
                const link = event.target.closest('a.page-link');
                if (link && link.href) {
                    event.preventDefault();
                    const url = new URL(link.href);
                    const page = url.searchParams.get('page');
                    if (page) {
                        performSearch(page);
                    }
                }
            });
        });
    </script>
</body>
</html>
