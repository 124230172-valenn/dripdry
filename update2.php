<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php?pesan=belum_login");
    exit;
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Laundry - Drip & Dry Laundry</title>
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
        
        .status-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        
        .status-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        
        .update-button {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(74, 95, 128, 0.3);
        }
        
        .update-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 95, 128, 0.4);
        }
        
        .alarm {
            margin: 25px 0;
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            color: #2c3e50;
        }
        
        .alarm input[type="checkbox"] {
            width: 50px;
            height: 26px;
            appearance: none;
            background: #ccc;
            border-radius: 13px;
            position: relative;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .alarm input[type="checkbox"]:checked {
            background: #4cd964;
        }
        
        .alarm input[type="checkbox"]::before {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            background: white;
            transition: 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .alarm input[type="checkbox"]:checked::before {
            left: 26px;
        }
        
        .status-bar {
            margin: 40px 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        
        .step {
            text-align: center;
            flex: 1;
            position: relative;
            z-index: 2;
        }
        
        .step-icon {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .step .material-symbols-outlined {
            font-size: 28px;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        
        .step-label {
            font-size: 12px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        
        .line-connector {
            flex: 1;
            height: 3px;
            background: #e9ecef;
            margin: 0 10px;
            position: relative;
            top: -15px;
            transition: all 0.3s ease;
        }
        
        .step.active .step-icon {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            border-color: #4A5F80;
            transform: scale(1.1);
        }
        
        .step.active .material-symbols-outlined {
            color: white;
        }
        
        .step.active .step-label {
            color: #4A5F80;
            font-weight: 700;
        }
        
        .line-connector.active {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
        }
        
        .status-info {
            margin-top: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid #4A5F80;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        @media (max-width: 768px) {
            .status-container {
                padding: 30px 25px;
            }
            
            .status-title {
                font-size: 28px;
            }
            
            .step-icon {
                width: 50px;
                height: 50px;
            }
            
            .step .material-symbols-outlined {
                font-size: 24px;
            }
            
            .step-label {
                font-size: 11px;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .status-container {
                padding: 25px 20px;
            }
            
            .status-title {
                font-size: 24px;
            }
            
            .step-label {
                font-size: 10px;
            }
            
            .alarm {
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
                <a href="dashboard.php" class="nav-btn">
                    <span class="material-symbols-outlined">home</span>
                </a>
            </div>
        </div>
    </div>
    
    <main class="main-content">
        <div class="status-container">
            <h1 class="status-title">Status Laundry</h1>
            
            <button class="update-button" onclick="refreshStatus()" id="refreshBtn">
                <span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;">refresh</span>
                Update
            </button>

            <div class="alarm">
                <label for="alarm">Set Alarm</label>
                <input type="checkbox" id="alarm" onchange="toggleAlarm(this.checked)" />
            </div>

            <div class="status-info" id="statusInfo">
                Memuat status...
            </div>

            <div class="status-bar">
                <div class="step" id="step1">
                    <div class="step-icon">
                        <span class="material-symbols-outlined">local_mall</span>
                    </div>
                    <div class="step-label">Drop Off</div>
                </div>
                <div class="line-connector" id="line1"></div>
                <div class="step" id="step2">
                    <div class="step-icon">
                        <span class="material-symbols-outlined">local_laundry_service</span>
                    </div>
                    <div class="step-label">Dicuci</div>
                </div>
                <div class="line-connector" id="line2"></div>
                <div class="step" id="step3">
                    <div class="step-icon">
                        <span class="material-symbols-outlined">dry</span>
                    </div>
                    <div class="step-label">Dikeringkan</div>
                </div>
                <div class="line-connector" id="line3"></div>
                <div class="step" id="step4">
                    <div class="step-icon">
                        <span class="material-symbols-outlined">task_alt</span>
                    </div>
                    <div class="step-label">Selesai</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentStep = 0;
        let alarmInterval = null;
        let isRefreshing = false;

        // Fungsi untuk update tampilan status
        function updateStatusDisplay(step) {
            // Reset semua step
            for (let i = 1; i <= 4; i++) {
                document.getElementById('step' + i).classList.remove('active');
                if (i < 4) {
                    document.getElementById('line' + i).classList.remove('active');
                }
            }
            
            // Aktifkan step sesuai status
            for (let i = 1; i <= step; i++) {
                document.getElementById('step' + i).classList.add('active');
                if (i < 4) {
                    document.getElementById('line' + i).classList.add('active');
                }
            }
            
            // Update status info
            const statusText = ['Menunggu konfirmasi', 'Sedang dicuci', 'Sedang dikeringkan', 'Selesai'];
            document.getElementById('statusInfo').textContent = statusText[step - 1] || 'Menunggu booking';
        }

        // Fungsi untuk mengambil status dari server
        function refreshStatus() {
            if (isRefreshing) return;
            
            isRefreshing = true;
            const refreshBtn = document.getElementById('refreshBtn');
            refreshBtn.classList.add('loading');
            refreshBtn.innerHTML = '<span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;">autorenew</span> Memuat...';

            fetch('get_status.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status !== currentStep) {
                        currentStep = data.status;
                        updateStatusDisplay(currentStep);
                        
                        // Jika alarm aktif dan status berubah, tampilkan notifikasi
                        if (document.getElementById('alarm').checked && data.status > 0) {
                            showNotification('Status berubah: ' + 
                                ['Drop Off', 'Dicuci', 'Dikeringkan', 'Selesai'][data.status - 1]);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('statusInfo').textContent = 'Error memuat status';
                })
                .finally(() => {
                    isRefreshing = false;
                    refreshBtn.classList.remove('loading');
                    refreshBtn.innerHTML = '<span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;">refresh</span> Update';
                });
        }

        // Fungsi untuk toggle alarm
        function toggleAlarm(isOn) {
            if (isOn) {
                // Auto-refresh setiap 30 detik saat alarm aktif
                alarmInterval = setInterval(refreshStatus, 30000);
                showNotification('Alarm notifikasi diaktifkan');
            } else {
                if (alarmInterval) {
                    clearInterval(alarmInterval);
                    alarmInterval = null;
                }
            }
            
            // Simpan preference ke local storage
            localStorage.setItem('laundryAlarm', isOn);
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message) {
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('Drip & Dry', {
                    body: message,
                    icon: 'logo.png'
                });
            } else if ('Notification' in window && Notification.permission !== 'denied') {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        new Notification('Drip & Dry', {
                            body: message,
                            icon: 'logo.png'
                        });
                    }
                });
            }
            
            // Fallback: alert biasa
            alert(message);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Load alarm preference
            const alarmPreference = localStorage.getItem('laundryAlarm');
            if (alarmPreference === 'true') {
                document.getElementById('alarm').checked = true;
                toggleAlarm(true);
            }
            
            // Minta izin notifikasi
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission();
            }
            
            // Load status awal
            refreshStatus();
            
            // Auto-refresh status setiap 30 detik
            setInterval(refreshStatus, 30000);
        });
    </script>
</body>
</html>