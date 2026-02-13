<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8bf6f',
                        textPrimary: '#212427',
                        textSecondary: '#505050',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .enter-hidden {
            opacity: 0;
            transform: translateY(16px);
            filter: blur(2px);
        }

        .enter-from-top {
            opacity: 0;
            transform: translateY(-24px);
            filter: blur(2px);
        }

        .enter-from-bottom {
            opacity: 0;
            transform: translateY(24px);
            filter: blur(2px);
        }

        .enter-hidden,
        .enter-from-top,
        .enter-from-bottom {
            transition: all 700ms cubic-bezier(.22, .9, .3, 1);
            will-change: transform, opacity;
        }

        .enter-show {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
            transition: all 700ms cubic-bezier(.22, .9, .3, 1);
        }

        .enter-delay-1 { transition-delay: 120ms; }
        .enter-delay-2 { transition-delay: 240ms; }
        .enter-delay-3 { transition-delay: 360ms; }
        .enter-delay-4 { transition-delay: 480ms; }
    </style>
</head>

<body class="bg-primary min-h-screen font-poppins overflow-x-hidden">
    <!-- Main Layout: stacks on mobile, side-by-side on lg -->
    <div class="w-full min-h-screen bg-primary flex flex-col lg:flex-row">

        <!-- Left Section - Hero -->
        <div id="heroLeft" class="relative w-full lg:w-[44%] min-h-[280px] sm:min-h-[340px] lg:min-h-screen bg-black bg-cover bg-center overflow-hidden enter-from-top flex-shrink-0" style="background-image: url('{{ asset('images/background.jpg') }}');">
            <!-- overlay -->
            <div class="absolute inset-0 bg-black/60"></div>

            <!-- content centered -->
            <div class="relative flex flex-col items-center justify-center text-center px-6 sm:px-10 py-12 lg:py-0 h-full min-h-[280px] sm:min-h-[340px] lg:min-h-screen gap-4 sm:gap-6">
                <h1 id="heroTitle" class="text-white font-bold leading-tight tracking-tight text-[28px] sm:text-[36px] md:text-[44px] lg:text-[52px] xl:text-[56px] enter-from-top enter-delay-1">
                    Selamat Datang di App<br />Buku Tamu Online
                </h1>
                <img id="heroLogo" src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="mt-2 sm:mt-4 w-28 sm:w-36 md:w-44 lg:w-48 h-auto enter-from-top enter-delay-2">
            </div>
        </div>

        <!-- Right Section - Content + Bottom Panel -->
        <div class="w-full lg:w-[56%] flex flex-col">

            <!-- White Content Panel -->
            <div id="panelRight" class="relative bg-white shadow-[0_12px_32px_rgba(0,0,0,0.06)] px-5 sm:px-8 md:px-10 lg:px-[30px] py-8 sm:py-10 lg:py-12 -mt-6 lg:mt-0 rounded-t-3xl lg:rounded-none z-10">

                <!-- What is Online Guest Book Section -->
                <h2 id="rightHeading" class="text-textPrimary text-xl sm:text-2xl md:text-3xl font-semibold text-left enter-from-bottom enter-delay-1">
                    Apa itu Buku Tamu Online?
                </h2>

                <p id="rightDescription" class="mt-3 sm:mt-4 text-textSecondary text-sm sm:text-base font-normal text-left leading-6 sm:leading-7 md:leading-8 lg:leading-9 enter-from-bottom enter-delay-2">
                    Buku tamu online adalah sebuah formulir digital yang digunakan untuk mencatat data atau informasi dari tamu
                    yang berkunjung ke suatu tempat, acara, atau platform secara elektronik melalui internet. Berbeda dengan
                    buku tamu konvensional yang berupa buku fisik, buku tamu online dapat diakses dan diisi menggunakan
                    komputer, tablet, atau smartphone.
                </p>

                <!-- Step Cards -->
                <div id="steps" class="mt-8 sm:mt-10 flex flex-col sm:flex-row justify-center items-stretch gap-4 sm:gap-5 md:gap-6 lg:gap-8 xl:gap-10 enter-from-bottom enter-delay-3">
                    <!-- Step 1 -->
                    <div class="relative w-full sm:w-1/3 max-w-[280px] sm:max-w-none mx-auto sm:mx-0 bg-primary shadow-md cursor-default rounded-xl transition-transform duration-200 filter hover:brightness-95 hover:scale-105">
                        <div class="flex flex-col items-center text-white px-4 sm:px-5 lg:px-6 py-6 sm:py-7">
                            <div class="text-4xl sm:text-5xl font-extrabold">01</div>
                            <div class="w-16 sm:w-20 h-1 bg-white mt-2 sm:mt-3"></div>
                            <div class="text-sm sm:text-base font-semibold text-center leading-normal mt-4 sm:mt-6">
                                Anda akan mengisi formulir secara online yang
                                terdiri dari beberapa tahap.
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative w-full sm:w-1/3 max-w-[280px] sm:max-w-none mx-auto sm:mx-0 bg-primary rounded-xl shadow-md cursor-default transition-transform duration-200 filter hover:brightness-95 hover:scale-105">
                        <div class="flex flex-col items-center text-white px-4 sm:px-5 lg:px-6 py-6 sm:py-7">
                            <div class="text-4xl sm:text-5xl font-extrabold">02</div>
                            <div class="w-16 sm:w-20 h-1 bg-white mt-2 sm:mt-3"></div>
                            <div class="text-sm sm:text-base font-semibold text-center leading-normal mt-4 sm:mt-6">
                                lengkapi setiap bagian dengan data yang benar dan lengkap.
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative w-full sm:w-1/3 max-w-[280px] sm:max-w-none mx-auto sm:mx-0 bg-primary rounded-xl shadow-md cursor-default transition-transform duration-200 filter hover:brightness-95 hover:scale-105">
                        <div class="flex flex-col items-center text-white px-4 sm:px-5 lg:px-6 py-6 sm:py-7">
                            <div class="text-4xl sm:text-5xl font-extrabold">03</div>
                            <div class="w-16 sm:w-20 h-1 bg-white mt-2 sm:mt-3"></div>
                            <div class="text-sm sm:text-base font-semibold text-center leading-normal mt-4 sm:mt-6">
                                Proses ini hanya memerlukan beberapa menit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Panel -->
            <div id="bottomPanel" class="flex flex-col items-center px-5 sm:px-8 md:px-10 py-10 sm:py-12 lg:py-14 flex-grow enter-from-bottom enter-delay-4">
                <!-- Instructions Text -->
                <div class="max-w-[680px] text-white text-sm sm:text-base font-bold text-center leading-normal">
                    Silakan isi Buku Tamu Elektronik sebagai bagian dari proses kunjungan. Tekan tombol 'Daftar' di bawah
                    ini untuk memulai. Data Anda akan digunakan sebagai arsip kunjungan dan tidak disebarluaskan. Terima kasih
                    atas kunjungan Anda.
                </div>

                <!-- Register Button -->
                <a href="{{ route('jadwal.kunjungan') }}" class="mt-6 sm:mt-8 inline-flex items-center justify-center h-[44px] sm:h-[48px] px-8 sm:px-10 bg-white text-primary text-lg sm:text-xl font-bold rounded-3xl shadow-sm hover:bg-gray-100 transition-colors">
                    Daftar
                </a>

                <!-- Help Section -->
                <div class="mt-10 sm:mt-14 text-white text-sm font-bold text-center leading-normal">
                    Butuh bantuan lebih lanjut?<br />Jangan ragu untuk menghubungi kami melalui
                </div>

                <!-- Contact Icons -->
                <div class="mt-4 sm:mt-6 flex items-center gap-6 sm:gap-8 text-white">
                    <!-- Website -->
                    <a href="https://dprd.jabarprov.go.id/" target="_blank" rel="noopener noreferrer" aria-label="Website" class="hover:opacity-90 transition-opacity cursor-pointer">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/dprdjabar/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="hover:opacity-90 transition-opacity cursor-pointer">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        (function() {
            try {
                const fromIntro = sessionStorage.getItem('introEnter') === '1';
                if (fromIntro) {
                    sessionStorage.removeItem('introEnter');
                    const ids = ['heroLeft', 'heroTitle', 'heroLogo', 'rightHeading', 'rightDescription', 'steps', 'bottomPanel'];
                    requestAnimationFrame(() => ids.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.add('enter-show');
                    }));
                } else {
                    const nodes = document.querySelectorAll('.enter-hidden, .enter-from-top, .enter-from-bottom');
                    requestAnimationFrame(() => nodes.forEach(n => n.classList.add('enter-show')));
                }
            } catch (e) {
                const nodes = document.querySelectorAll('.enter-hidden, .enter-from-top, .enter-from-bottom');
                requestAnimationFrame(() => nodes.forEach(n => n.classList.add('enter-show')));
            }
        })();
    </script>
</body>

</html>
