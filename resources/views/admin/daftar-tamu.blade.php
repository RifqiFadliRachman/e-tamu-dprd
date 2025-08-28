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
        printDocument(url) {
            if (!url) return;
            const iframe = document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.width = '0';
            iframe.style.height = '0';
            iframe.style.border = '0';
            iframe.src = url;
            document.body.appendChild(iframe);
            iframe.onload = function() {
                try {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                } catch (e) {
                    window.open(url, '_blank');
                }
                setTimeout(() => {
                    document.body.removeChild(iframe);
                }, 1000);
            };
        },
        formatJenisKunjungan(jenis) {
            if (!jenis) return '-';
            return jenis.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        },
        formatStatus(status) {
            if (!status) return 'Belum Di Proses';
            return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        },
        formatDateTime(dateTimeString) {
            if (!dateTimeString) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', timeZone: 'Asia/Jakarta' };
            return new Date(dateTimeString).toLocaleString('id-ID', options) + ' WIB';
        },
        formatDate(dateString) {
            if (!dateString) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric', timeZone: 'Asia/Jakarta' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        },
        formatTime(timeString) {
            if (!timeString) return '-';
            return `${timeString} WIB`;
        },
        getFileName(path) {
            if (!path) return '';
            return path.split('/').pop();
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
                
                @include('admin.partials._header', [
                    'headerContent' => view('admin.partials._header-content-daftartamu')
                ])

                <main class="p-6 overflow-y-auto">
                    
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @endif

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

                    <div class="mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#E8BF6F]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" id="searchInputDaftar" name="search" placeholder="Cari nama, no. kontak, atau jenis kunjungan"
                                value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-full leading-5 
                                      bg-white placeholder-gray-400 focus:outline-none 
                                      focus:ring-1 focus:ring-[#E8BF6F] focus:border-[#E8BF6F] sm:text-sm">
                        </div>
                    </div>

                    <div id="tableContainer">
                        @include('admin.partials.daftar-tamu-content', ['daftarTamu' => $daftarTamu])
                    </div>
                </main>

            </div>
        </div>

        <!-- MODAL / POPUP DETAIL TAMU -->
        <div x-show="showModal" @keydown.escape.window="showModal = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
            <div @click.outside="showModal = false" class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Detail Tamu</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
                </div>
                <div class="p-6 space-y-4 overflow-y-auto">
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
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Status</label>
                        <p x-text="formatStatus(detailTamu.status)" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Tanggal Status Diubah</label>
                        <p x-text="formatDateTime(detailTamu.status_updated_at)" class="mt-1 p-3 border rounded-md bg-gray-50 w-full"></p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Keterangan</label>
                        <p x-text="detailTamu.keterangan || '-'" class="mt-1 p-3 border rounded-md bg-gray-50 w-full min-h-[48px]"></p>
                    </div>
                    <!-- Keterangan Surat Permohonan -->
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Surat Permohonan Kunjungan</label>
                        <div class="mt-1 p-3 border rounded-md bg-gray-50 w-full min-h-[48px] flex justify-between items-center">
                            <template x-if="detailTamu.surat_permohonan_path">
                                <div class="flex-1">
                                    <a :href="'/storage/' + detailTamu.surat_permohonan_path" target="_blank" class="text-blue-600 hover:underline truncate" x-text="getFileName(detailTamu.surat_permohonan_path)"></a>
                                </div>
                                <button @click="printDocument('/storage/' + detailTamu.surat_permohonan_path)" class="ml-4 px-3 py-1 bg-gray-200 text-gray-700 text-xs font-semibold rounded hover:bg-gray-300 flex-shrink-0">
                                    Print
                                </button>
                            </template>
                            <template x-if="!detailTamu.surat_permohonan_path">
                                <span class="text-gray-500">-</span>
                            </template>
                        </div>
                    </div>
                    <!-- Keterangan Surat Tugas -->
                    <div>
                        <label class="text-sm font-semibold text-gray-500">Surat Tugas Perintah</label>
                        <div class="mt-1 p-3 border rounded-md bg-gray-50 w-full min-h-[48px] flex justify-between items-center">
                            <template x-if="detailTamu.surat_tugas_path">
                                <div class="flex-1">
                                    <a :href="'/storage/' + detailTamu.surat_tugas_path" target="_blank" class="text-blue-600 hover:underline truncate" x-text="getFileName(detailTamu.surat_tugas_path)"></a>
                                </div>
                                <button @click="printDocument('/storage/' + detailTamu.surat_tugas_path)" class="ml-4 px-3 py-1 bg-gray-200 text-gray-700 text-xs font-semibold rounded hover:bg-gray-300 flex-shrink-0">
                                    Print
                                </button>
                            </template>
                            <template x-if="!detailTamu.surat_tugas_path">
                                <span class="text-gray-500">-</span>
                            </template>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 bg-gray-50 border-t flex justify-end items-center gap-x-3">
                    <button @click="showModal = false" type="button" class="px-5 py-2 border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        Tutup
                    </button>
                    <form :action="`/admin/tamu/${detailTamu.id}`" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data tamu ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInputDaftar');
            const tableContainer = document.getElementById('tableContainer');
            let searchTimeout;

            const fetchData = async (url) => {
                tableContainer.style.opacity = '0.5';
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const html = await response.text();
                    tableContainer.innerHTML = html;
                } catch (error) {
                    console.error('Fetch error:', error);
                    tableContainer.innerHTML = '<div class="p-4 text-center text-red-500">Gagal memuat data. Silakan coba lagi.</div>';
                } finally {
                    tableContainer.style.opacity = '1';
                }
            };

            const performSearch = (page = 1) => {
                const urlParams = new URLSearchParams(window.location.search);
                const filter = urlParams.get('filter') || 'semua';
                const query = searchInput.value;
                
                const searchUrl = new URL('{{ route('admin.daftar-tamu.search') }}');
                searchUrl.searchParams.set('search', query);
                searchUrl.searchParams.set('filter', filter);
                searchUrl.searchParams.set('page', page);
                
                fetchData(searchUrl.toString());
            };

            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => performSearch(1), 300);
            });

            tableContainer.addEventListener('click', (event) => {
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
