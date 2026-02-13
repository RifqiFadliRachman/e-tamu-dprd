<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kunjungan - Tahap 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8bf6f',
                        primaryDark: '#cfa554',
                        textPrimary: '#212427',
                        textSecondary: '#505050',
                        textGray: '#9CA3AF',
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
        .calendar-day { width: 100%; height: 54px; display: flex; align-items: center; justify-content: center; font-size: 1.125rem; color: #212427; cursor: pointer; transition: all 0.2s ease; border-radius: 8px; font-weight: 500; }
        .calendar-day:hover { background-color: #e8bf6f; color: #fff; transform: scale(1.05); }
        .calendar-day.selected { background-color: #e8bf6f; color: #fff; font-weight: 600; }
        .calendar-day.disabled { color: #D1D5DB; cursor: default; opacity: 0.4; }
        .calendar-day.disabled:hover { background-color: transparent; color: #D1D5DB; transform: none; }
        .day-header { width: 100%; height: 32px; background-color: #e8bf6f; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 600; }
        input[type="time"]::-webkit-calendar-picker-indicator { background: none; display: none; }

        @media (max-width: 640px) {
            .calendar-day { height: 38px; font-size: 0.875rem; border-radius: 10px; }
            .day-header { height: 26px; font-size: 0.625rem; border-radius: 6px; }
        }
    </style>
</head>
<body class="bg-white min-h-screen font-poppins overflow-x-hidden">
    <div class="w-full min-h-screen bg-white flex justify-center items-start">
        <div class="w-full max-w-[1440px] min-h-screen bg-white px-4 sm:px-8 md:px-16 py-6 sm:py-10 pb-16 sm:pb-20">

            <!-- Header: Title + Close Button -->
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-primaryDark text-lg sm:text-xl md:text-2xl font-semibold">TAHAP 1</div>
                    <div class="text-textPrimary text-2xl sm:text-[28px] md:text-[32px] font-bold mt-1">Jadwal Kunjungan</div>
                </div>
                <a href="{{ route('home') }}" class="flex-shrink-0 ml-4">
                    <button type="button" class="bg-primary hover:bg-primaryDark p-2 sm:p-3 rounded-xl transition-colors" aria-label="Tutup formulir">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </a>
            </div>

            <!-- Step Progress -->
            <div class="flex justify-center items-center mt-6 sm:mt-8 md:mt-10">
                <div class="flex items-center gap-4 sm:gap-6 md:gap-10 lg:gap-12">
                    <div class="w-[30px] h-[30px] sm:w-[37px] sm:h-[37px] bg-primary rounded-full flex items-center justify-center"><span class="text-white text-base sm:text-xl font-bold font-inter">1</span></div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                    <div class="w-[14px] h-[14px] sm:w-[17px] sm:h-[17px] bg-primary rounded-full"></div>
                </div>
            </div>

            <!-- Month Selector -->
            <div class="flex justify-center mt-6 sm:mt-8">
                <div class="w-full max-w-[340px] sm:max-w-[450px] md:max-w-[555px] h-[50px] sm:h-[56px] md:h-[62px] bg-primary rounded-[20px] md:rounded-[25px] relative flex items-center justify-center">
                    <div id="prevMonth" class="absolute top-1/2 -translate-y-1/2 left-3 sm:left-4 w-[35px] sm:w-[41px] h-[24px] sm:h-[28px] cursor-pointer flex items-center justify-center"><svg class="w-[8px] sm:w-[10px] h-[12px] sm:h-[14px]" viewBox="0 0 10 14" fill="none"><path d="M8 2L2 7l6 5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                    <div id="monthLabel" class="text-white text-lg sm:text-xl md:text-[28px] lg:text-[32px] font-semibold text-center"></div>
                    <div id="nextMonth" class="absolute top-1/2 -translate-y-1/2 right-3 sm:right-4 w-[35px] sm:w-[45px] h-[24px] sm:h-[28px] cursor-pointer flex items-center justify-center"><svg class="w-[9px] sm:w-[11px] h-[12px] sm:h-[14px]" viewBox="0 0 11 14" fill="none"><path d="M2 2l6 5-6 5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="flex justify-center mt-4 sm:mt-6">
                <div class="w-full max-w-[360px] sm:max-w-[500px] md:max-w-[700px] lg:max-w-[846px]">
                    <div class="w-full grid grid-cols-7 place-items-center mb-3 sm:mb-4 gap-1">
                        <div class="day-header">Sen</div>
                        <div class="day-header">Sel</div>
                        <div class="day-header">Rab</div>
                        <div class="day-header">Kam</div>
                        <div class="day-header">Jum</div>
                        <div class="day-header">Sab</div>
                        <div class="day-header">Min</div>
                    </div>
                    <div id="calendarGrid" class="w-full grid grid-cols-7 gap-y-1 sm:gap-y-2 md:gap-y-4 place-items-center"></div>
                </div>
            </div>

            <!-- Time Picker -->
            <form id="scheduleForm" method="POST" action="{{ route('jadwal.kunjungan.store') }}">
                @csrf
                <input type="hidden" id="tanggalInput" name="tanggal_kunjungan" value="">

                <div class="flex justify-center mt-8 sm:mt-10">
                    <div class="relative w-[220px] sm:w-[240px] md:w-[260px]">
                        <input
                            type="time"
                            id="timeInput"
                            name="waktu_kunjungan"
                            min="08:00"
                            max="16:00"
                            required
                            class="w-full h-[50px] sm:h-[54px] md:h-[66px] bg-white border-4 border-primary rounded-xl text-lg sm:text-xl md:text-[28px] font-bold text-textPrimary text-center hover:border-primaryDark focus:outline-none transition-colors"
                        >
                        <span class="pointer-events-none absolute top-1/2 right-3 sm:right-4 -translate-y-1/2 text-textSecondary text-sm sm:text-base md:text-xl font-bold">WIB</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col items-center mt-6 sm:mt-8">
                    <p class="text-textSecondary text-xs sm:text-sm md:text-base font-semibold mb-3 sm:mb-4 text-center px-4">
                        Silakan pilih waktu kunjungan dari opsi berikut
                    </p>
                    <button type="submit" id="continueBtn" class="w-full max-w-[280px] sm:max-w-[286px] h-[48px] sm:h-[52px] bg-primary hover:bg-primaryDark text-white text-lg sm:text-xl font-bold rounded-full transition-all opacity-50 pointer-events-none">
                        Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            let displayed = new Date();
            displayed.setDate(1);
            let selectedDate = null;
            let selectedTime = '';

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const monthLabelEl = document.getElementById('monthLabel');
            const gridEl = document.getElementById('calendarGrid');
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');
            const continueBtnEl = document.getElementById('continueBtn');
            const tanggalInputEl = document.getElementById('tanggalInput');
            const timeInputEl = document.getElementById('timeInput');

            function updateContinueState() {
                if (selectedDate && selectedTime) {
                    continueBtnEl.classList.remove('opacity-50', 'pointer-events-none');
                } else {
                    continueBtnEl.classList.add('opacity-50', 'pointer-events-none');
                }
            }

            function formatMonthLabel(date) { return `${monthNames[date.getMonth()]} ${date.getFullYear()}`; }
            function getMondayFirstIndex(jsDayIndex) { return (jsDayIndex + 6) % 7; }
            function clearGrid() { while (gridEl.firstChild) gridEl.removeChild(gridEl.firstChild); }

            function createDayCell(dayNumber, isSelectable, dateObj) {
                const cell = document.createElement('div');
                cell.className = 'calendar-day' + (isSelectable ? '' : ' disabled');
                cell.textContent = dayNumber;

                if (isSelectable) {
                    cell.addEventListener('click', () => {
                        gridEl.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                        cell.classList.add('selected');
                        selectedDate = new Date(dateObj.getFullYear(), dateObj.getMonth(), dayNumber);

                        const yyyy = selectedDate.getFullYear();
                        const mm = String(selectedDate.getMonth()+1).padStart(2,'0');
                        const dd = String(selectedDate.getDate()).padStart(2,'0');
                        tanggalInputEl.value = `${yyyy}-${mm}-${dd}`;
                        updateContinueState();
                    });
                }
                return cell;
            }

            function renderCalendar() {
                monthLabelEl.textContent = formatMonthLabel(displayed);
                clearGrid();
                const year = displayed.getFullYear();
                const month = displayed.getMonth();

                const firstDay = new Date(year, month, 1);
                const firstDayIndex = getMondayFirstIndex(firstDay.getDay());
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const daysInPrevMonth = new Date(year, month, 0).getDate();

                for (let i = firstDayIndex; i > 0; i--) {
                    gridEl.appendChild(createDayCell(daysInPrevMonth - i + 1, false, new Date(year, month - 1)));
                }

                for (let d = 1; d <= daysInMonth; d++) {
                    const currentDate = new Date(year, month, d);
                    const isPast = currentDate < today;
                    const cell = createDayCell(d, !isPast, currentDate);
                    if (selectedDate && selectedDate.getTime() === currentDate.getTime()) {
                        cell.classList.add('selected');
                    }
                    gridEl.appendChild(cell);
                }

                const remaining = 42 - gridEl.children.length;
                for (let n = 1; n <= remaining; n++) {
                    gridEl.appendChild(createDayCell(n, false, new Date(year, month + 1)));
                }
            }

            prevBtn.addEventListener('click', () => { displayed.setMonth(displayed.getMonth() - 1); renderCalendar(); });
            nextBtn.addEventListener('click', () => { displayed.setMonth(displayed.getMonth() + 1); renderCalendar(); });

            timeInputEl.addEventListener('input', () => {
                selectedTime = timeInputEl.value;
                updateContinueState();
            });

            renderCalendar();
        })();
    </script>
</body>
</html>