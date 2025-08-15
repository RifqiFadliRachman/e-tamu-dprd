<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Selamat Datang</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Fullscreen page container */
            .page {
                position: fixed;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 1;
                background: white;
            }

            /* Subtle shared transitions */
            #brand { transition: gap 400ms ease, transform 500ms ease; gap: .5rem; }
            .brand-expand { gap: .75rem; }

            /* Phase 1: logo rises from bottom */
            .logo-rise-slow { animation: riseInSlow 1200ms cubic-bezier(.22,.9,.3,1) forwards; will-change: transform, opacity; }
            @keyframes riseInSlow {
                0% { opacity: 0; transform: translateY(72px) scale(.95); filter: blur(1.5px); }
                60% { opacity: 1; }
                100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
            }

            /* Phase 2 (removed left shift to keep centered) */

            /* Phase 3: title slides in to the right of the logo */
            .title-slide-in { animation: slideIn 500ms ease-out forwards; will-change: transform, opacity; }
            @keyframes slideIn {
                from { opacity: 0; transform: translateX(16px); }
                to   { opacity: 1; transform: translateX(0); }
            }
        </style>
    </head>
    <body class="antialiased bg-white text-gray-900">
        <!-- Single Page: Selamat Datang -->
        <div id="page1" class="page">
            <div id="brand" class="flex items-center justify-center select-none">
                <img id="logo" src="{{ asset('images/logo-dprd.png') }}" alt="Logo DPRD" class="w-16 h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 object-contain" />
                <h1 id="welcomeTitle" class="text-2xl lg:text-4xl font-bold text-black opacity-0 translate-x-4">Selamat Datang</h1>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const brand = document.getElementById('brand');
                const logo  = document.getElementById('logo');
                const title = document.getElementById('welcomeTitle');

                // Phase 1: rise the logo from bottom (slow)
                requestAnimationFrame(() => {
                    logo.classList.add('logo-rise-slow');
                });

                // After logo finished rising, expand spacing and reveal title
                logo.addEventListener('animationend', () => {
                    brand.classList.add('brand-expand');
                    title.classList.remove('translate-x-4');
                    title.classList.add('title-slide-in');
                }, { once: true });

                // Redirect after intro sequence
                const REDIRECT_DELAY = 3800; // ms
                setTimeout(() => {
                    try { sessionStorage.setItem('introEnter', '1'); } catch (_) {}
                    window.location.href = '/home';
                }, REDIRECT_DELAY);
            });
        </script>
    </body>
</html>