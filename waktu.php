<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Select Time - Drip & Dry Laundry</title>
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
            padding: 40px 20px 30px;
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
        
        .selected-date {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            display: inline-block;
            margin: 10px 0 30px;
            font-weight: 600;
            color: #4A5F80;
            border: 2px solid #e9ecef;
        }
        
        .time-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .time-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .time-slot {
            background: white;
            padding: 20px 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #f1f3f4;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .time-slot:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 95, 128, 0.15);
            border-color: #4A5F80;
        }
        
        .time-slot.selected {
            background: #4A5F80;
            color: white;
            border-color: #3b4a63;
            transform: translateY(-2px);
        }
        
        .info-box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-top: 30px;
            border-left: 4px solid #4A5F80;
        }
        
        .info-box h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .info-box ul {
            color: #7f8c8d;
            line-height: 1.8;
            padding-left: 20px;
        }
        
        .info-box li {
            margin-bottom: 8px;
        }
        
        @media (max-width: 768px) {
            .time-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .time-slot {
                padding: 18px 15px;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .page-title h1 {
                font-size: 26px;
            }
            
            .time-container {
                padding: 15px;
            }
            
            .selected-date {
                padding: 12px 20px;
                font-size: 14px;
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
        <h1>Select Time Slot</h1>
        <p>Choose your preferred pickup time</p>
        <div class="selected-date" id="dateDisplay"></div>
    </div>
    
    <div class="time-container">
        <div class="time-grid" id="timeGrid"></div>
    </div>
    
    <div class="time-container">
        <div class="info-box">
            <h3>Service Information</h3>
            <ul>
                <li>Each time slot is 2 hours duration</li>
                <li>Same-day processing available</li>
                <li>Free pickup and delivery within service area</li>
                <li>Real-time tracking available</li>
            </ul>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const selectedDate = urlParams.get('date');
        const dateDisplay = document.getElementById('dateDisplay');
        const timeGrid = document.getElementById('timeGrid');

        if (!selectedDate) {
            dateDisplay.textContent = 'No date selected';
            dateDisplay.style.background = '#fee';
            dateDisplay.style.color = '#c33';
        } else {
            const dateObj = new Date(selectedDate);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateDisplay.textContent = dateObj.toLocaleDateString('en-US', options);
        }

        const timeSlots = [
            '09:00 - 11:00',
            '11:00 - 13:00',
            '13:00 - 15:00',
            '15:00 - 17:00',
            '17:00 - 19:00',
            '19:00 - 21:00',
            '21:00 - 23:00',
            '23:00 - 01:00'
        ];

        let selectedTimeSlot = null;

        function renderTimeSlots() {
            timeGrid.innerHTML = '';

            timeSlots.forEach(time => {
                const slot = document.createElement('div');
                slot.classList.add('time-slot');
                slot.textContent = time;

                slot.addEventListener('click', () => {
                    if (selectedTimeSlot) {
                        selectedTimeSlot.classList.remove('selected');
                    }

                    slot.classList.add('selected');
                    selectedTimeSlot = slot;

                    localStorage.setItem('selectedDate', selectedDate);
                    localStorage.setItem('selectedTime', time);

                    setTimeout(() => {
                        window.location.href = `form.php?date=${selectedDate}&time=${time}`;
                    }, 400);
                });

                timeGrid.appendChild(slot);
            });
        }

        renderTimeSlots();
    </script>
</body>
</html>