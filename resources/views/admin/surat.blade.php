<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Surat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Definisi warna kustom agar mudah digunakan kembali */
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm1 1l5 3.5L17 7H7z" />
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Manajemen Surat</h1>
                        <p class="text-sm text-gray-500">Detail Data Surat Masuk & Keluar</p>
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
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold cursor-pointer uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span @click="open = !open" class="cursor-pointer">Halo, {{ Auth::user()->name }}</span>

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

            <main class="flex-1 p-6 overflow-y-auto">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-300">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('admin.surat') }}" class="relative w-1/3 mb-4">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari berdasarkan nama tamu"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#E8BF6F]/50 focus:border-[#E8BF6F]">
                    </form>

                    <!-- Title -->
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Daftar Surat Tamu</h2>

                    <!-- Table Content -->
                    <div class="border rounded-md divide-y divide-gray-200">
                        @forelse ($tamusWithSurat as $tamu)
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $tamu->nama }}</p>
                                        <p class="text-sm text-gray-500">{{ $tamu->instansi }}</p>
                                        <p class="text-xs text-gray-400">Tanggal Pengajuan: {{ $tamu->created_at->isoFormat('D MMMM YYYY') }}</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        @if ($tamu->surat_permohonan_path)
                                          <div class="text-center">
    <p class="text-sm font-semibold">Surat Permohonan</p>
    <div class="flex gap-2 mt-1 justify-center">
        <!-- Tombol Lihat -->
        <a href="{{ Storage::url($tamu->surat_permohonan_path) }}" target="_blank" 
           class="p-1 rounded hover:opacity-80" 
           title="Lihat Surat">
            <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="36" height="35" fill="#386EF5"/>
                <g clip-path="url(#clip0_1118_769)">
                    <path d="M28.1509 13.4694C22.5278 8.24784 13.3791 8.24784 7.75588 13.4694L4 16.9565L7.84905 20.5306C10.6604 23.1412 14.3534 24.4469 18.0468 24.4469C21.7403 24.4469 25.4328 23.1416 28.2446 20.5306L32.0005 17.043L28.1509 13.4694ZM27.5753 19.9096C22.3211 24.7881 13.7721 24.7881 8.51784 19.9096L5.33757 16.9565L8.42466 14.0899C13.6789 9.21142 22.2279 9.21142 27.4822 14.0899L30.6624 17.043L27.5753 19.9096Z" fill="white"/>
                    <path d="M17.5139 13.4731C15.6883 13.4731 14.2031 14.8522 14.2031 16.5475C14.2031 16.7899 14.415 16.9867 14.6761 16.9867C14.9372 16.9867 15.1491 16.7899 15.1491 16.5475C15.1491 15.3366 16.2099 14.3515 17.5139 14.3515C17.775 14.3515 17.9869 14.1548 17.9869 13.9123C17.9869 13.6699 17.7755 13.4731 17.5139 13.4731Z" fill="white"/>
                    <path d="M17.9865 11.2773C14.5963 11.2773 11.8379 13.8387 11.8379 16.9868C11.8379 20.1349 14.5963 22.6963 17.9865 22.6963C21.3768 22.6963 24.1352 20.1349 24.1352 16.9868C24.1352 13.8387 21.3773 11.2773 17.9865 11.2773ZM17.9865 21.8179C15.118 21.8179 12.7838 19.6505 12.7838 16.9868C12.7838 14.3231 15.118 12.1557 17.9865 12.1557C20.8551 12.1557 23.1892 14.3231 23.1892 16.9868C23.1892 19.6505 20.8556 21.8179 17.9865 21.8179Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_1118_769">
                        <rect width="28" height="26" fill="white" transform="translate(4 4)"/>
                    </clipPath>
                </defs>
            </svg>
        </a>

        <!-- Tombol Cetak -->
        <button onclick="printSurat('{{ Storage::url($tamu->surat_permohonan_path) }}')" 
                class="p-1 rounded hover:opacity-80" 
                title="Cetak Surat">
            <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="36" height="35" fill="#E8BF6F"/>
                <path d="M11.9805 24.1342H6.40179C6.05907 24.1342 5.78125 23.8816 5.78125 23.57V15.13C5.78125 14.8185 6.05907 14.5659 6.40179 14.5659H30.5982C30.9409 14.5659 31.2188 14.8185 31.2188 15.13V23.57C31.2188 23.8816 30.9409 24.1342 30.5982 24.1342H25.0196" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25.0195 21.6479H11.9805V27.9792H25.0195V21.6479Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25.0195 14.5661H11.9805V6.021H22.2695L25.0195 8.521L25.0195 14.5661Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.5371 6.021V8.27756H25.0193" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M29.3975 16.7803C29.6822 16.7803 29.9131 16.5704 29.9131 16.3115C29.9131 16.0526 29.6822 15.8428 29.3975 15.8428C29.1127 15.8428 28.8818 16.0526 28.8818 16.3115C28.8818 16.5704 29.1127 16.7803 29.3975 16.7803Z" fill="white"/>
                <path d="M27.3242 16.7803C27.609 16.7803 27.8398 16.5704 27.8398 16.3115C27.8398 16.0526 27.609 15.8428 27.3242 15.8428C27.0394 15.8428 26.8086 16.0526 26.8086 16.3115C26.8086 16.5704 27.0394 16.7803 27.3242 16.7803Z" fill="white"/>
                <path d="M25.25 16.7803C25.5348 16.7803 25.7656 16.5704 25.7656 16.3115C25.7656 16.0526 25.5348 15.8428 25.25 15.8428C24.9652 15.8428 24.7344 16.0526 24.7344 16.3115C24.7344 16.5704 24.9652 16.7803 25.25 16.7803Z" fill="white"/>
            </svg>
        </button>

        <!-- Tombol Hapus -->
        <form action="{{ route('admin.surat.destroy', $tamu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
            @csrf
            @method('DELETE')
            <input type="hidden" name="tipe" value="permohonan">
            <button type="submit" class="p-1 rounded hover:opacity-80" title="Hapus Surat">
                <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="35" fill="#FF0000" fill-opacity="0.65"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 6V8.3H7V10.6H29V8.3H23.5V6H12.5ZM8.375 11.75H11.125V26.2236L11.6945 26.7H24.3054L24.875 26.2236V11.75H27.625V27.1764L25.4446 29H10.5555L8.375 27.1764V11.75Z" fill="white"/>
                </svg>
            </button>
        </form>
    </div>
