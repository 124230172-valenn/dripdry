<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Guide - Drip & Dry Laundry</title>
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
        
        .guide-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 30px;
        }
        
        .guide-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .guide-title {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .guide-subtitle {
            font-size: 18px;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .steps-container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
        }
        
        .step {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 35px;
            padding-bottom: 35px;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .step:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .step-content {
            flex: 1;
        }
        
        .step-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .step-description {
            color: #7f8c8d;
            line-height: 1.7;
            font-size: 15px;
        }
        
        .step-icon {
            font-size: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        .action-section {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f8f9fa;
        }
        
        .start-booking-btn {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .start-booking-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(74, 95, 128, 0.3);
        }
        
        @media (max-width: 768px) {
            .guide-container {
                padding: 0 20px;
                margin: 30px auto;
            }
            
            .guide-title {
                font-size: 28px;
            }
            
            .steps-container {
                padding: 30px 25px;
            }
            
            .step {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .step-number {
                align-self: center;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .guide-title {
                font-size: 24px;
            }
            
            .steps-container {
                padding: 25px 20px;
            }
            
            .step-number {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
            
            .step-title {
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
    
    <div class="guide-container">
        <div class="guide-header">
            <h1 class="guide-title">Booking Guide</h1>
            <p class="guide-subtitle">Learn how to book our laundry services in simple steps</p>
        </div>
        
        <div class="steps-container">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3 class="step-title">
                        <span class="material-symbols-outlined step-icon">calendar_today</span>
                        Select Date
                    </h3>
                    <p class="step-description">
                        Choose your preferred pickup date from the calendar. Available dates are shown in white, while past dates are disabled.
                    </p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3 class="step-title">
                        <span class="material-symbols-outlined step-icon">schedule</span>
                        Choose Time Slot
                    </h3>
                    <p class="step-description">
                        Select a convenient 2-hour time slot for pickup. We offer multiple slots throughout the day to fit your schedule.
                    </p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3 class="step-title">
                        <span class="material-symbols-outlined step-icon">list_alt</span>
                        Complete Form
                    </h3>
                    <p class="step-description">
                        Fill in your service preferences including drop-off option and payment method. Review all details before submitting.
                    </p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3 class="step-title">
                        <span class="material-symbols-outlined step-icon">payments</span>
                        Payment & Confirmation
                    </h3>
                    <p class="step-description">
                        For QRIS payments, upload your payment proof. Receive instant confirmation and booking details via email.
                    </p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">5</div>
                <div class="step-content">
                    <h3 class="step-title">
                        <span class="material-symbols-outlined step-icon">local_shipping</span>
                        Pickup & Processing
                    </h3>
                    <p class="step-description">
                        Our team will pick up your laundry at the scheduled time. Track the progress through your dashboard.
                    </p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">6</div>
                <div class="step-content">
                    <h3 class="step-title">
                        <span class="material-symbols-outlined step-icon">task_alt</span>
                        Delivery & Completion
                    </h3>
                    <p class="step-description">
                        Freshly cleaned laundry delivered back to you. Rate our service and get ready for your next booking!
                    </p>
                </div>
            </div>
            
            <div class="action-section">
                <a href="tanggal.php" class="start-booking-btn">Start Booking Now</a>
            </div>
        </div>
    </div>
</body>
</html>