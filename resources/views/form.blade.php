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
        <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-8 md:px-16 py-12">
            
            <div class="flex justify-between items-end pt-8">
                <section class="text-left">
                    <h1 class="font-poppins font-semibold text-primary text-2xl mb-1">TAHAP 3</h1>
                    <h2 class="font-poppins font-bold text-secondary text-4xl">Formulir Instansi Terkait</h2>
                </section>

                <a href="{{ route('index') }}" class="z-10 mb-3">
                    <button type="button" class="bg-primary hover:bg-primary-dark p-3 rounded-xl transition-colors duration-200" aria-label="Tutup formulir">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </a>
            </div>

            <nav class="my-8">
                <ol class="flex items-center justify-center gap-12">
                    <li class="w-4 h-4 bg-primary rounded-full"></li>
                    <li class="w-4 h-4 bg-primary rounded-full"></li>
                    <li class="w-9 h-9 bg-primary rounded-full flex items-center justify-center">
                        <span class="font-inter font-bold text-white text-xl">3</span>
                    </li>
                    <li class="w-4 h-4 bg-primary rounded-full"></li>
                    <li class="w-4 h-4 bg-primary rounded-full"></li>
                </ol>
            </nav>

            <form class="mt-12" method="POST" action="{{ route('form.tamu.store') }}" novalidate>
                @csrf
                
                <div class="mb-6">
                    <label for="nama_penanggung_jawab" class="block font-poppins font-semibold text-secondary text-base mb-2 pl-5">Nama</label>
                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" class="form-input w-full h-[54px] px-6 bg-white rounded-[64px] border-4 border-primary font-poppins font-semibold text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Isi dengan nama lengkap penanggung jawab instansi" required 
                           value="{{ $step3Data['nama_penanggung_jawab'] ?? '' }}" />
                </div>

                <div class="mb-6">
                    <label for="posisi_jabatan" class="block font-poppins font-semibold text-secondary text-base mb-2 pl-5">Posisi / Jabatan</label>
                    <input type="text" id="posisi_jabatan" name="posisi_jabatan" class="form-input w-full h-[54px] px-6 bg-white rounded-[64px] border-4 border-primary font-poppins font-semibold text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Silakan pilih posisi atau jabatan resmi" required 
                           value="{{ $step3Data['posisi_jabatan'] ?? '' }}" />
                </div>

                <div class="mb-6">
                    <label for="nomor_kontak" class="block font-poppins font-semibold text-secondary text-base mb-2 pl-5">Nomor Kontak Aktif (WhatsApp)</label>
                    <input type="tel" id="nomor_kontak" name="nomor_kontak" class="form-input w-full h-[54px] px-6 bg-white rounded-[64px] border-4 border-primary font-poppins font-semibold text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Contoh: 0812xxxxxxxx" required 
                           value="{{ $step3Data['nomor_kontak'] ?? '' }}" />
                </div>

                <div class="mb-6">
                    <label for="nama_fraksi_komisi" class="block font-poppins font-semibold text-secondary text-base mb-2 pl-5">Asal Instansi</label>
                    <input type="text" id="nama_fraksi_komisi" name="nama_fraksi_komisi" class="form-input w-full h-[54px] px-6 bg-white rounded-[64px] border-4 border-primary font-poppins font-semibold text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Isi asal instansi terkait" required 
                           value="{{ $step3Data['nama_fraksi_komisi'] ?? '' }}" />
                </div>
                
                <div class="mb-8">
                    <label for="alamat_instansi" class="block font-poppins font-semibold text-secondary text-base mb-2 pl-5">Alamat Lengkap Instansi</label>
                    <input type="text" id="alamat_instansi" name="alamat_instansi" class="form-input w-full h-[54px] px-6 bg-white rounded-[64px] border-4 border-primary font-poppins font-semibold text-base text-secondary outline-none focus:ring-2 focus:ring-primary placeholder:font-normal placeholder:text-muted" placeholder="Tulis alamat lengkap beserta kode pos (jika ada)" required 
                           value="{{ $step3Data['alamat_instansi'] ?? '' }}" />
                </div>

                <div class="flex flex-col items-center gap-4 mt-10 pb-8">
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-poppins font-bold text-lg py-3 px-12 rounded-full min-w-[258px] text-center transition-transform hover:-translate-y-0.5">
                        Lanjut
                    </button>
                    <a href="{{ route('detail.kunjungan') }}" class="bg-white hover:bg-primary/10 text-primary font-poppins font-bold text-lg py-3 px-12 rounded-full border-3 border-primary min-w-[258px] text-center">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>