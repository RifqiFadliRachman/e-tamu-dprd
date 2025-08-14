<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Konfirmasi - Tahap 4</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8bf6f',
                        primaryDark: '#c4953b',
                        textPrimary: '#212427',
                        textSecondary: '#a79a9a',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            body { 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact;
                font-family: 'Times New Roman', serif;
                font-size: 12pt;
                line-height: 1.4;
                margin: 0;
                padding: 20px;
                background: white;
            }
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            .print-container { 
                padding: 0 !important; 
                margin: 0 !important; 
                max-width: 100% !important; 
                width: 100%;
                background: white;
            }
            .print-header {
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #000;
                padding-bottom: 15px;
            }
            .print-logo {
                width: 80px;
                height: 80px;
                margin: 0 auto 10px;
            }
            .print-title {
                font-size: 16pt;
                font-weight: bold;
                margin-bottom: 8px;
                color: #000;
            }
            .print-address {
                font-size: 11pt;
                margin-bottom: 4px;
                color: #000;
            }
            .print-website {
                font-size: 10pt;
                color: #000;
            }
            .section-title {
                font-size: 14pt;
                font-weight: bold;
                text-align: center;
                margin: 30px 0 20px 0;
                color: #000;
            }
            .data-row {
                display: flex;
                margin-bottom: 8px;
                font-size: 11pt;
            }
            .data-label {
                width: 200px;
                color: #000;
            }
            .data-separator {
                width: 20px;
                color: #000;
            }
            .data-value {
                flex: 1;
                color: #000;
            }
            .print-main {
                margin-top: 0;
            }
        }
        .print-only {
            display: none;
        }
    </style>
