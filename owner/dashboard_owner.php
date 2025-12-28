<?php
session_start();
include 'db.php';

// pastikan login owner
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner'){
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard Owner - Drip & Dry Laundry</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<style>
body {
    font-family:'Nunito',sans-serif;
    background:#f8f9fa;
    color:#2c3e50;
    margin:0;
}
.header {
    background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
    color:white;
    padding:20px 30px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
.header-content {
    max-width:1200px;
    margin:0 auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.logo {
    height:45px;
}
.nav-btn {
    background:rgba(255,255,255,0.2);
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:8px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:6px;
    text-decoration:none;
    transition: all 0.3s ease;
}
.nav-btn:hover {
    background:rgba(255,255,255,0.3);
    transform:translateY(-2px);
}
.container {
    max-width:1200px;
    margin:50px auto;
    text-align:center;
}
h1 {
    text-align:center;
    margin-bottom:10px;
    font-size:32px;
}
.subtitle {
    text-align:center;
    color:#7f8c8d;
    margin-bottom:40px;
    font-size:16px;
}
.grid {
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:30px;
}
.card {
    background:white;
    border-radius:16px;
    width:250px;
    padding:30px 20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    text-decoration:none;
    color:#2c3e50;
    transition:0.3s;
}
.card:hover {
    transform:translateY(-5px);
    box-shadow:0 12px 30px rgba(0,0,0,0.15);
}
.card h2 {
    font-size:20px;
    margin:15px 0 10px;
}
.card p {
    color:#7f8c8d;
    font-size:14px;
    margin:0;
}
.card-icon {
    font-size:40px;
    color:#4A5F80;
}
@media (max-width:768px){
    .grid {
        flex-direction:column;
        gap:20px;
        align-items:center;
    }
}
</style>
</head>
<body>
<header class="header">
    <div class="header-content">
        <img src="../logo.png" alt="Drip & Dry Laundry" class="logo" />
        <a href="logout.php" class="nav-btn">
            <span class="material-symbols-outlined">logout</span> Logout
        </a>
    </div>
</header>

<div class="container">
<h1>Menu Laporan Owner</h1>
<p class="subtitle">Pilih laporan yang ingin ditinjau</p>

<div class="grid">
    <a href="laporan_stok.php" class="card">
        <span class="material-symbols-outlined card-icon">inventory_2</span>
        <h2>Laporan Stok</h2>
        <p>Review stok bahan, pengeluaran bulanan, dan catatan admin.</p>
    </a>

    <a href="laporan_bulanan.php" class="card">
        <span class="material-symbols-outlined card-icon">analytics</span>
        <h2>Laporan Bulanan</h2>
        <p>Lihat total booking, total pendapatan, dan laporan bulan tertentu.</p>
    </a>
</div>
</div>
</body>
</html>
