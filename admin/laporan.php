<?php
session_start();
include 'db.php';

// Ambil info user (opsional, bisa pakai untuk greeting)
$user = $_SESSION['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Laporan - Drip & Dry Laundry</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');

/* Reset & basic */
body {font-family:'Nunito',sans-serif; background:#f8f9fa; color:#2c3e50; margin:0;}

/* Header */
.header {
    background: linear-gradient(135deg,#4A5F80 0%,#3b4a63 100%);
    color:white;
    padding:20px 30px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
.header-content {display:flex; justify-content:space-between; align-items:center; max-width:1200px; margin:0 auto;}
.logo {height:45px;}
.nav-buttons {display:flex; gap:10px;}
.nav-btn {
    background: rgba(255,255,255,0.2);
    color:white;
    border:none;
    padding:10px 14px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:5px;
    transition:all 0.3s ease;
}
.nav-btn:hover {background: rgba(255,255,255,0.3); transform:translateY(-2px);}

/* Main */
main {max-width:1100px; margin:40px auto; padding:0 20px;}
h1 {text-align:center; margin-bottom:30px; font-size:28px; font-weight:700; color:#2c3e50;}

/* Cards menu */
.cards {display:flex; flex-wrap:wrap; gap:30px; justify-content:center; margin-top:20px;}
.card {
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    width:220px; height:180px; border-radius:16px;
    color:white; text-decoration:none;
    box-shadow:0 8px 25px rgba(0,0,0,0.15);
    transition:all 0.3s;
    font-weight:600; font-size:18px;
    text-align:center;
}
.card span {margin-bottom:10px; font-size:50px;}
.card:hover {transform:translateY(-5px); box-shadow:0 12px 30px rgba(0,0,0,0.2);}
.btn-stok {background: linear-gradient(135deg,#1E90FF,#3b82f6);}
.btn-bulanan {background: linear-gradient(135deg,#28a745,#4caf50);}

/* Responsive */
@media(max-width:600px){.cards{flex-direction:column; align-items:center;}}
</style>
</head>
<body>

<header class="header">
    <div class="header-content">
        <img src="../logo.png" class="logo" alt="Drip & Dry Laundry">
        <div class="nav-buttons">
            <a href="dashboard_admin.php" class="nav-btn"><span class="material-symbols-outlined">home</span>Dashboard</a>
            <a href="logout.php" class="nav-btn"><span class="material-symbols-outlined">logout</span>Logout</a>
        </div>
    </div>
</header>

<main>
    <h1>Menu Laporan</h1>
    <p style="text-align:center; color:#7f8c8d; font-weight:500;">Laporan apa nih yang mau dibuat:</p>

    <div class="cards">
        <a href="laporan_stok.php" class="card btn-stok">
            <span class="material-symbols-outlined">inventory_2</span>
            Laporan Stok
        </a>

        <a href="laporan_bulanan.php" class="card btn-bulanan">
            <span class="material-symbols-outlined">calendar_month</span>
            Laporan Bulanan
        </a>
    </div>
</main>

</body>
</html>
