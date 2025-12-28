<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Select Date - Drip & Dry Laundry</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            height: 45px;
        }
        
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .nav-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        .page-title {
            text-align: center;
            padding: 40px 20px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-title h1 {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .page-title p {
            font-size: 18px;
            color: #7f8c8d;
        }
        
        .calendar-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .calendar {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .month-year {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .nav-button {
            background: #4A5F80;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
        }
        
        .nav-button:hover {
            background: #3b4a63;
            transform: translateY(-2px);
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }
        
        .day-name {
            text-align: center;
            font-weight: 700;
            color: #4A5F80;
            font-size: 14px;
            padding: 10px 0;
            text-transform: uppercase;
        }
        
        .date-cell {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            background: #f8f9fa;
            border: 2px solid transparent;
        }
        
        .date-cell:hover:not(.disabled) {
            background: #4A5F80;
            color: white;
            transform: scale(1.05);
        }
        
        .date-cell.selected {
            background: #4A5F80;
            color: white;
            border-color: #3b4a63;
        }
        
        .date-cell.disabled {
            background: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
        }
        
        .instructions {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            max-width: 500px;
            margin: 30px auto;
        }
        
        .instructions h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .instructions ul {
            text-align: left;
            color: #7f8c8d;
            line-height: 1.8;
        }
        
        .instructions li {
            margin-bottom: 8px;
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .calendar-container {
                padding: 15px;
            }
            
            .calendar {
                padding: 20px;
            }
            
            .page-title h1 {
                font-size: 26px;
            }
            
            .month-year {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="nav-controls">
                <button class="nav-btn" onclick="history.back()">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
            </div>
        </div>
    </div>
    
    <div class="page-title">
        <h1>Select Pickup Date</h1>
        <p>Choose your preferred date for laundry service</p>
    </div>
    
    <div class="calendar-container">
        <div class="calendar">
            <div class="calendar-header">
                <button class="nav-button" id="prevMonth">&lt;</button>
                <div class="month-year" id="monthYear"></div>
                <button class="nav-button" id="nextMonth">&gt;</button>
            </div>
            
            <div class="calendar-grid" id="calendarGrid">
                <!-- Day names -->
                <div class="day-name">Sun</div>
                <div class="day-name">Mon</div>
                <div class="day-name">Tue</div>
                <div class="day-name">Wed</div>
                <div class="day-name">Thu</div>
                <div class="day-name">Fri</div>
                <div class="day-name">Sat</div>
            </div>
        </div>
    </div>
    
    <div class="instructions">
        <h3>Booking Instructions</h3>
        <ul>
            <li>Select an available date from the calendar</li>
            <li>Choose your preferred time slot on the next page</li>
            <li>Complete the booking form with your details</li>
            <li>Receive confirmation and tracking information</li>
        </ul>
    </div>

    <script>
        // Calendar functionality
        const monthYear = document.getElementById('monthYear');
        const calendarGrid = document.getElementById('calendarGrid');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');

        let selectedDate = null;
        let currentDate = new Date();

        function isBeforeToday(date, today) {
            return date < today && date.toDateString() !== today.toDateString();
        }

        function renderCalendar(date) {
            while (calendarGrid.children.length > 7) {
                calendarGrid.removeChild(calendarGrid.lastChild);
            }

            const year = date.getFullYear();
            const month = date.getMonth();
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                               'July', 'August', 'September', 'October', 'November', 'December'];
            monthYear.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1);
            const startingDay = firstDay.getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const prevMonthDays = new Date(year, month, 0).getDate();

            const today = new Date();
            today.setHours(0,0,0,0);

            for (let i = 0; i < startingDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('date-cell', 'disabled');
                emptyCell.textContent = prevMonthDays - startingDay + 1 + i;
                calendarGrid.appendChild(emptyCell);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateCell = document.createElement('div');
                dateCell.classList.add('date-cell');
                dateCell.textContent = day;

                const cellDate = new Date(year, month, day);

                if (isBeforeToday(cellDate, today)) {
                    dateCell.classList.add('disabled');
                } else {
                    dateCell.addEventListener('click', () => {
                        if (selectedDate) {
                            selectedDate.classList.remove('selected');
                        }
                        dateCell.classList.add('selected');
                        selectedDate = dateCell;

                        const selectedDateStr = `${cellDate.getFullYear()}-${String(cellDate.getMonth()+1).padStart(2, '0')}-${String(cellDate.getDate()).padStart(2, '0')}`;
                        
                        setTimeout(() => {
                            window.location.href = `waktu.php?date=${selectedDateStr}`;
                        }, 300);
                    });
                }
                calendarGrid.appendChild(dateCell);
            }

            const totalCells = startingDay + daysInMonth;
            const nextDays = 42 - totalCells;
            for (let i = 1; i <= nextDays; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('date-cell', 'disabled');
                emptyCell.textContent = i;
                calendarGrid.appendChild(emptyCell);
            }
        }

        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate);
        });

        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate);
        });

        renderCalendar(currentDate);
    </script>
</body>
</html>