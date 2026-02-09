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
        /* */
        .calendar-day { width: 100%; height: 54px; display: flex; align-items: center; justify-content: center; font-size: 1.125rem; color: #212427; cursor: pointer; transition: all 0.2s ease; border-radius: 8px; font-weight: 500; }
        .calendar-day:hover { background-color: #e8bf6f; color: #fff; transform: scale(1.05); }
        .calendar-day.selected { background-color: #e8bf6f; color: #fff; font-weight: 600; }
        .calendar-day.disabled { color: #D1D5DB; cursor: default; opacity: 0.4; }
        .calendar-day.disabled:hover { background-color: transparent; color: #D1D5DB; transform: none; }
        .day-header { width: 100%; height: 32px; background-color: #e8bf6f; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 600; }
        input[type="time"]::-webkit-calendar-picker-indicator { background: none; display: none; }
        
        @media (max-width: 768px) {
            .calendar-day { height: 40px; font-size: 0.875rem; }
            .day-header { height: 28px; font-size: 0.625rem; }
            .mobile-hidden { display: none !important; }
        }
    </style>
</head>
<body class="bg-white min-h-screen font-poppins overflow-x-hidden">
    <div class="w-full min-h-screen bg-white flex justify-center items-start">
        <div class="relative w-full max-w-[1440px] min-h-screen md:h-[1024px] bg-white overflow-visible px-4 md:px-0 pb-16">
            
            <header class="absolute top-6 md:top-[93px] right-4 md:right-16 z-10">
                <a href="{{ route('home') }}">
                    <button type="button" class="bg-primary hover:bg-primaryDark p-2 md:p-3 rounded-xl transition-colors" aria-label="Tutup formulir">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </a>
            </header>
            
            <div class="absolute top-4 md:top-[51px] left-4 md:left-[64px] text-primaryDark text-lg md:text-2xl font-semibold">TAHAP 1</div>
            <div class="absolute top-10 md:top-[87px] left-4 md:left-[64px] text-textPrimary text-2xl md:text-[32px] font-bold">Jadwal Kunjungan</div>
            
            <div class="absolute top-20 md:top-[150px] left-1/2 -translate-x-1/2 w-[340px] md:w-[450px] h-[37px] flex justify-center items-center gap-6 md:gap-12">
                <div class="w-[30px] h-[30px] md:w-[37px] md:h-[37px] bg-primary rounded-full flex items-center justify-center"><span class="text-white text-lg md:text-xl font-bold font-inter">1</span></div>
                <div class="w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
                <div class="w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
                <div class="w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
                <div class="w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
            </div>
            
            <div class="absolute top-32 md:top-[220px] left-1/2 transform -translate-x-1/2 w-[340px] md:w-[555px] h-[50px] md:h-[62px]">
                <div class="w-full h-full bg-primary rounded-[20px] md:rounded-[25px] relative flex items-center justify-center">
                    <div id="prevMonth" class="absolute top-1/2 -translate-y-1/2 left-[12px] md:left-[16px] w-[35px] md:w-[41px] h-[24px] md:h-[28px] cursor-pointer flex items-center justify-center"><svg class="w-[8px] md:w-[10px] h-[12px] md:h-[14px]" viewBox="0 0 10 14" fill="none"><path d="M8 2L2 7l6 5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                    <div id="monthLabel" class="text-white text-xl md:text-[32px] font-semibold text-center"></div>
                    <div id="nextMonth" class="absolute top-1/2 -translate-y-1/2 right-[12px] md:right-[16px] w-[35px] md:w-[45px] h-[24px] md:h-[28px] cursor-pointer flex items-center justify-center"><svg class="w-[9px] md:w-[11px] h-[12px] md:h-[14px]" viewBox="0 0 11 14" fill="none"><path d="M2 2l6 5-6 5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                </div>
            </div>

            <div class="absolute top-44 md:top-[322px] left-1/2 transform -translate-x-1/2 w-[350px] md:w-[846px]">
                <div class="w-full grid grid-cols-7 place-items-center mb-4">
                    <div class="day-header w-[40px] md:w-[80px]">Sen</div>
                    <div class="day-header w-[40px] md:w-[80px]">Sel</div>
                    <div class="day-header w-[40px] md:w-[80px]">Rab</div>
                    <div class="day-header w-[40px] md:w-[80px]">Kam</div>
                    <div class="day-header w-[40px] md:w-[80px]">Jum</div>
                    <div class="day-header w-[40px] md:w-[80px]">Sab</div>
                    <div class="day-header w-[40px] md:w-[80px]">Min</div>
                </div>
                <div id="calendarGrid" class="w-full grid grid-cols-7 gap-y-2 md:gap-y-4 place-items-center"></div>
            </div>
            
            <form id="scheduleForm" method="POST" action="{{ route('jadwal.kunjungan.store') }}">
                @csrf
                <input type="hidden" id="tanggalInput" name="tanggal_kunjungan" value="">
                
                <div class="absolute bottom-32 md:top-[790px] left-1/2 -translate-x-1/2 w-[240px] md:w-[260px] z-10">
                    <div class="relative">
                        <input 
                            type="time" 
                            id="timeInput" 
                            name="waktu_kunjungan"
                            min="08:00"
                            max="16:00"
                            required
                            class="w-full h-[54px] md:h-[66px] bg-white border-4 border-primary rounded-xl text-lg md:text-[28px] font-bold text-textPrimary text-center hover:border-primaryDark focus:outline-none transition-colors"
                        >
                        <span class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-textSecondary text-base md:text-xl font-bold">WIB</span>
                    </div>
                </div>

                <div class="absolute bottom-10 md:top-[900px] left-1/2 -translate-x-1/2 w-[340px] md:w-[500px] text-center">
                    <p class="text-textSecondary text-sm md:text-base font-semibold mb-4">
                        Silakan pilih waktu kunjungan dari opsi berikut
                    </p>
                    <button type="submit" id="continueBtn" class="w-full md:w-[286px] h-[52px] bg-primary hover:bg-primaryDark text-white text-xl font-bold rounded-full transition-all opacity-50 pointer-events-none mx-auto block">
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

            //
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

                // Fill previous month days (always disabled)
                for (let i = firstDayIndex; i > 0; i--) {
                    gridEl.appendChild(createDayCell(daysInPrevMonth - i + 1, false, new Date(year, month - 1)));
                }

                // Fill current month days
                for (let d = 1; d <= daysInMonth; d++) {
                    const currentDate = new Date(year, month, d);
                    // Check if date is in the past
                    const isPast = currentDate < today;
                    
                    const cell = createDayCell(d, !isPast, currentDate);
                    
                    if (selectedDate && selectedDate.getTime() === currentDate.getTime()) {
                        cell.classList.add('selected');
                    }
                    gridEl.appendChild(cell);
                }

                // Fill next month days (always disabled)
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