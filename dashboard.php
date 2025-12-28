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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Drip & Dry Laundry</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
            height: 50px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            text-align: right;
        }
        
        .user-name {
            font-weight: 700;
            font-size: 16px;
        }
        
        .user-email {
            font-size: 13px;
            opacity: 0.9;
        }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-1px);
        }
        
        .main-content {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 30px;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .welcome-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .welcome-subtitle {
            font-size: 18px;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .feature-card {
            background: white;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #f1f3f4;
            cursor: pointer;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(74, 95, 128, 0.15);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: white;
            font-size: 32px;
        }
        
        .feature-title {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
        }
        
        .feature-desc {
            color: #7f8c8d;
            line-height: 1.6;
            font-size: 15px;
            max-width: 300px;
        }
        
        .quick-stats {
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        
        .stats-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .stat-item {
            text-align: center;
            padding: 25px 20px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .stat-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #4A5F80;
            margin-bottom: 8px;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-weight: 600;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .user-info {
                text-align: center;
            }
            
            .main-content {
                padding: 0 20px;
                margin: 30px auto;
            }
            
            .welcome-title {
                font-size: 26px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .feature-card {
                padding: 30px 25px;
                min-height: 200px;
            }
            
            .feature-icon {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .welcome-title {
                font-size: 22px;
            }
            
            .welcome-subtitle {
                font-size: 16px;
            }
            
            .feature-card {
                padding: 25px 20px;
            }
            
            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            
            .feature-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="user-menu">
                <div class="user-info">
                    <div class="user-name">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($_SESSION['email']); ?></div>
                </div>
                <a href="logout.php" class="logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                    Logout
                </a>
            </div>
        </div>
    </header>
    
    <main class="main-content">
        <section class="welcome-section">
            <h1 class="welcome-title">Welcome to Drip & Dry</h1>
            <p class="welcome-subtitle">Professional laundry services at your fingertips. Book, track, and manage your laundry with ease.</p>
        </section>
        
        <section class="features-grid">
            <div class="feature-card" onclick="location.href='tutorbook.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">menu_book</span>
                </div>
                <h3 class="feature-title">Booking Guide</h3>
                <p class="feature-desc">Learn how to book our laundry services step by step</p>
            </div>
            
            <div class="feature-card" onclick="location.href='tutorcuci.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">local_laundry_service</span>
                </div>
                <h3 class="feature-title">Laundry Guide</h3>
                <p class="feature-desc">Complete guide for washing and drying your clothes</p>
            </div>
            
            <div class="feature-card" onclick="location.href='tanggal.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">schedule</span>
                </div>
                <h3 class="feature-title">Book Now</h3>
                <p class="feature-desc">Schedule your laundry service at your preferred time</p>
            </div>
            
            <div class="feature-card" onclick="location.href='cekupdate.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">update</span>
                </div>
                <h3 class="feature-title">Track Order</h3>
                <p class="feature-desc">Check the status of your current laundry order</p>
            </div>
        </section>
        
        <section class="quick-stats">
            <h2 class="stats-title">Why Choose Drip & Dry?</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Service Available</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">2H</div>
                    <div class="stat-label">Fast Processing</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Quality Guarantee</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>