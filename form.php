<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Booking Form - Drip & Dry Laundry</title>
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
        
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .booking-card {
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            color: #2c3e50;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 15px;
        }
        
        .input-field {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e8ecef;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #4A5F80;
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 95, 128, 0.1);
        }
        
        .input-field:read-only {
            background: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .toggle-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            border: 2px solid #e8ecef;
            margin: 20px 0;
        }
        
        .toggle-label {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .price-info {
            color: #4A5F80;
            font-weight: 600;
            font-size: 14px;
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ccc;
            transition: .4s;
            border-radius: 30px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background: #4A5F80;
        }
        
        input:checked + .slider:before {
            transform: translateX(30px);
        }
        
        .select-field {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e8ecef;
            border-radius: 10px;
            font-size: 15px;
            background: #f8f9fa;
            font-family: 'Nunito', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .select-field:focus {
            outline: none;
            border-color: #4A5F80;
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 95, 128, 0.1);
        }
        
        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-family: 'Nunito', sans-serif;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 95, 128, 0.3);
        }
        
        .info-text {
            font-size: 13px;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .page-title h1 {
                font-size: 26px;
            }
            
            .form-container {
                padding: 15px;
            }
            
            .booking-card {
                padding: 25px;
            }
            
            .toggle-group {
                padding: 15px;
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
        <h1>Complete Your Booking</h1>
        <p>Review and confirm your laundry service details</p>
    </div>
    
    <div class="form-container">
        <div class="booking-card">
            <form id="bookingForm" action="bukti.php" method="POST">
                <div class="form-group">
                    <label for="date">Pickup Date</label>
                    <input type="text" id="date" name="date" class="input-field" readonly />
                </div>
                
                <div class="form-group">
                    <label for="time">Time Slot</label>
                    <input type="text" id="time" name="time" class="input-field" readonly />
                </div>
                
                <div class="toggle-group">
                    <div>
                        <div class="toggle-label">Drop-off Service</div>
                        <div class="price-info">+ Rp 5.000 (Convenience Fee)</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="dropoff" name="dropoff" value="1" />
                        <span class="slider"></span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label for="payment">Payment Method</label>
                    <select id="payment" name="payment" class="select-field" required>
                        <option value="" disabled selected>Select payment method</option>
                        <option value="cash">Cash on Delivery</option>
                        <option value="qris">QRIS Transfer</option>
                    </select>
                    <div class="info-text">QRIS payment requires proof upload after booking</div>
                </div>

                <button type="submit" class="submit-btn">Complete Booking</button>
            </form>
        </div>
    </div>

    <script>
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');

        const savedDate = localStorage.getItem('selectedDate');
        const savedTime = localStorage.getItem('selectedTime');

        if (savedDate) {
            const dateObj = new Date(savedDate);
            const formattedDate = dateObj.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            dateInput.value = formattedDate;
        } else {
            dateInput.value = 'Date not available';
        }

        if (savedTime) {
            timeInput.value = savedTime;
        } else {
            timeInput.value = 'Time not available';
        }

        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            const payment = document.getElementById('payment').value;
            if (!payment) {
                e.preventDefault();
                alert('Please select a payment method.');
                return false;
            }
            return true;
        });
    </script>
</body>
</html>