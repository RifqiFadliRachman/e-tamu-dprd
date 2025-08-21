<header class="bg-white flex justify-between items-center py-4 px-6 border-b">
    <div class="flex items-center">
        {{-- Icon dan Judul Halaman (Dinamis) --}}
        {!! $headerContent !!}
    </div>

    <div class="flex items-center gap-5">
        <!-- Tombol Notifikasi dengan Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="relative text-gray-500 hover:text-gray-800 transition-colors">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                @if (isset($totalNotifications) && $totalNotifications > 0)
                    <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 rounded-full border-2 border-white flex items-center justify-center text-xs text-white font-bold">
                        {{ $totalNotifications }}
                    </span>
                @endif
            </button>

            <!-- Dropdown Panel Notifikasi -->
            <div x-show="open" 
                 @click.outside="open = false" 
                 x-transition:enter="transition ease-out duration-200" 
                 x-transition:enter-start="opacity-0 transform -translate-y-2" 
                 x-transition:enter-end="opacity-100 transform translate-y-0" 
                 x-transition:leave="transition ease-in duration-150" 
                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                 x-transition:leave-end="opacity-0 transform -translate-y-2" 
                 class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-lg border z-50"
                 style="display: none;">

                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Notifikasi</h3>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Tandai sudah dibaca</a>
                </div>

                <div class="divide-y max-h-96 overflow-y-auto">
                    @forelse ($notifications as $notification)
                        <div class="p-4 flex items-start gap-3 hover:bg-gray-50">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center text-gray-500 font-bold uppercase">
                                {{ substr($notification->nama, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-700">
                                    @if ($notification->notification_type === 'tamu')
                                        Tamu baru ditambahkan: <strong class="font-semibold">{{ $notification->nama }}</strong>
                                    @elseif ($notification->notification_type === 'surat')
                                        Surat baru ditambahkan oleh: <strong class="font-semibold">{{ $notification->nama }}</strong>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ $notification->notification_type === 'tamu' ? route('admin.daftar-tamu') : route('admin.surat') }}" class="text-sm text-blue-600 hover:underline self-center">Lihat</a>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500 text-sm">
                            Tidak ada notifikasi baru.
                        </div>
                    @endforelse
                </div>
                
                <div class="p-2 border-t text-center">
                     <a href="#" class="text-sm text-blue-600 hover:underline">Lihat semua notifikasi</a>
                </div>
            </div>
        </div>

        <!-- Profil Pengguna -->
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
