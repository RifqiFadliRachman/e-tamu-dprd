{{-- resources/views/details.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rencana Kunjungan - Tahap 2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8bf6f',
                        primaryDark: '#c4953b',
                        textPrimary: '#212427',
                        textSecondary: '#A89A9A',
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
        .no-mirror { transform: none !important; -webkit-transform: none !important; }
    </style>
</head>
<body class="bg-white min-h-screen font-poppins">
    <div class="w-full min-h-screen bg-white flex justify-center items-start">
        <div class="w-full max-w-[1440px] min-h-screen bg-white px-4 sm:px-8 md:px-16 py-6 sm:py-10 pb-16 sm:pb-20">

            <!-- Header: Title + Close Button -->
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-primary text-lg sm:text-xl md:text-2xl font-semibold">TAHAP 2</div>
                    <div class="text-textPrimary text-2xl sm:text-[28px] md:text-[32px] font-bold mt-1">Detail Rencana Kunjungan</div>
                </div>
                <a href="{{ route('home') }}" class="flex-shrink-0 ml-4 z-30">
                    <button type="button" class="bg-primary hover:bg-primaryDark p-2 sm:p-3 rounded-xl transition-colors" aria-label="Tutup formulir">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </a>
            </div>

            <!-- Step Progress -->
            <div class="flex justify-center items-center mt-6 sm:mt-8 md:mt-10">
                <div class="flex items-center gap-4 sm:gap-6 md:gap-10 lg:gap-16">
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                    <div class="w-[30px] h-[30px] sm:w-[37px] sm:h-[37px] bg-primary rounded-full flex items-center justify-center">
                        <span class="text-white text-base sm:text-xl font-bold font-inter">2</span>
                    </div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                </div>
            </div>

            <!-- Form -->
            <form id="detailForm" method="POST" action="{{ route('detail.kunjungan.store') }}" enctype="multipart/form-data" class="mt-8 sm:mt-10 space-y-5 sm:space-y-6">
                @csrf
                <input type="hidden" name="tanggal_kunjungan" value="{{ $step2Data['tanggal_kunjungan'] ?? '' }}">
                <input type="hidden" name="waktu_kunjungan" value="{{ $step2Data['waktu_kunjungan'] ?? '' }}">

                <!-- Jenis Kunjungan -->
                <div>
                    <label class="text-textPrimary text-sm sm:text-base font-medium">Jenis Kunjungan</label>
                    <div id="jenisKunjunganContainer" class="relative mt-2 w-full h-[48px] sm:h-[54px] menu-container">
                        <input type="hidden" name="jenis_kunjungan" id="hiddenJenisKunjungan" value="{{ $step2Data['jenis_kunjungan'] ?? '' }}" required>
                        <button type="button" id="jenisKunjunganBtn" class="w-full h-full bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary px-4 sm:px-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-primary">
                            @php
                                $labelJenis = null;
                                if(isset($step2Data['jenis_kunjungan'])) {
                                    $map = [
                                        'kunjungan_tamu' => 'Kunjungan Tamu',
                                        'kunjungan_kerja' => 'Kunjungan Kerja',
                                        'lainnya' => 'Lainnya'
                                    ];
                                    $labelJenis = $map[$step2Data['jenis_kunjungan']] ?? null;
                                }
                            @endphp
                            <span id="selectedJenisKunjungan" class="{{ $labelJenis ? 'text-textPrimary' : 'text-textSecondary' }} text-sm sm:text-base font-semibold">{{ $labelJenis ?? 'Pilih Jenis Kunjungan' }}</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div id="jenisKunjunganMenu" class="hidden absolute z-20 top-full left-1/2 -translate-x-1/2 mt-2 w-full max-w-[340px] sm:max-w-[384px] bg-white border border-primary rounded-2xl shadow-lg menu-dropdown">
                            <div class="p-3 sm:p-4 text-center">
                                <h3 class="text-lg sm:text-xl font-bold text-primary">Pilih Jenis Kunjungan</h3>
                                <div class="w-full h-px bg-primary my-2"></div>
                                <ul class="text-base sm:text-lg font-medium text-textPrimary">
                                    <li class="p-2 sm:p-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200" data-value="kunjungan_tamu">Kunjungan Tamu</li>
                                    <li class="p-2 sm:p-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200" data-value="kunjungan_kerja">Kunjungan Kerja</li>
                                    <li class="p-2 sm:p-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200" data-value="lainnya">Lainnya</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tujuan Kunjungan -->
                <div>
                    <label class="text-textPrimary text-sm sm:text-base font-medium">Tujuan Kunjungan</label>
                    <input type="text" name="topik_kunjungan" value="{{ $step2Data['topik_kunjungan'] ?? '' }}" class="mt-2 w-full h-[48px] sm:h-[54px] bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary px-4 sm:px-6 placeholder:text-textSecondary text-textPrimary text-sm sm:text-base font-semibold focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Masukkan tujuan utama dari kunjungan" required>
                </div>

                <!-- Jumlah Tamu -->
                <div>
                    <label class="text-textPrimary text-sm sm:text-base font-semibold">Jumlah Tamu</label>
                    <input type="number" name="jumlah_peserta" value="{{ $step2Data['jumlah_peserta'] ?? '' }}" class="mt-2 w-full h-[48px] sm:h-[54px] bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary px-4 sm:px-6 placeholder:text-textSecondary text-textPrimary text-sm sm:text-base font-semibold focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Masukkan jumlah tamu/delegasi yang hadir" min="1" required>
                </div>

                <!-- Section Title -->
                <div class="text-primaryDark text-lg sm:text-xl font-bold pt-2">Unggah Dokumen Pendukung</div>

                <!-- Upload 1: Surat Permohonan Kunjungan -->
                <div>
                    <label class="text-textPrimary text-sm sm:text-base font-medium">Surat Permohonan Kunjungan</label>
                    <div id="uploadContainer1" class="relative mt-2 w-full h-[48px] sm:h-[54px] menu-container">
                        <div onclick="toggleMenu(event, 'menu1')" class="w-full h-full bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary flex items-center justify-between px-4 sm:px-5 cursor-pointer hover:bg-gray-50">
                            <span id="filename1" class="text-textSecondary text-sm sm:text-base font-semibold truncate mr-2">[Tombol Upload]</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        </div>
                        <input type="file" id="surat_pemberitahuan_storage" name="surat_pemberitahuan" accept=".pdf,image/*" class="hidden" onchange="updateFileName(this, 'filename1')">
                        <input type="file" id="surat_pemberitahuan_camera" accept="image/*" capture="camera" class="hidden" onchange="updateFileName(this, 'filename1')">
                        <div id="menu1" class="hidden absolute z-20 top-full left-1/2 -translate-x-1/2 mt-2 w-full max-w-[340px] sm:max-w-[384px] bg-white border border-primary rounded-2xl shadow-lg menu-dropdown">
                            <div class="p-3 sm:p-4 text-center">
                                <h3 class="text-lg sm:text-xl font-bold text-primary">Pilih Sumber File</h3>
                                <div class="w-full h-px bg-primary my-2"></div>
                                <ul class="text-base sm:text-lg font-medium text-textPrimary space-y-1">
                                    <li onclick="triggerUpload('surat_pemberitahuan', true)" class="p-2 sm:p-3 flex items-center justify-center space-x-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        <span>Foto Dari Kamera</span>
                                    </li>
                                    <li onclick="triggerUpload('surat_pemberitahuan', false)" class="p-2 sm:p-3 flex items-center justify-center space-x-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                        <span>Unggah Dari Penyimpanan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 sm:mt-2 ml-2 sm:ml-4 text-textPrimary text-xs sm:text-sm md:text-base font-light">(Format yang didukung: .pdf, jpg)</p>
                </div>

                <!-- Upload 2: Surat Tugas -->
                <div>
                    <label class="text-textPrimary text-sm sm:text-base font-medium">Surat Tugas Perintah</label>
                    <div id="uploadContainer2" class="relative mt-2 w-full h-[48px] sm:h-[54px] menu-container">
                        <div onclick="toggleMenu(event, 'menu2')" class="w-full h-full bg-white rounded-[40px] sm:rounded-[64px] border-3 sm:border-4 border-primary flex items-center justify-between px-4 sm:px-5 cursor-pointer hover:bg-gray-50">
                            <span id="filename2" class="text-textSecondary text-sm sm:text-base font-semibold truncate mr-2">[Tombol Upload]</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        </div>
                        <input type="file" id="surat_tugas_storage" name="surat_tugas" accept=".pdf,image/*" class="hidden" onchange="updateFileName(this, 'filename2')">
                        <input type="file" id="surat_tugas_camera" accept="image/*" capture="camera" class="hidden" onchange="updateFileName(this, 'filename2')">
                        <div id="menu2" class="hidden absolute z-20 top-full left-1/2 -translate-x-1/2 mt-2 w-full max-w-[340px] sm:max-w-[384px] bg-white border border-primary rounded-2xl shadow-lg menu-dropdown">
                            <div class="p-3 sm:p-4 text-center">
                                <h3 class="text-lg sm:text-xl font-bold text-primary">Pilih Sumber File</h3>
                                <div class="w-full h-px bg-primary my-2"></div>
                                <ul class="text-base sm:text-lg font-medium text-textPrimary space-y-1">
                                    <li onclick="triggerUpload('surat_tugas', true)" class="p-2 sm:p-3 flex items-center justify-center space-x-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        <span>Foto Dari Kamera</span>
                                    </li>
                                    <li onclick="triggerUpload('surat_tugas', false)" class="p-2 sm:p-3 flex items-center justify-center space-x-3 hover:bg-primary hover:text-white cursor-pointer rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                        <span>Unggah Dari Penyimpanan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 sm:mt-2 ml-2 sm:ml-4 text-textPrimary text-xs sm:text-sm md:text-base font-light">(Format yang didukung: .pdf)</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col items-center gap-3 sm:gap-4 pt-4 sm:pt-6 pb-4 sm:pb-8">
                    <button type="submit" class="w-full max-w-[280px] sm:max-w-[258px] h-[48px] sm:h-[52px] bg-primary rounded-3xl flex items-center justify-center cursor-pointer hover:bg-primaryDark transition-colors">
                        <span class="text-white text-lg sm:text-xl font-bold">Lanjut</span>
                    </button>
                    <a href="{{ route('jadwal.kunjungan') }}" class="w-full max-w-[280px] sm:max-w-[258px] h-[48px] sm:h-[52px] rounded-3xl border-3 sm:border-4 border-primary flex items-center justify-center cursor-pointer hover:bg-primary/10 transition-colors">
                        <span class="text-primary text-lg sm:text-xl font-bold">Kembali</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Webcam Capture Modal -->
    <div id="cameraModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
        <div class="bg-white w-[92vw] max-w-[720px] rounded-2xl shadow-xl overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg sm:text-xl font-bold text-textPrimary">Ambil Foto dari Kamera</h3>
                <button type="button" id="closeCameraBtn" class="p-2 rounded-lg hover:bg-gray-100" aria-label="Tutup">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="p-4 sm:p-6">
                <div class="aspect-video w-full bg-black rounded-xl overflow-hidden flex items-center justify-center">
                    <video id="cameraVideo" autoplay playsinline class="w-full h-full object-contain no-mirror"></video>
                    <canvas id="cameraCanvas" class="hidden"></canvas>
                </div>
                <div class="mt-4 sm:mt-6 flex items-center justify-center gap-3 sm:gap-4 flex-wrap">
                    <button type="button" id="captureBtn" class="px-4 sm:px-6 h-10 sm:h-11 rounded-xl bg-primary text-white font-bold hover:bg-primaryDark text-sm sm:text-base">Ambil Foto</button>
                    <button type="button" id="retakeBtn" class="px-4 sm:px-6 h-10 sm:h-11 rounded-xl border-2 border-primary text-primary font-bold hover:bg-primary/10 hidden text-sm sm:text-base">Ulangi</button>
                    <button type="button" id="usePhotoBtn" class="px-4 sm:px-6 h-10 sm:h-11 rounded-xl bg-primary text-white font-bold hover:bg-primaryDark hidden text-sm sm:text-base">Gunakan Foto</button>
                </div>
                <p id="cameraHint" class="mt-3 sm:mt-4 text-center text-xs sm:text-sm text-textSecondary">Pastikan izin kamera diizinkan di browser Anda.</p>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input, spanId) {
            const span = document.getElementById(spanId);
            if (input.files && input.files[0]) {
                span.textContent = input.files[0].name;
                span.classList.remove('text-textSecondary');
                span.classList.add('text-textPrimary');
            }
            closeAllMenus();
        }

        function toggleMenu(event, menuId) {
            event.stopPropagation();
            const menu = document.getElementById(menuId);
            const isHidden = menu.classList.contains('hidden');
            closeAllMenus();
            if (isHidden) {
                menu.classList.remove('hidden');
            }
        }

        function isSecureContextForCamera() {
            return location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1';
        }

        function triggerUpload(baseId, useCamera) {
            const storage = document.getElementById(`${baseId}_storage`);
            const camera = document.getElementById(`${baseId}_camera`);
            if (storage) storage.removeAttribute('name');
            if (camera) camera.removeAttribute('name');
            if (useCamera) {
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia && isSecureContextForCamera()) {
                    closeAllMenus();
                    openCameraFor(baseId);
                    return;
                }
                if (camera) {
                    camera.setAttribute('name', baseId);
                    camera.setAttribute('accept', 'image/*');
                    camera.setAttribute('capture', 'environment');
                    closeAllMenus();
                    camera.click();
                    return;
                }
            } else {
                if (storage) {
                    storage.setAttribute('name', baseId);
                    storage.setAttribute('accept', '.pdf,image/*');
                    storage.removeAttribute('capture');
                    closeAllMenus();
                    storage.click();
                }
            }
        }

        function closeAllMenus() {
            document.querySelectorAll('.menu-dropdown').forEach(menu => {
                menu.classList.add('hidden');
            });
        }

        document.getElementById('jenisKunjunganMenu').classList.add('menu-dropdown');
        document.getElementById('menu1').classList.add('menu-dropdown');
        document.getElementById('menu2').classList.add('menu-dropdown');

        window.addEventListener('click', (e) => {
            const containers = document.querySelectorAll('.menu-container');
            if (!Array.from(containers).some(c => c.contains(e.target))) {
                closeAllMenus();
            }
        });

        document.getElementById('jenisKunjunganContainer').classList.add('menu-container');
        document.getElementById('uploadContainer1').classList.add('menu-container');
        document.getElementById('uploadContainer2').classList.add('menu-container');

        document.getElementById('jenisKunjunganBtn').addEventListener('click', (event) => toggleMenu(event, 'jenisKunjunganMenu'));

        document.querySelectorAll('#jenisKunjunganMenu li').forEach(option => {
            option.addEventListener('click', function() {
                document.getElementById('selectedJenisKunjungan').textContent = this.textContent;
                document.getElementById('selectedJenisKunjungan').classList.remove('text-textSecondary');
                document.getElementById('selectedJenisKunjungan').classList.add('text-textPrimary');
                document.getElementById('hiddenJenisKunjungan').value = this.getAttribute('data-value');
                closeAllMenus();
            });
        });

        document.getElementById('detailForm').addEventListener('submit', function(e) {
            // Form validation
        });

        // ===== Webcam Capture Support =====
        let currentCaptureField = null;
        let mediaStream = null;
        const cameraModal = document.getElementById('cameraModal');
        const cameraVideo = document.getElementById('cameraVideo');
        const cameraCanvas = document.getElementById('cameraCanvas');
        const captureBtn = document.getElementById('captureBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const usePhotoBtn = document.getElementById('usePhotoBtn');
        const closeCameraBtn = document.getElementById('closeCameraBtn');

        async function openCameraFor(baseId) {
            currentCaptureField = baseId;
            cameraModal.classList.remove('hidden');
            cameraModal.classList.add('flex');
            captureBtn.classList.remove('hidden');
            retakeBtn.classList.add('hidden');
            usePhotoBtn.classList.add('hidden');
            cameraCanvas.classList.add('hidden');
            cameraVideo.classList.remove('hidden');
            try {
                mediaStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: { ideal: 'environment' } }, audio: false });
                cameraVideo.srcObject = mediaStream;
                cameraVideo.style.transform = 'none';
            } catch (err) {
                console.warn('getUserMedia failed, falling back to file input', err);
                const camInput = document.getElementById(`${baseId}_camera`);
                if (camInput) {
                    camInput.setAttribute('name', baseId);
                    camInput.setAttribute('accept', 'image/*');
                    camInput.setAttribute('capture', 'environment');
                    camInput.click();
                }
                closeCamera();
            }
        }

        function stopStream() {
            if (mediaStream) {
                mediaStream.getTracks().forEach(t => t.stop());
                mediaStream = null;
            }
        }

        function closeCamera() {
            stopStream();
            cameraModal.classList.add('hidden');
            cameraModal.classList.remove('flex');
        }

        captureBtn.addEventListener('click', () => {
            if (!mediaStream) return;
            const video = cameraVideo;
            const canvas = cameraCanvas;
            const { videoWidth, videoHeight } = video;
            canvas.width = videoWidth;
            canvas.height = videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, videoWidth, videoHeight);
            cameraVideo.classList.add('hidden');
            canvas.classList.remove('hidden');
            captureBtn.classList.add('hidden');
            retakeBtn.classList.remove('hidden');
            usePhotoBtn.classList.remove('hidden');
        });

        retakeBtn.addEventListener('click', () => {
            cameraCanvas.classList.add('hidden');
            cameraVideo.classList.remove('hidden');
            captureBtn.classList.remove('hidden');
            retakeBtn.classList.add('hidden');
            usePhotoBtn.classList.add('hidden');
        });

        usePhotoBtn.addEventListener('click', async () => {
            try {
                const canvas = cameraCanvas;
                const blob = await new Promise(res => canvas.toBlob(res, 'image/jpeg', 0.9));
                const fileName = `${currentCaptureField}_kamera_${new Date().toISOString().replace(/[:.]/g,'-')}.jpg`;
                const file = new File([blob], fileName, { type: 'image/jpeg' });
                const dt = new DataTransfer();
                dt.items.add(file);
                const input = document.getElementById(`${currentCaptureField}_camera`);
                if (input) {
                    input.setAttribute('name', currentCaptureField);
                    input.files = dt.files;
                    const spanId = currentCaptureField === 'surat_pemberitahuan' ? 'filename1' : 'filename2';
                    updateFileName(input, spanId);
                }
            } catch (e) {
                console.error('Failed to set captured photo', e);
            } finally {
                closeCamera();
            }
        });

        closeCameraBtn.addEventListener('click', closeCamera);
        cameraModal.addEventListener('click', (e) => { if (e.target === cameraModal) closeCamera(); });
    </script>
</body>
</html>