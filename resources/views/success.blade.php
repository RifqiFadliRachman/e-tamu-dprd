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
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white min-h-screen font-poppins">

<div class="w-full max-w-[1440px] mx-auto min-h-screen px-4 sm:px-8 md:px-10 lg:px-16 pt-6 sm:pt-10 pb-16 sm:pb-20">

    <!-- HEADER -->
    <div class="flex justify-between items-start mb-4 sm:mb-6">
        <div>
            <div class="font-semibold text-primary text-lg sm:text-xl md:text-2xl">TAHAP 5</div>
            <div class="font-bold text-black text-2xl sm:text-[28px] md:text-3xl">Akhir</div>
        </div>

        <a href="{{ route('home') }}" class="z-30 flex-shrink-0 ml-4">
            <button type="button" class="bg-primary hover:bg-primaryDark p-2 sm:p-3 rounded-xl transition-colors">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </a>
    </div>

    <!-- PROGRESS -->
    <div class="flex justify-center my-8 sm:my-10">
        <div class="flex items-center gap-4 sm:gap-8 md:gap-12 lg:gap-16">
            <div class="w-3.5 h-3.5 sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
            <div class="w-3.5 h-3.5 sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
            <div class="w-3.5 h-3.5 sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
            <div class="w-3.5 h-3.5 sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
            <div class="w-8 h-8 sm:w-[37px] sm:h-[37px] bg-primary rounded-full flex items-center justify-center">
                <span class="font-bold text-white text-base sm:text-[20px] font-inter">5</span>
            </div>
        </div>
    </div>

    <!-- BUFFERING -->
    <div id="buffering" class="flex flex-col items-center mt-12 sm:mt-16 md:mt-24 max-w-md mx-auto text-center px-4">
        <div class="relative w-[120px] h-[120px] sm:w-[150px] sm:h-[150px] md:w-[180px] md:h-[180px] mb-6 sm:mb-8">
            <svg class="animate-spin-slow" viewBox="0 0 180 180">
                <circle cx="90" cy="90" r="80" stroke="#e8bf6f" stroke-width="8" fill="none" opacity="0.2"/>
                <path d="M170 90a80 80 0 1 1-80-80" stroke="#e8bf6f" stroke-width="8" fill="none" stroke-linecap="round"/>
                <circle cx="170" cy="90" r="8" fill="#e8bf6f"/>
                <circle cx="90" cy="10" r="6" fill="#e8bf6f" opacity="0.7"/>
                <circle cx="10" cy="90" r="5" fill="#e8bf6f" opacity="0.5"/>
            </svg>
        </div>

        <div class="text-center font-bold text-gray-400 text-base sm:text-lg md:text-xl">
            Mohon tunggu sebentar, kami sedang mengirim data..
        </div>
    </div>

    <!-- SUCCESS -->
    <div id="success" class="hidden text-center">

        <div class="w-[120px] h-[120px] sm:w-[140px] sm:h-[140px] md:w-[180px] md:h-[180px] mx-auto mt-12 sm:mt-16 md:mt-24">
            <div class="w-full h-full bg-white rounded-full border-[6px] sm:border-[8px] border-primary flex items-center justify-center shadow-[0_0_25px_rgba(232,191,111,0.35)]">
                <svg class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 text-primary" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
            </div>
        </div>

        <div class="mt-8 sm:mt-10 font-bold text-[#999898] text-lg sm:text-xl md:text-2xl max-w-xl mx-auto px-4">
            Terima kasih,<br>
            <span class="text-base sm:text-lg md:text-xl">data Anda telah berhasil tercatat dalam buku tamu kami.</span>

            @if(isset($submittedData) && $submittedData)
            <div class="mt-4 sm:mt-6 text-xs sm:text-sm text-gray-600">
                <p><strong>Nomor Referensi:</strong> {{ $submittedData['reference_number'] }}</p>
                <p><strong>Waktu Submit:</strong> {{ $submittedData['submission_time'] }}</p>
            </div>
            @endif
        </div>

        <div class="mt-10 sm:mt-14 flex justify-center">
            <a href="{{ route('konfirmasi') }}" class="px-8 sm:px-10 py-2.5 sm:py-3 bg-primary rounded-3xl hover:bg-primaryDark transition">
                <span class="font-bold text-white text-base sm:text-lg">Kembali</span>
            </a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
.animate-spin-slow { animation: spin 1.2s linear infinite; }
@keyframes spin { 100% { transform: rotate(360deg);} }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.getElementById('buffering').style.display = 'none';
        document.getElementById('success').style.display = 'block';

        confetti({ particleCount: 120, spread: 90, origin: { y: 0.6 } });
        setTimeout(() => {
            confetti({ particleCount: 80, spread: 70, origin: { y: 0.7 } });
        }, 400);
    }, 2000);
});
</script>

</body>
</html>
