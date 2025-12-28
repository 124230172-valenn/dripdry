<?php
session_start();
include 'db.php'; // koneksi database

// pastikan ada parameter id
if (!isset($_GET['id'])) {
    header("Location: pesanan.php");
    exit;
}

$booking_id = intval($_GET['id']);

// Ambil data pesanan
$result = mysqli_query($conn, "SELECT * FROM booking WHERE booking_id = $booking_id");
if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Pesanan tidak ditemukan!'); window.location='pesanan.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Proses update status ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = intval($_POST['status']);

    $update = mysqli_query($conn, "UPDATE booking SET status = $new_status WHERE booking_id = $booking_id");

    if ($update) {
        echo "<script>alert('Status pesanan berhasil diperbarui!'); window.location='pesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui status!'); window.location='pesanan.php';</script>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status - Drip & Dry Laundry</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
            margin: 0;
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
            max-width: 1000px;
            margin: 0 auto;
        }

        .logo {
            height: 50px;
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px);
            padding: 20px;
        }

        .card {
            background: white;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            width: 90%;
            max-width: 420px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            color: #4A5F80;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        select {
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            font-size: 15px;
            font-family: 'Nunito', sans-serif;
            outline: none;
            transition: 0.3s;
        }

        select:focus {
            border-color: #4A5F80;
        }

        .btn {
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #4A5F80;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="nav-buttons">
                <a href="pesanan.php" class="nav-btn">
                    <span class="material-symbols-outlined">arrow_back</span> Kembali
                </a>
                <a href="logout.php" class="nav-btn">
                    <span class="material-symbols-outlined">logout</span> Logout
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="card">
            <h1>Update Status Pesanan</h1>
            <form method="POST">
                <label for="status">Status Saat Ini:</label>
                <select name="status" id="status" required>
                    <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>Menunggu</option>
                    <option value="2" <?= $row['status'] == 2 ? 'selected' : '' ?>>Diproses</option>
                    <option value="3" <?= $row['status'] == 3 ? 'selected' : '' ?>>Selesai</option>
                    <option value="4" <?= $row['status'] == 4 ? 'selected' : '' ?>>Dibatalkan</option>
                </select>

                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>
            <a href="pesanan.php" class="back-link">← Kembali ke Daftar Pesanan</a>
        </div>
    </main>
</body>
</html>
