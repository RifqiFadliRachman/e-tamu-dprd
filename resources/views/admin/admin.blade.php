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
            <header class="bg-white flex justify-between items-center py-4 px-6 border-b">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" /></svg>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Admin</h1>
                        <p class="text-sm text-gray-500">Daftar admin yang terdaftar</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <button class="relative text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg></button>
                    
                    {{-- AWAL PERUBAHAN --}}
                    <div x-data="{ open: false }" class="relative flex items-center gap-3">
                        <div @click="open = !open" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold cursor-pointer uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span @click="open = !open" class="cursor-pointer">Halo, {{ Auth::user()->name }}</span>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-12 w-32 bg-white border rounded shadow-lg py-2 z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                    {{-- AKHIR PERUBAHAN --}}
                    
                </div>
            </header>

            <main class="flex-1 p-6">

                {{-- BLOK NOTIFIKASI SUKSES --}}
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- AKHIR BLOK NOTIFIKASI --}}

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <form method="GET" action="{{ route('admin.admin') }}" class="relative w-1/3">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></div>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama admin" class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#E8BF6F]/50 focus:border-[#E8BF6F] placeholder-gray-400 text-gray-700">
                        </form>
                        <a href="{{ route('admin.create') }}" class="bg-[#E8BF6F] text-white font-semibold px-6 py-2 rounded-full hover:opacity-90">
                            Tambah Pengguna
                        </a>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Admin</h2>
                        <div class="grid grid-cols-3 text-sm font-semibold text-[#E8BF6F] mb-2">
                            <span>Nama</span>
                            <span>Alamat Email</span>
                            <span class="text-right pr-10">Aksi</span>
                        </div>
                        <div class="border rounded-lg divide-y divide-gray-200">
                            @forelse($users as $user)
                                <div class="grid grid-cols-3 items-center p-3 hover:bg-[#FFF8E7]">
                                    <div class="flex items-center gap-3 text-gray-800">
                                        <span class="p-2 bg-gray-200 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg></span>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                    <span class="text-gray-600">{{ $user->email }}</span>
                                    <div class="flex items-center gap-3 justify-end">
                                        <a href="{{ route('admin.edit', $user) }}" class="text-gray-500 hover:text-black-700">
                                            <svg width="30" height="30" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#3E9E66" /><path d="M26 16.8V26H10V10H19.2L21.2 8H8V28H28V14.8L26 16.8Z" fill="white" /><path d="M20.5 18.3L17 19L17.7 15.5L27.6 5.6C28.4 4.8 29.6 4.8 30.4 5.6C31.2 6.4 31.2 7.6 30.4 8.4L20.5 18.3Z" stroke="white" stroke-width="2" stroke-miterlimit="10" /></svg>
                                        </a>
                                        <form action="{{ route('admin.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg width="30" height="30" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#FF0000" fill-opacity="0.65" /><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 6V8.3H7V10.6H29V8.3H23.5V6H12.5ZM8.375 11.75H11.125V26.2236L11.6945 26.7H24.3054L24.875 26.2236V11.75H27.625V27.1764L25.4446 29H10.5555L8.375 27.1764V11.75Z" fill="white" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="p-3 text-center text-gray-500">Tidak ada pengguna yang ditemukan.</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>