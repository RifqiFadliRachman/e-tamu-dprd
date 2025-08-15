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
        .calendar-day.disabled { color: #9CA3AF; cursor: default; }
        .calendar-day.disabled:hover { background-color: transparent; color: #9CA3AF; transform: none; }
        .day-header { width: 100%; height: 32px; background-color: #e8bf6f; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 600; }
        input[type="time"]::-webkit-calendar-picker-indicator { background: none; display: none; }
        @media (max-width: 768px) {
            .calendar-day { height: 40px; font-size: 0.875rem; }
            .day-header { height: 28px; font-size: 0.625rem; }
            .mobile-hidden { display: none !important; }
        }
        @media (max-width: 480px) {
            .calendar-day { height: 36px; font-size: 0.75rem; }
            .day-header { height: 24px; font-size: 0.625rem; }
        }
    </style>
</head>
<body class="bg-white min-h-screen font-poppins overflow-x-hidden">
    <div class="w-full min-h-screen bg-white flex justify-center items-start">
        <div class="relative w-full max-w-[1440px] min-h-screen md:h-[1024px] bg-white overflow-visible px-4 md:px-0 pb-16">
            
            <header class="absolute top-6 md:top-[93px] right-4 md:right-16 z-10">
                <a href="{{ route('home') }}">
                    <button type="button" class="bg-primary hover:bg-primary-dark p-2 md:p-3 rounded-xl" aria-label="Tutup formulir">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </a>
            </header>
            
            <div class="absolute top-4 md:top-[51px] left-4 md:left-[64px] text-primaryDark text-lg md:text-2xl font-semibold">TAHAP 1</div>
            <div class="absolute top-10 md:top-[87px] left-4 md:left-[64px] text-textPrimary text-2xl md:text-[32px] font-bold">Jadwal Kunjungan</div>
            
            <div class="absolute top-20 md:top-[150px] left-[550px] w-[450px] h-[37px]">
                <div class="absolute top-0 left-0 w-[30px] h-[30px] md:w-[37px] md:h-[37px] bg-primary rounded-full flex items-center justify-center"><span class="text-white text-lg md:text-xl font-bold font-inter">1</span></div>
                <div class="absolute top-[7px] md:top-[10px] left-[60px] md:left-[91px] w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
                <div class="absolute top-[7px] md:top-[10px] left-[120px] md:left-[172px] w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
                <div class="absolute top-[7px] left-[180px] md:left-[253px] w-[16px] h-[16px] md:w-[17px] md:h-[24px] relative"><div class="absolute top-0 md:top-[3px] left-0 w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div></div>
                <div class="absolute top-[7px] md:top-[10px] left-[240px] md:left-[334px] w-[16px] h-[16px] md:w-[17px] md:h-[17px] bg-primary rounded-full"></div>
              
            </div>
            
            <div class="absolute top-32 md:top-[220px] left-1/2 transform -translate-x-1/2 w-[340px] md:w-[555px] h-[50px] md:h-[62px]">
                <div class="w-full h-full bg-primary rounded-[20px] md:rounded-[25px] relative flex items-center justify-center">
                    <div id="prevMonth" class="absolute top-1/2 -translate-y-1/2 left-[12px] md:left-[16px] w-[35px] md:w-[41px] h-[24px] md:h-[28px] cursor-pointer flex items-center justify-center"><svg class="w-[8px] md:w-[10px] h-[12px] md:h-[14px]" viewBox="0 0 10 14" fill="none"><path d="M8 2L2 7l6 5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                    <div id="monthLabel" class="text-white text-xl md:text-[32px] font-semibold text-center"></div>
                    <div id="nextMonth" class="absolute top-1/2 -translate-y-1/2 right-[12px] md:right-[16px] w-[35px] md:w-[45px] h-[24px] md:h-[28px] cursor-pointer flex items-center justify-center"><svg class="w-[9px] md:w-[11px] h-[12px] md:h-[14px]" viewBox="0 0 11 14" fill="none"><path d="M2 2l6 5-6 5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                </div>
            </div>

            <div class="absolute top-44 md:top-[322px] left-1/2 transform -translate-x-1/2 w-[350px] md:w-[846px] h-[400px] md:h-[520px]">
                <div class="absolute top-[1px] left-0 w-full grid" style="grid-template-columns: repeat(7, 1fr); place-items: center;">
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Sen</span></div>
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Sel</span></div>
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Rab</span></div>
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Kam</span></div>
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Jum</span></div>
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Sab</span></div>
                    <div class="w-[30px] h-[24px] md:w-[54px] md:h-[32px] bg-primary rounded-[4px] md:rounded-[5px] flex items-center justify-center"><span class="text-white text-[10px] md:text-xs font-semibold">Min</span></div>
                </div>
                <div id="calendarGrid" class="absolute top-[40px] md:top-[57px] left-0 w-full grid" style="grid-template-columns: repeat(7, 1fr); grid-auto-rows: 40px; column-gap: 2px; row-gap: 12px; place-items: center;"></div>
            </div>
            
            <form id="scheduleForm" method="POST" action="{{ route('jadwal.kunjungan.store') }}">
                @csrf
                <input type="hidden" id="tanggalInput" name="tanggal_kunjungan" value="">
                <div class="absolute bottom-24 md:top-[790px] left-1/2 -translate-x-1/2 w-[240px] md:w-[260px] transform z-10 relative">
                    <input 
                        type="time" 
                        id="timeInput" 
                        name="waktu_kunjungan"
                        min="08:00"
                        max="16:00"
                        required
                        class="w-full h-[54px] md:h-[66px] bg-white border-3 md:border-4 border-primary rounded-lg text-lg md:text-[28px] font-medium text-textPrimary text-center pl-4 pr-12 hover:border-primaryDark focus:border-primaryDark focus:ring-primaryDark transition-colors"
                    >
                    <span class="pointer-events-none absolute top-1/2 left-1/2 -translate-y-1/2 translate-x-[44px] md:translate-x-[64px] text-textSecondary md:text-[20px] text-base font-semibold">WIB</span>
                </div>
                <div class="absolute bottom-24 md:top-[900px] left-1/2 -translate-x-1/2 w-[340px] md:w-[500px] transform">
                    <p class="text-textSecondary text-sm md:text-base font-semibold text-center mb-3">
                        Silakan pilih waktu kunjungan dari opsi berikut
                    </p>
                    <div class="w-full md:w-[286px] h-[48px] md:h-[52px] bg-primary rounded-3xl transition-colors mx-auto flex items-center justify-center hover:bg-primaryDark">
                        <button type="submit" id="continueBtn" class="text-white text-lg md:text-xl font-bold w-full h-full flex items-center justify-center opacity-50 pointer-events-none">
                            Lanjut
                        </button>
                    </div>
                </div>
            </form>
            
            <div class="absolute top-[1140px] left-[672px] w-[949px] h-[1px] bg-gray-200 mobile-hidden"></div>
        </div>
    </div>

    <script>
        (function() {
            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            let displayed = new Date();
            displayed.setDate(1);
            let selectedDate = null;
            let selectedTime = '';

            const monthLabelEl = document.getElementById('monthLabel');
            const gridEl = document.getElementById('calendarGrid');
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');
            const continueBtnEl = document.getElementById('continueBtn');
            const tanggalInputEl = document.getElementById('tanggalInput');
            const formEl = document.getElementById('scheduleForm');
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
            function createDayCell(dayNumber, isCurrentMonth, dateObj) {
                const cell = document.createElement('div');
                cell.className = 'calendar-day' + (isCurrentMonth ? '' : ' disabled');
                cell.textContent = dayNumber;
                if (isCurrentMonth) {
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
                    const dayNum = daysInPrevMonth - i + 1;
                    const prevMonthDate = new Date(year, month - 1, dayNum);
                    gridEl.appendChild(createDayCell(dayNum, false, prevMonthDate));
                }
                for (let d = 1; d <= daysInMonth; d++) {
                    const currentDate = new Date(year, month, d);
                    const cell = createDayCell(d, true, currentDate);
                    if (selectedDate && selectedDate.getFullYear() === year && selectedDate.getMonth() === month && selectedDate.getDate() === d) {
                        cell.classList.add('selected');
                    }
                    gridEl.appendChild(cell);
                }
                const totalCells = 42;
                const usedCells = gridEl.children.length;
                const remaining = totalCells - usedCells;
                for (let n = 1; n <= remaining; n++) {
                    const nextMonthDate = new Date(year, month + 1, n);
                    gridEl.appendChild(createDayCell(n, false, nextMonthDate));
                }
            }
            prevBtn.addEventListener('click', () => { displayed.setMonth(displayed.getMonth() - 1); renderCalendar(); });
            nextBtn.addEventListener('click', () => { displayed.setMonth(displayed.getMonth() + 1); renderCalendar(); });

            timeInputEl.addEventListener('input', () => {
                selectedTime = timeInputEl.value;
                updateContinueState();
            });

            formEl.addEventListener('submit', (e) => {
                if (!(selectedDate && selectedTime)) {
                    e.preventDefault();
                }
            });

            renderCalendar();
        })();
    </script>
</body>
</html>