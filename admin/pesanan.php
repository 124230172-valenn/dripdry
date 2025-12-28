<?php
session_start();
include 'db.php'; // file koneksi

// Ambil semua data pesanan dari database
$query = mysqli_query($conn, "
    SELECT 
        b.booking_id,
        u.username AS pelanggan,
        s.name AS jasa,
        b.date,
        b.time,
        b.payment,
        b.dropoff,
        b.status
    FROM booking b
    LEFT JOIN user u ON b.id_user = u.id
    LEFT JOIN services s ON b.service_id = s.id
    ORDER BY b.booking_id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Drip & Dry Laundry</title>
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #f1f3f4;
            font-size: 15px;
        }

        th {
            background: #4A5F80;
            color: white;
            font-weight: 700;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .status {
            padding: 6px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            display: inline-block;
        }

        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cce5ff; color: #004085; }
        .status.completed { background: #d4edda; color: #155724; }
        .status.cancelled { background: #f8d7da; color: #721c24; }

        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-update {
            background: #4A5F80;
            color: white;
        }

        .btn-update:hover {
            background: #3b4a63;
        }

        .center {
            text-align: center;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 13px;
            }

            .header-content {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="../logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="nav-buttons">
                <a href="dashboard_admin.php" class="nav-btn">
                    <span class="material-symbols-outlined">arrow_back</span> Kembali
                </a>
                <a href="logout.php" class="nav-btn">
                    <span class="material-symbols-outlined">logout</span> Logout
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <h1>Daftar Pesanan Pelanggan</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Jasa</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Metode</th>
                <th>Dropoff</th>
                <th>Status</th>
                <th class="center">Aksi</th>
            </tr>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($row['booking_id']); ?></td>
                        <td><?= htmlspecialchars($row['pelanggan'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['jasa'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['date']); ?></td>
                        <td><?= htmlspecialchars($row['time']); ?></td>
                        <td><?= strtoupper(htmlspecialchars($row['payment'])); ?></td>
                        <td><?= $row['dropoff'] ? 'Ya' : 'Tidak'; ?></td>
                        <td>
                            <?php
                                $status_class = [
                                    1 => 'pending',
                                    2 => 'processing',
                                    3 => 'completed',
                                    4 => 'cancelled'
                                ][$row['status']] ?? 'pending';

                                $status_text = [
                                    1 => 'Menunggu',
                                    2 => 'Diproses',
                                    3 => 'Selesai',
                                    4 => 'Dibatalkan'
                                ][$row['status']] ?? 'Menunggu';
                            ?>
                            <span class="status <?= $status_class; ?>"><?= $status_text; ?></span>
                        </td>
                        <td class="center">
                            <a href="update_status.php?id=<?= $row['booking_id']; ?>" class="btn btn-update">Update</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="9" class="center">Belum ada pesanan.</td></tr>
            <?php endif; ?>
        </table>
    </main>
</body>
</html>
