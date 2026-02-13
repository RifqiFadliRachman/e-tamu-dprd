<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Formulir Instansi Terkait - Tahap 3</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8bf6f',
                        'primary-dark': '#d4a853',
                        secondary: '#212427',
                        muted: '#a79a9a',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif']
                    },
                    borderWidth: {
                        '3': '3px',
                    }
                }
            }
        }
    </script>
    <style>
        .form-input::placeholder {
            color: #a79a9a;
        }
    </style>
</head>
<body class="bg-white font-poppins">
    <main class="w-full min-h-screen">
        <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-8 md:px-16 py-8 sm:py-12">

            <!-- Header -->
            <div class="flex justify-between items-start pt-2 sm:pt-4 md:pt-8">
                <section class="text-left">
                    <h1 class="font-poppins font-semibold text-primary text-lg sm:text-xl md:text-2xl mb-1">TAHAP 3</h1>
                    <h2 class="font-poppins font-bold text-secondary text-2xl sm:text-3xl md:text-4xl">Formulir Instansi Terkait</h2>
                </section>

                <a href="{{ route('home') }}" class="z-10 flex-shrink-0 ml-4">
                    <button type="button" class="bg-primary hover:bg-primary-dark p-2 sm:p-3 rounded-xl transition-colors duration-200" aria-label="Tutup formulir">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </a>
            </div>

            <!-- Progress Steps -->
            <nav class="my-6 sm:my-8">
                <ol class="flex items-center justify-center gap-4 sm:gap-6 md:gap-10 lg:gap-12">
                    <li class="w-3.5 h-3.5 sm:w-4 sm:h-4 bg-primary rounded-full"></li>
                    <li class="w-3.5 h-3.5 sm:w-4 sm:h-4 bg-primary rounded-full"></li>
                    <li class="w-8 h-8 sm:w-9 sm:h-9 bg-primary rounded-full flex items-center justify-center">
                        <span class="font-inter font-bold text-white text-lg sm:text-xl">3</span>
                    </li>
                    <li class="w-3.5 h-3.5 sm:w-4 sm:h-4 bg-primary rounded-full"></li>
                    <li class="w-3.5 h-3.5 sm:w-4 sm:h-4 bg-primary rounded-full"></li>
                </ol>
            </nav>

            <!-- Form -->
            <form class="mt-6 sm:mt-8 md:mt-12 space-y-5 sm:space-y-6" method="POST" action="{{ route('form.tamu.store') }}" novalidate>
                @csrf

                <div>
                    <label for="nama_penanggung_jawab" class="block font-poppins font-semibold text-secondary text-sm sm:text-base mb-1.5 sm:mb-2 pl-3 sm:pl-5">Nama</label>
                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" class="form-input w-full h-[48px] sm:h-[54px] px-4 sm:px-6 bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary font-poppins font-semibold text-sm sm:text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Isi dengan nama lengkap penanggung jawab instansi" required
                           value="{{ $step3Data['nama_penanggung_jawab'] ?? '' }}" />
                </div>

                <div>
                    <label for="posisi_jabatan" class="block font-poppins font-semibold text-secondary text-sm sm:text-base mb-1.5 sm:mb-2 pl-3 sm:pl-5">Posisi / Jabatan</label>
                    <input type="text" id="posisi_jabatan" name="posisi_jabatan" class="form-input w-full h-[48px] sm:h-[54px] px-4 sm:px-6 bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary font-poppins font-semibold text-sm sm:text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Silakan pilih posisi atau jabatan resmi" required
                           value="{{ $step3Data['posisi_jabatan'] ?? '' }}" />
                </div>

                <div>
                    <label for="nomor_kontak" class="block font-poppins font-semibold text-secondary text-sm sm:text-base mb-1.5 sm:mb-2 pl-3 sm:pl-5">Nomor Kontak Aktif (WhatsApp)</label>
                    <input type="tel" id="nomor_kontak" name="nomor_kontak" class="form-input w-full h-[48px] sm:h-[54px] px-4 sm:px-6 bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary font-poppins font-semibold text-sm sm:text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Contoh: 0812xxxxxxxx" required
                           value="{{ $step3Data['nomor_kontak'] ?? '' }}" />
                </div>

                <div>
                    <label for="nama_fraksi_komisi" class="block font-poppins font-semibold text-secondary text-sm sm:text-base mb-1.5 sm:mb-2 pl-3 sm:pl-5">Asal Instansi</label>
                    <input type="text" id="nama_fraksi_komisi" name="nama_fraksi_komisi" class="form-input w-full h-[48px] sm:h-[54px] px-4 sm:px-6 bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary font-poppins font-semibold text-sm sm:text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Isi asal instansi terkait" required
                           value="{{ $step3Data['nama_fraksi_komisi'] ?? '' }}" />
                </div>

                <div>
                    <label for="alamat_instansi" class="block font-poppins font-semibold text-secondary text-sm sm:text-base mb-1.5 sm:mb-2 pl-3 sm:pl-5">Alamat Lengkap Instansi</label>
                    <input type="text" id="alamat_instansi" name="alamat_instansi" class="form-input w-full h-[48px] sm:h-[54px] px-4 sm:px-6 bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary font-poppins font-semibold text-sm sm:text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Tulis alamat lengkap beserta kode pos (jika ada)" required
                           value="{{ $step3Data['alamat_instansi'] ?? '' }}" />
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col items-center gap-3 sm:gap-4 pt-4 sm:pt-6 md:pt-10 pb-4 sm:pb-8">
                    <button type="submit" class="w-full max-w-[280px] sm:max-w-[258px] bg-primary hover:bg-primary-dark text-white font-poppins font-bold text-base sm:text-lg py-2.5 sm:py-3 rounded-full text-center transition-transform hover:-translate-y-0.5">
                        Lanjut
                    </button>
                    <a href="{{ route('detail.kunjungan') }}" class="w-full max-w-[280px] sm:max-w-[258px] bg-white hover:bg-primary/10 text-primary font-poppins font-bold text-base sm:text-lg py-2.5 sm:py-3 rounded-full border-3 border-primary text-center">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>