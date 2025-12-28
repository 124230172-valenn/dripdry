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
    <title>No Orders - Drip & Dry Laundry</title>
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
            display: flex;
            flex-direction: column;
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
            text-decoration: none;
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        
        .empty-state {
            text-align: center;
            max-width: 500px;
            padding: 50px 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
        }
        
        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            color: #6c757d;
            font-size: 48px;
        }
        
        .empty-title {
            font-size: 32px;
            font-weight: 700;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .empty-description {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 35px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .action-btn {
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 95, 128, 0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
            transform: translateY(-2px);
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .empty-state {
                padding: 40px 25px;
            }
            
            .empty-icon {
                width: 100px;
                height: 100px;
                font-size: 40px;
            }
            
            .empty-title {
                font-size: 26px;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="nav-controls">
                <a href="dashboard.php" class="nav-btn">
                    <span class="material-symbols-outlined">home</span>
                </a>
            </div>
        </div>
    </div>
    
    <main class="main-content">
        <div class="empty-state">
            <div class="empty-icon">
                <span class="material-symbols-outlined">inventory_2</span>
            </div>
            
            <h1 class="empty-title">No Active Orders</h1>
            <p class="empty-description">
                You haven't made any laundry bookings yet. Start by scheduling your first laundry service 
                and we'll take care of the rest. Fresh, clean clothes are just a few clicks away!
            </p>
            
            <div class="action-buttons">
                <a href="tanggal.php" class="action-btn btn-primary">
                    <span class="material-symbols-outlined">add</span>
                    Book Now
                </a>
                <a href="dashboard.php" class="action-btn btn-secondary">
                    <span class="material-symbols-outlined">dashboard</span>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </main>
</body>
</html>