</div>

                                            </div>
                                        @endif
                                        @if ($tamu->surat_tugas_path)
                                            <div class="text-center">
    <p class="text-sm font-semibold">Surat Tugas</p>
    <div class="flex gap-2 mt-1 justify-center">
        <!-- Tombol Lihat -->
        <a href="{{ Storage::url($tamu->surat_tugas_path) }}" 
           target="_blank" 
           class="p-1 rounded hover:opacity-90 flex items-center justify-center"
           title="Lihat Surat">
            <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="36" height="35" fill="#386EF5"/>
                <g clip-path="url(#clip0_1118_769)">
                    <path d="M28.1509 13.4694C22.5278 8.24784 13.3791 8.24784 7.75588 13.4694L4 16.9565L7.84905 20.5306C10.6604 23.1412 14.3534 24.4469 18.0468 24.4469C21.7403 24.4469 25.4328 23.1416 28.2446 20.5306L32.0005 17.043L28.1509 13.4694ZM27.5753 19.9096C22.3211 24.7881 13.7721 24.7881 8.51784 19.9096L5.33757 16.9565L8.42466 14.0899C13.6789 9.21142 22.2279 9.21142 27.4822 14.0899L30.6624 17.043L27.5753 19.9096Z" fill="white"/>
                    <path d="M17.5139 13.4731C15.6883 13.4731 14.2031 14.8522 14.2031 16.5475C14.2031 16.7899 14.415 16.9867 14.6761 16.9867C14.9372 16.9867 15.1491 16.7899 15.1491 16.5475C15.1491 15.3366 16.2099 14.3515 17.5139 14.3515C17.775 14.3515 17.9869 14.1548 17.9869 13.9123C17.9869 13.6699 17.7755 13.4731 17.5139 13.4731Z" fill="white"/>
                    <path d="M17.9865 11.2773C14.5963 11.2773 11.8379 13.8387 11.8379 16.9868C11.8379 20.1349 14.5963 22.6963 17.9865 22.6963C21.3768 22.6963 24.1352 20.1349 24.1352 16.9868C24.1352 13.8387 21.3773 11.2773 17.9865 11.2773ZM17.9865 21.8179C15.118 21.8179 12.7838 19.6505 12.7838 16.9868C12.7838 14.3231 15.118 12.1557 17.9865 12.1557C20.8551 12.1557 23.1892 14.3231 23.1892 16.9868C23.1892 19.6505 20.8556 21.8179 17.9865 21.8179Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_1118_769">
                        <rect width="28" height="26" fill="white" transform="translate(4 4)"/>
                    </clipPath>
                </defs>
            </svg>
        </a>

        <!-- Tombol Cetak -->
        <button onclick="printSurat('{{ Storage::url($tamu->surat_tugas_path) }}')" 
                class="p-1 rounded hover:opacity-90 flex items-center justify-center" 
                title="Cetak Surat">
            <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="36" height="35" fill="#E8BF6F"/>
                <path d="M11.9805 24.1342H6.40179C6.05907 24.1342 5.78125 23.8816 5.78125 23.57V15.13C5.78125 14.8185 6.05907 14.5659 6.40179 14.5659H30.5982C30.9409 14.5659 31.2188 14.8185 31.2188 15.13V23.57C31.2188 23.8816 30.9409 24.1342 30.5982 24.1342H25.0196" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25.0195 21.6479H11.9805V27.9792H25.0195V21.6479Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25.0195 14.5661H11.9805V6.021H22.2695L25.0195 8.521L25.0195 14.5661Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.5371 6.021V8.27756H25.0193" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M29.3975 16.7803C29.6822 16.7803 29.9131 16.5704 29.9131 16.3115C29.9131 16.0526 29.6822 15.8428 29.3975 15.8428C29.1127 15.8428 28.8818 16.0526 28.8818 16.3115C28.8818 16.5704 29.1127 16.7803 29.3975 16.7803Z" fill="white"/>
                <path d="M27.3242 16.7803C27.609 16.7803 27.8398 16.5704 27.8398 16.3115C27.8398 16.0526 27.609 15.8428 27.3242 15.8428C27.0394 15.8428 26.8086 16.0526 26.8086 16.3115C26.8086 16.5704 27.0394 16.7803 27.3242 16.7803Z" fill="white"/>
                <path d="M25.25 16.7803C25.5348 16.7803 25.7656 16.5704 25.7656 16.3115C25.7656 16.0526 25.5348 15.8428 25.25 15.8428C24.9652 15.8428 24.7344 16.0526 24.7344 16.3115C24.7344 16.5704 24.9652 16.7803 25.25 16.7803Z" fill="white"/>
            </svg>
        </button>

        <!-- Tombol Hapus -->
        <form action="{{ route('admin.surat.destroy', $tamu) }}" 
              method="POST" 
              onsubmit="return confirm('Yakin ingin menghapus surat ini?')" 
              class="flex items-center justify-center">
            @csrf
            @method('DELETE')
            <input type="hidden" name="tipe" value="tugas">
            <button type="submit" 
                    class="p-1 rounded hover:opacity-90 flex items-center justify-center" 
                    title="Hapus Surat">
                <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="35" fill="#FF0000" fill-opacity="0.65"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 6V8.3H7V10.6H29V8.3H23.5V6H12.5ZM8.375 11.75H11.125V26.2236L11.6945 26.7H24.3054L24.875 26.2236V11.75H27.625V27.1764L25.4446 29H10.5555L8.375 27.1764V11.75Z" fill="white"/>
                </svg>
            </button>
        </form>
    </div>
</div>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="p-4 text-center text-gray-500">Tidak ada surat yang diunggah.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $tamusWithSurat->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function printSurat(url) {
            const printWindow = window.open(url, '_blank', 'height=600,width=800');
            printWindow.addEventListener('load', function() {
                // Memberi sedikit waktu agar PDF/gambar termuat sebelum mencetak
                setTimeout(() => {
                    printWindow.print();
                }, 500);
            });
        }
    </script>
</body>

</html>