</head>
<body class="bg-white min-h-screen font-poppins flex justify-center items-start">
    <div class="w-full max-w-[1440px] mx-auto px-8 sm:px-16 py-10 print-container">

        <!-- Header Kop Surat untuk Print -->
        <div class="print-only print-header">
            <div class="flex justify-center items-center mb-4">
                <!-- Logo DPRD Asli -->
                <div class="print-logo flex items-center justify-center">
                    <img src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" style="max-width:80px;max-height:80px;object-fit:contain;image-rendering:auto;" />
                </div>
            </div>
            <div class="print-title">DPRD PROVINSI JAWA BARAT</div>
            <div class="print-address">Jl. Diponegoro No.27, Citarum, Kec. Bandung Wetan, Kota Bandung, Jawa</div>
            <div class="print-address">Barat 40115</div>
            <div class="print-website">Website: https://dprd.jabarprov.go.id/</div>
        </div>

        <!-- Header Normal untuk Screen -->
        <header class="flex justify-between items-start no-print">
            <div>
                <p class="text-primary text-2xl font-semibold">TAHAP 4</p>
                <h1 class="font-bold text-black text-[32px]">Konfirmasi</h1>
            </div>
            <button type="button" class="bg-primary hover:bg-primaryDark p-3 rounded-xl transition-colors" aria-label="Tutup formulir">
                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </header>

        <!-- Progress Steps -->
        <div class="w-full flex justify-center items-center my-12 no-print">
            <div class="flex justify-center items-center w-full gap-x-16 sm:gap-x-20">
                <div class="w-4 h-4 bg-primary rounded-full"></div>
                <div class="w-4 h-4 bg-primary rounded-full"></div>
                <div class="w-4 h-4 bg-primary rounded-full"></div>
                <div class="w-9 h-9 bg-primary rounded-full flex items-center justify-center text-white text-xl font-bold font-inter z-10">4</div>
                <div class="w-4 h-4 bg-primary rounded-full"></div>
            </div>
        </div>

        <!-- Info Bar (Dynamic) -->
    <div class="flex justify-between items-start mb-10 no-print">
            <div class="text-primary text-base font-semibold">
                @php
                    $tgl = $step2Data['tanggal_kunjungan'] ?? null;
                @endphp
                Tanggal: {{ $tgl ? \Carbon\Carbon::parse($tgl)->isoFormat('D MMMM YYYY') : '-' }}
            </div>
            <div class="flex flex-col items-end">
                <div class="text-primary text-base font-semibold">
                    Waktu: 
                    @php $wk = $step2Data['waktu_kunjungan'] ?? null; @endphp
                    {{ $wk ? ($wk . ' WIB') : '-' }}
                </div>
            </div>
        </div>
        
        <!-- Konten Utama -->
        <main class="grid grid-cols-1 gap-y-12 print-main">
            <!-- Bagian Data Penanggung Jawab -->
            <section>
                <div class="no-print flex items-center justify-between mb-8">
                    <h2 class="text-primary text-2xl font-bold">Data Penanggung Jawab</h2>
                    <button
                        onclick="window.print()"
                        type="button"
                        aria-label="Cetak Data"
                        class="group flex items-center gap-x-0 group-hover:gap-x-8 text-textPrimary hover:text-primary transition-all duration-200 active:scale-[0.98] focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:ring-offset-white select-none"
                    >
                        <div class="w-[50px] h-[50px] bg-primary rounded-[10px] flex items-center justify-center transition-all duration-200 group-hover:bg-primaryDark shadow-sm group-hover:shadow-lg transform-gpu group-hover:-translate-y-0.5 group-hover:scale-[1.05]">
                            <svg class="w-6 h-6 transition-transform duration-200 group-hover:scale-110" fill="white" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                        </div>
                        <span class="text-base font-semibold whitespace-nowrap overflow-hidden max-w-0 opacity-0 ml-0 transition-all duration-300 ease-out delay-0 group-hover:delay-200 group-hover:max-w-[160px] group-hover:opacity-100 group-hover:ml-5">Cetak Data</span>
                    </button>
                </div>
                <div class="section-title print-only">Data Penanggung Jawab</div>
                
                <!-- Format Screen -->
                <div class="space-y-6 no-print">
                    <div>
                        <p class="text-black text-base font-semibold">Nama Penanggung Jawab</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step3Data['nama_penanggung_jawab'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Asal Instansi</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step3Data['nama_fraksi_komisi'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Alamat Lengkap Instansi</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step3Data['alamat_instansi'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Posisi/Jabatan</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step3Data['posisi_jabatan'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Nomor Kontak Aktif (Whatsapp)</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step3Data['nomor_kontak'] ?? '-' }}</p>
                    </div>
                </div>

                <!-- Format Print -->
                <div class="print-only">
                    <div class="data-row">
                        <span class="data-label">Nama Penanggung Jawab</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step3Data['nama_penanggung_jawab'] ?? '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Asal Instansi</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step3Data['nama_fraksi_komisi'] ?? '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Alamat Lengkap Instansi</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step3Data['alamat_instansi'] ?? '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Posisi/Jabatan</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step3Data['posisi_jabatan'] ?? '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Nomor Kontak Aktif (Whatsapp)</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step3Data['nomor_kontak'] ?? '-' }}</span>
                    </div>
                </div>
            </section>

            <!-- Bagian Info Kunjungan -->
            <section>
                <h2 class="text-primary text-2xl font-bold mb-8 no-print">Info Kunjungan</h2>
                <div class="section-title print-only">Info Kunjungan</div>
                
                <!-- Format Screen -->
                <div class="space-y-6 no-print">
                    <div>
                        <p class="text-black text-base font-semibold">Tanggal Kunjungan</p>
                        <p class="text-black text-base font-normal mt-1">
                            @php $tgl = $step2Data['tanggal_kunjungan'] ?? null; @endphp
                            {{ $tgl ? \Carbon\Carbon::parse($tgl)->isoFormat('D MMMM YYYY') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Waktu Kunjungan</p>
                        <p class="text-black text-base font-normal mt-1">
                            @php $wk = $step2Data['waktu_kunjungan'] ?? null; @endphp
                            {{ $wk ? ($wk . ' WIB') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Tipe Kunjungan</p>
                        <p class="text-black text-base font-normal mt-1">
                            @php
                                $jenisRaw = $step2Data['jenis_kunjungan'] ?? null;
                                $mapJenis = [
                                    'kunjungan_tamu' => 'Kunjungan Tamu',
                                    'kunjungan_kerja' => 'Kunjungan Kerja',
                                    'lainnya' => 'Lainnya'
                                ];
                                $jenisLabel = $jenisRaw ? ($mapJenis[$jenisRaw] ?? ucwords(str_replace('_',' ', $jenisRaw))) : null;
                            @endphp
                            {{ $jenisLabel ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Tujuan Kunjungan</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step2Data['topik_kunjungan'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-black text-base font-semibold">Jumlah Tamu</p>
                        <p class="text-black text-base font-normal mt-1">{{ $step2Data['jumlah_peserta'] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-textPrimary text-base font-semibold">Surat Permohonan Kunjungan</p>
                        <p class="text-textPrimary text-base font-normal mt-1">{{ session('surat_pemberitahuan_path') ? basename(session('surat_pemberitahuan_path')) : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-textPrimary text-base font-semibold">Surat Perintah Tugas</p>
                        <p class="text-textPrimary text-base font-normal mt-1">{{ session('surat_tugas_path') ? basename(session('surat_tugas_path')) : '-' }}</p>
                    </div>
                </div>

                <!-- Format Print -->
                <div class="print-only">
                    <div class="data-row">
                        <span class="data-label">Tanggal Kunjungan</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">
                            @php $tgl = $step2Data['tanggal_kunjungan'] ?? null; @endphp
                            {{ $tgl ? \Carbon\Carbon::parse($tgl)->isoFormat('D MMMM YYYY') : '-' }}
                        </span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Waktu Kunjungan</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">
                            @php $wk = $step2Data['waktu_kunjungan'] ?? null; @endphp
                            {{ $wk ? ($wk . ' WIB') : '-' }}
                        </span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Tipe Kunjungan</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">
                            @php
                                $jenisRaw = $step2Data['jenis_kunjungan'] ?? null;
                                $mapJenis = [
                                    'kunjungan_tamu' => 'Kunjungan Tamu',
                                    'kunjungan_kerja' => 'Kunjungan Kerja',
                                    'lainnya' => 'Lainnya'
                                ];
                                $jenisLabel = $jenisRaw ? ($mapJenis[$jenisRaw] ?? ucwords(str_replace('_',' ', $jenisRaw))) : null;
                            @endphp
                            {{ $jenisLabel ?? '-' }}
                        </span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Tujuan Kunjungan</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step2Data['topik_kunjungan'] ?? '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Jumlah Tamu</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ $step2Data['jumlah_peserta'] ?? '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Surat Permohonan Kunjungan</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ session('surat_pemberitahuan_path') ? basename(session('surat_pemberitahuan_path')) : '-' }}</span>
                    </div>
                    <div class="data-row">
                        <span class="data-label">Surat Perintah Tugas</span>
                        <span class="data-separator">:</span>
                        <span class="data-value">{{ session('surat_tugas_path') ? basename(session('surat_tugas_path')) : '-' }}</span>
                    </div>
                </div>
            </section>
        </main>

        <!-- Tombol Aksi -->
        <footer class="mt-16 flex flex-col items-center justify-center gap-y-5 no-print">
            <form method="POST" action="{{ route('konfirmasi.store') }}" class="w-full max-w-[260px] flex flex-col gap-5">
                @csrf
                <button type="submit" class="w-full h-[52px] bg-primary rounded-[24px] text-white text-xl font-bold hover:bg-primaryDark transition-colors">Kirim Data</button>
                <a href="{{ route('form.tamu') }}" class="w-full h-[52px] border-2 border-primary rounded-[24px] text-primary text-xl font-bold hover:bg-primary/10 transition-colors flex items-center justify-center">Kembali</a>
            </form>
        </footer>
    </div>

    <!-- Flash Messages -->
    <div id="successMessage" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden">
        Data berhasil dikirim!
    </div>
    <div id="errorMessage" class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 hidden">
        Terjadi kesalahan!
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto hide flash messages
            const messages = document.querySelectorAll('[id$="Message"]');
            messages.forEach(message => {
                if (!message.classList.contains('hidden')) {
                    setTimeout(() => {
                        message.style.transition = 'opacity 0.5s ease';
                        message.style.opacity = '0';
                        setTimeout(() => message.classList.add('hidden'), 500);
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>