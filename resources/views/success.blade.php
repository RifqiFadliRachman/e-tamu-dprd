<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Konfirmasi Berhasil - Tahap 5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8bf6f',
                        primaryDark: '#c4953b',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white min-h-screen font-poppins flex justify-center items-start">
    <div class="relative w-[1440px] min-h-[1024px] bg-white">
        
        <!-- Header: TAHAP 5 -->
        <div class="absolute top-[51px] left-[64px] font-semibold text-primary text-2xl leading-normal">
            TAHAP 5
        </div>
        
        <!-- Close Button -->
        <a href="{{ route('home') }}" class="absolute top-[92px] right-16 z-30">
            <button type="button" class="bg-primary hover:bg-primaryDark p-3 rounded-xl transition-colors" aria-label="Tutup">
                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </a>
        
        <!-- Title: Akhir -->
        <div class="absolute top-[87px] left-[64px] font-bold text-black text-[32px] text-center leading-normal">
            Akhir
        </div>
        
        <!-- Progress Indicator -->
        <div class="absolute w-[353px] h-[37px] top-[150px] left-[546px]">
            <div class="absolute top-[10px] left-0 w-[17px] h-[17px] bg-primary rounded-full"></div>
            <div class="absolute top-[10px] left-[81px] w-[17px] h-[17px] bg-primary rounded-full"></div>
            <div class="absolute top-[10px] left-[162px] w-[17px] h-[17px] bg-primary rounded-full"></div>
            <div class="absolute w-[17px] h-[24px] top-[7px] left-[243px]">
                <div class="absolute top-0 left-[1px] font-bold text-white text-[20px] leading-normal whitespace-nowrap font-inter">
                    4
                </div>
                <div class="absolute top-[3px] left-0 w-[17px] h-[17px] bg-primary rounded-full"></div>
            </div>
            <div class="absolute w-[37px] h-[37px] top-0 left-[312px] bg-primary rounded-full flex items-center justify-center">
                <span class="font-bold text-white text-[20px] leading-none font-inter">5</span>
            </div>
        </div>

        <!-- Buffering Animation -->
        <div id="buffering" class="absolute top-[380px] left-1/2 -translate-x-1/2 flex flex-col items-center w-[400px]">
            <div class="flex justify-center items-center mb-8">
                <div class="relative w-[180px] h-[180px]">
                    <svg class="animate-spin-slow" width="180" height="180" viewBox="0 0 180 180">
                        <circle cx="90" cy="90" r="80" stroke="#e8bf6f" stroke-width="8" fill="none" opacity="0.2"/>
                        <path d="M170 90a80 80 0 1 1-80-80" stroke="#e8bf6f" stroke-width="8" fill="none" stroke-linecap="round"/>
                        <!-- Dots -->
                        <circle cx="170" cy="90" r="8" fill="#e8bf6f"/>
                        <circle cx="90" cy="10" r="6" fill="#e8bf6f" opacity="0.7"/>
                        <circle cx="10" cy="90" r="5" fill="#e8bf6f" opacity="0.5"/>
                    </svg>
                </div>
            </div>
            <div class="text-center font-bold text-gray-400 text-xl mt-2">
                Mohon tunggu sebentar, kami sedang mengirim data..
            </div>
        </div>

        <!-- Success Section (hidden at first) -->
        <div id="success" class="absolute top-0 left-0 w-full h-full hidden">
            <!-- Central Success Icon -->
            <div class="absolute w-[180px] h-[180px] top-[380px] left-1/2 -translate-x-1/2">
                <div class="relative w-full h-full bg-white rounded-full border-[8px] border-primary flex items-center justify-center shadow-[0_0_25px_rgba(232,191,111,0.35)]">
                    <svg class="w-30 h-30 text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                </div>
            </div>
            <!-- Success Message -->
            <div class="absolute top-[600px] left-[421px] font-bold text-[#999898] text-2xl text-center leading-normal max-w-[600px]">
                <span class="font-bold text-[#999898] text-2xl">Terima kasih,</span><br />
                <span class="text-[20px]">data Anda telah berhasil tercatat dalam buku tamu kami.</span>
                @if(isset($submittedData) && $submittedData)
                <div class="mt-6 text-sm text-gray-600">
                    <p><strong>Nomor Referensi:</strong> {{ $submittedData['reference_number'] }}</p>
                    <p><strong>Waktu Submit:</strong> {{ $submittedData['submission_time'] }}</p>
                </div>
                @endif
            </div>
            <!-- Action Buttons -->
            <div class="absolute top-[812px] left-[591px]">
                <a href="{{ route('konfirmasi') }}" class="w-[258px] h-[52px] bg-primary rounded-3xl hover:bg-primaryDark transition-all duration-200 flex items-center justify-center">
                    <span class="font-bold text-white text-[20px]">Kembali</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        .animate-spin-slow {
            animation: spin 1.2s linear infinite;
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
    </style>
    <script>
        // Show buffering first, then success after 2 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('buffering').style.display = 'none';
                document.getElementById('success').style.display = 'block';

                // Efek petasan/confetti
                confetti({
                    particleCount: 120,
                    spread: 90,
                    origin: { y: 0.6 }
                });
                setTimeout(() => {
                    confetti({
                        particleCount: 80,
                        spread: 70,
                        origin: { y: 0.7 }
                    });
                }, 400);
            }, 2000);
        });
    </script>
</body>
</html>