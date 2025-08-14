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
                    backgroundImage: {
                        'hero-pattern': "url('./img/mask-group.png')",
                        'logo-pattern': "url('./img/image-8.png')",
                        'email-icon': "url('./img/email-1572.svg')",
                    }
                }
            }
        }
    </script>
    <style>
        .enter-hidden { opacity: 0; transform: translateY(16px); filter: blur(2px); }
        .enter-show { opacity: 1; transform: translateY(0); filter: blur(0); transition: all 700ms cubic-bezier(.22,.9,.3,1); }
        .enter-delay-1 { transition-delay: 120ms; }
        .enter-delay-2 { transition-delay: 240ms; }
        .enter-delay-3 { transition-delay: 360ms; }
        .enter-delay-4 { transition-delay: 480ms; }
    </style>
</head>
<body class="bg-primary min-h-screen font-poppins overflow-x-hidden">
    <div class="w-full min-h-screen bg-primary flex justify-center items-start">
        <div id="pageRoot" class="relative w-screen h-[1024px] bg-primary">
            
            <!-- Left Section - Hero -->
            <div id="heroLeft" class="absolute top-0 left-0 w-[44vw] h-[1024px] bg-black bg-cover bg-center overflow-hidden enter-hidden" style="background-image: url('{{ asset('images/background.jpg') }}');">
                <!-- overlay -->
                <div class="absolute inset-0 bg-black/60"></div>

                <!-- content centered on the left section -->
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-10 gap-6">
                    <h1 id="heroTitle" class="text-white font-bold leading-tight tracking-tight text-[40px] md:text-[52px] lg:text-[56px] enter-hidden enter-delay-1">
                        Selamat Datang di App<br/>Buku Tamu Online
                    </h1>
                    <img id="heroLogo" src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="mt-4 w-48 h-auto enter-hidden enter-delay-2">
                </div>
            </div>
            
            <!-- Right Section - Content -->
            <div id="panelRight" class="absolute top-0 left-[44vw] w-[56vw] h-[640px] bg-white rounded-bl-[120px] shadow-[0_12px_32px_rgba(0,0,0,0.06)] enter-hidden enter-delay-2">
                
                <!-- What is Online Guest Book Section -->
                <div class="absolute top-[49px] left-[30px] right-[30px] text-textPrimary text-3xl md:text-4xl font-semibold text-left">
                    Apa itu Buku Tamu Online?
                </div>
                
                <div class="absolute top-[100px] left-[30px] right-[30px] text-textSecondary text-base font-normal text-left leading-8 md:leading-9">
                    Buku tamu online adalah sebuah formulir digital yang digunakan untuk mencatat data atau informasi dari tamu
                    yang berkunjung ke suatu tempat, acara, atau platform secara elektronik melalui internet. Berbeda dengan
                    buku tamu konvensional yang berupa buku fisik, buku tamu online dapat diakses dan diisi menggunakan
                    komputer, tablet, atau smartphone.
                </div>
                
                <!-- Step Cards (flex, centered) -->
                <div id="steps" class="absolute top-[285px] left-[28px] right-[28px] flex justify-center items-stretch gap-10 enter-hidden enter-delay-3">
                    <!-- Step 1 -->
                    <div class="relative w-[189px] h-[287px] bg-primary rounded-xl shadow-md cursor-default transition-transform duration-200 filter hover:brightness-95 hover:scale-105 shrink-0">
                        <div class="flex flex-col items-center text-white px-6 pt-7">
                            <div class="text-5xl font-extrabold">01</div>
                            <div class="w-20 h-1 bg-white mt-3"></div>
                            <div class="text-base font-semibold text-center leading-normal mt-6">
                                Anda akan mengisi formulir secara online yang<br />
                                terdiri dari beberapa tahap.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative w-[189px] h-[287px] bg-primary rounded-xl shadow-md cursor-default transition-transform duration-200 filter hover:brightness-95 hover:scale-105 shrink-0">
                        <div class="flex flex-col items-center text-white px-6 pt-7">
                            <div class="text-5xl font-extrabold">02</div>
                            <div class="w-20 h-1 bg-white mt-3"></div>
                            <div class="text-base font-semibold text-center leading-normal mt-6">
                                lengkapi setiap bagian dengan data yang benar dan lengkap.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="relative w-[189px] h-[287px] bg-primary rounded-xl shadow-md cursor-default transition-transform duration-200 filter hover:brightness-95 hover:scale-105 shrink-0">
                        <div class="flex flex-col items-center text-white px-6 pt-7">
                            <div class="text-5xl font-extrabold">03</div>
                            <div class="w-20 h-1 bg-white mt-3"></div>
                            <div class="text-base font-semibold text-center leading-normal mt-6">
                                Proses ini hanya memerlukan beberapa menit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Right Panel: Centered Content -->
            <div id="bottomPanel" class="absolute top-[680px] left-[44vw] w-[56vw] flex flex-col items-center enter-hidden enter-delay-4">
                <!-- Instructions Text -->
                <div class="max-w-[680px] px-6 text-white text-base font-bold text-center leading-normal">
                    Silakan isi Buku Tamu Elektronik sebagai bagian dari proses kunjungan. Tekan tombol 'Daftar' di bawah
                    ini untuk memulai. Data Anda akan digunakan sebagai arsip kunjungan dan tidak disebarluaskan. Terima kasih
                    atas kunjungan Anda.
                </div>

                <!-- Register Button -->
                <a href="{{ route('jadwal.kunjungan') }}" class="mt-8 inline-flex items-center justify-center h-[44px] px-10 bg-white text-primary text-xl font-bold rounded-3xl shadow-sm hover:bg-gray-100 transition-colors">
                    Daftar
                </a>

                <!-- Help Section -->
                <div class="mt-14 text-white text-sm font-bold text-center leading-normal">
                    Butuh bantuan lebih lanjut?<br />Jangan ragu untuk menghubungi kami melalui
                </div>

                <!-- Contact Icons (Email, Phone, Instagram) -->
                <div class="mt-6 flex items-center gap-8 text-white">
                    <!-- Email -->
                    <a href="mailto:alamat@domain.com" aria-label="Email" class="hover:opacity-90 transition-opacity cursor-pointer">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>
                            <path d="M3 7l9 6 9-6"></path>
                        </svg>
                    </a>
                    <!-- Phone -->
                    <a href="tel:+620000000000" aria-label="Telepon" class="hover:opacity-90 transition-opacity cursor-pointer">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.62 2.61a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.47-1.14a2 2 0 0 1 2.11-.45c.84.29 1.71.5 2.61.62A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="hover:opacity-90 transition-opacity cursor-pointer">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    // Clear flag for next navigations
                    sessionStorage.removeItem('introEnter');
                    const ids = ['heroLeft','heroTitle','heroLogo','panelRight','steps','bottomPanel'];
                    requestAnimationFrame(() => ids.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.add('enter-show');
                    }));
                } else {
                    // If not from intro, ensure elements are visible without animation
                    const nodes = document.querySelectorAll('.enter-hidden');
                    nodes.forEach(n => n.classList.add('enter-show'));
                }
            } catch (e) {
                // Fallback: make everything visible
                const nodes = document.querySelectorAll('.enter-hidden');
                nodes.forEach(n => n.classList.add('enter-show'));
            }
        })();
    </script>
</body>
</html>