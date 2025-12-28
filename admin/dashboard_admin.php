<?php
session_start();

// Cek apakah sudah login dan role admin
if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Drip & Dry Laundry</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
        }

        /* Header */
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

        .logo { height: 50px; }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info { text-align: right; }
        .user-name { font-weight: 700; font-size: 16px; }
        .user-role { font-size: 13px; opacity: 0.9; }

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

        .logout-btn:hover { background: rgba(255,255,255,0.3); transform: translateY(-1px); }

        /* Main */
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
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            font-size: 18px;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Grid fitur */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
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
            margin-bottom: 20px;
            color: white;
            font-size: 32px;
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feature-desc {
            color: #7f8c8d;
            line-height: 1.6;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .features-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="../logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="user-menu">
                <div class="user-info">
                    <div class="user-name">Halo, <?= htmlspecialchars($_SESSION['admin']); ?></div>
                    <div class="user-role">Admin (Staff)</div>
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
            <h1 class="welcome-title">Dashboard Staff</h1>
            <p class="welcome-subtitle">
                Selamat datang di panel admin Drip & Dry Laundry.<br>
                Kelola pesanan pelanggan, ubah status cucian, dan buat laporan.
            </p>
        </section>

        <section class="features-grid">
            <!-- 1. Lihat Data Pesanan -->
            <div class="feature-card" onclick="location.href='pesanan.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">list_alt</span>
                </div>
                <h3 class="feature-title">Lihat Data Pesanan</h3>
                <p class="feature-desc">Tampilkan daftar pesanan pelanggan yang sedang aktif atau sudah selesai.</p>
            </div>

            <!-- 2. Update Status Pesanan -->
            <div class="feature-card" onclick="location.href='update_status.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">sync</span>
                </div>
                <h3 class="feature-title">Ubah Status Pesanan</h3>
                <p class="feature-desc">Perbarui status cucian pelanggan: Menunggu, Diproses, atau Selesai.</p>
            </div>

            <!-- 3. Laporan -->
            <div class="feature-card" onclick="location.href='laporan.php'">
                <div class="feature-icon">
                    <span class="material-symbols-outlined">bar_chart</span>
                </div>
                <h3 class="feature-title">Buat Laporan</h3>
                <p class="feature-desc">Hasilkan laporan stok dan laporan bulanan untuk pemantauan bisnis.</p>
            </div>
        </section>
    </main>
</body>
</html>
