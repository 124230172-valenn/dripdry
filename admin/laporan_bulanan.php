<?php
session_start();
include 'db.php'; // koneksi database

// default bulan & tahun sekarang
$bulan = isset($_POST['bulan']) ? intval($_POST['bulan']) : date('m');
$tahun = isset($_POST['tahun']) ? intval($_POST['tahun']) : date('Y');

// Ambil data booking bulan itu
$sql = "SELECT booking_id, date, time, total_price, status, id_user 
        FROM booking 
        WHERE MONTH(date) = ? AND YEAR(date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $bulan, $tahun);
$stmt->execute();
$result = $stmt->get_result();

// Hitung total pendapatan
$totalPendapatan = 0;
$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
    $totalPendapatan += $row['total_price'];
}
$stmt->close();

// Array nama bulan
$namaBulan = [
    1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',
    7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Bulanan - Drip & Dry Laundry</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
<style>
body { font-family: 'Nunito', sans-serif; background:#f8f9fa; color:#2c3e50; margin:0; }
.header { background: linear-gradient(135deg,#4A5F80 0%,#3b4a63 100%); color:white; padding:20px 30px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
.logo { height:45px; }
.nav-buttons { display:flex; gap:10px; }
.nav-btn { background: rgba(255,255,255,0.2); color:white; border:none; padding:10px 14px; border-radius:8px; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:5px; transition: all 0.3s ease; }
.nav-btn:hover { background: rgba(255,255,255,0.3); transform: translateY(-2px); }

.container { max-width:1000px; margin:40px auto; padding:0 20px; }
h1 { text-align:center; margin-bottom:30px; font-size:28px; font-weight:700; }
form { display:flex; justify-content:center; gap:15px; margin-bottom:30px; }
select, input { padding:8px; border-radius:8px; border:1px solid #ccc; font-size:15px; }
button { padding:10px 20px; border:none; border-radius:8px; background:#4A5F80; color:white; font-weight:600; cursor:pointer; transition:0.3s; }
button:hover { background:#3b4a63; }

table { width:100%; border-collapse:collapse; background:white; border-radius:16px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.08); }
th,td { padding:14px 16px; text-align:left; border-bottom:1px solid #f1f3f4; font-size:15px; }
th { background:#4A5F80; color:white; font-weight:700; }
tr:hover { background:#f8f9fa; }
.center { text-align:center; }
.total { font-weight:700; font-size:18px; margin-top:20px; text-align:right; }
.action-btn { margin-top:20px; display:inline-block; padding:10px 20px; border-radius:8px; background:#28a745; color:white; text-decoration:none; font-weight:600; transition:0.3s; }
.action-btn:hover { background:#218838; }
</style>
</head>
<body>

<header class="header">
    <img src="../logo.png" alt="Drip & Dry Laundry" class="logo">
    <div class="nav-buttons">
        <a href="dashboard_admin.php" class="nav-btn">
            <span class="material-symbols-outlined">arrow_back</span> Dashboard
        </a>
        <a href="logout.php" class="nav-btn">
            <span class="material-symbols-outlined">logout</span> Logout
        </a>
    </div>
</header>

<div class="container">
<h1>Laporan Bulanan</h1>

<form method="POST">
    <select name="bulan" required>
        <?php foreach($namaBulan as $num=>$name): ?>
            <option value="<?= $num ?>" <?= $num==$bulan?'selected':'' ?>><?= $name ?></option>
        <?php endforeach; ?>
    </select>
    <select name="tahun" required>
        <?php for($y=date('Y');$y>=2020;$y--): ?>
            <option value="<?= $y ?>" <?= $y==$tahun?'selected':'' ?>><?= $y ?></option>
        <?php endfor; ?>
    </select>
    <button type="submit">Tampilkan</button>
</form>

<?php if(count($bookings)>0): ?>
<table>
    <tr>
        <th>ID Booking</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Total Harga (Rp)</th>
        <th>Status</th>
    </tr>
    <?php foreach($bookings as $b): ?>
    <tr>
        <td>#<?= $b['booking_id'] ?></td>
        <td><?= $b['date'] ?></td>
        <td><?= $b['time'] ?></td>
        <td>Rp <?= number_format($b['total_price'],0,',','.') ?></td>
        <td>
            <?php
            $statusText = [1=>'Menunggu',2=>'Diproses',3=>'Selesai',4=>'Dibatalkan'];
            echo $statusText[$b['status']] ?? '-';
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="total">Total Pendapatan: Rp <?= number_format($totalPendapatan,0,',','.') ?></div>

<a href="#" class="action-btn">Kirim ke Owner</a>

<?php else: ?>
<p class="center">Belum ada booking untuk bulan ini.</p>
<?php endif; ?>

</div>
</body>
</html>
