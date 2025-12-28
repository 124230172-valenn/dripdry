<?php
session_start();
include 'db.php';

// Proses tambah data baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bulan = mysqli_real_escape_string($conn, $_POST['bulan']);
    $tahun = intval($_POST['tahun']);
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $jumlah = intval($_POST['jumlah']);
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    $harga = floatval($_POST['harga']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);

    mysqli_query($conn, "
        INSERT INTO laporan_stok (bulan, tahun, nama_barang, jumlah, satuan, harga, catatan)
        VALUES ('$bulan', $tahun, '$nama_barang', $jumlah, '$satuan', $harga, '$catatan')
    ");

    echo "<script>alert('Laporan stok berhasil ditambahkan!'); window.location='laporan_stok.php';</script>";
    exit;
}

// Ambil filter bulan & tahun
$filter_bulan = $_GET['bulan'] ?? date('F');
$filter_tahun = $_GET['tahun'] ?? date('Y');

// Ambil data sesuai bulan dan tahun
$query = mysqli_query($conn, "
    SELECT * FROM laporan_stok 
    WHERE bulan = '$filter_bulan' AND tahun = '$filter_tahun'
    ORDER BY created_at DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Stok - Drip & Dry Laundry</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');
body {font-family:'Nunito',sans-serif;background:#f8f9fa;color:#2c3e50;margin:0;}
.header {background:linear-gradient(135deg,#4A5F80 0%,#3b4a63 100%);color:white;padding:20px 30px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}
.header-content {display:flex;justify-content:space-between;align-items:center;max-width:1200px;margin:0 auto;}
.logo {height:45px;}
.nav-buttons {display:flex;gap:10px;}
.nav-btn {background:rgba(255,255,255,0.2);color:white;border:none;padding:10px 14px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:5px;transition:all 0.3s ease;}
.nav-btn:hover {background:rgba(255,255,255,0.3);transform:translateY(-2px);}
main {max-width:1100px;margin:40px auto;padding:0 20px;}
h1 {text-align:center;margin-bottom:20px;color:#2c3e50;font-size:28px;font-weight:700;}
form {background:white;padding:20px;border-radius:16px;box-shadow:0 5px 20px rgba(0,0,0,0.08);margin-bottom:30px;}
form input, form select, form textarea {width:100%;padding:10px;margin:6px 0;border-radius:8px;border:1px solid #ddd;}
form button {padding:10px 16px;background:#4A5F80;color:white;border:none;border-radius:8px;font-weight:600;cursor:pointer;}
form button:hover {background:#3b4a63;}
table {width:100%;border-collapse:collapse;background:white;border-radius:16px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.08);}
th, td {padding:12px 14px;text-align:left;border-bottom:1px solid #f1f3f4;font-size:15px;}
th {background:#4A5F80;color:white;}
tr:hover {background:#f8f9fa;}
.center {text-align:center;}
.total {font-weight:700;color:#4A5F80;}
</style>
</head>
<body>
<header class="header">
    <div class="header-content">
        <img src="../logo.png" class="logo" alt="Drip & Dry Laundry">
        <div class="nav-buttons">
            <a href="dashboard_admin.php" class="nav-btn"><span class="material-symbols-outlined">arrow_back</span>Kembali</a>
            <a href="logout.php" class="nav-btn"><span class="material-symbols-outlined">logout</span>Logout</a>
        </div>
    </div>
</header>

<main>
    <h1>Laporan Stok Bulanan</h1>

    <form method="GET" style="margin-bottom:20px;">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            <?php 
            $bulanList = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            foreach ($bulanList as $b) {
                $sel = $b == $filter_bulan ? 'selected' : '';
                echo "<option $sel>$b</option>";
            }
            ?>
        </select>

        <label for="tahun">Pilih Tahun:</label>
        <input type="number" name="tahun" value="<?= $filter_tahun ?>" min="2020" max="2030">

        <button type="submit">Tampilkan</button>
    </form>

    <form method="POST">
        <h3>Tambah Data Stok Baru</h3>
        <input type="text" name="nama_barang" placeholder="Nama Barang" required>
        <input type="number" name="jumlah" placeholder="Jumlah" required>
        <input type="text" name="satuan" placeholder="Satuan (botol, kg, liter...)" required>
        <input type="number" step="0.01" name="harga" placeholder="Harga Total (Rp)" required>
        <input type="text" name="bulan" value="<?= $filter_bulan ?>" hidden>
        <input type="text" name="tahun" value="<?= $filter_tahun ?>" hidden>
        <textarea name="catatan" placeholder="Catatan (opsional)"></textarea>
        <button type="submit">Tambah</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga (Rp)</th>
            <th>Catatan</th>
        </tr>
        <?php 
        $no = 1;
        $total = 0;
        if (mysqli_num_rows($query) > 0):
            while ($row = mysqli_fetch_assoc($query)):
                $total += $row['harga'];
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
            <td><?= htmlspecialchars($row['jumlah']); ?></td>
            <td><?= htmlspecialchars($row['satuan']); ?></td>
            <td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>
            <td><?= htmlspecialchars($row['catatan'] ?? '-'); ?></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="4" class="total center">Total Pengeluaran Bulan Ini</td>
            <td colspan="2" class="total">Rp <?= number_format($total,0,',','.'); ?></td>
        </tr>
        <?php else: ?>
        <tr><td colspan="6" class="center">Belum ada data stok untuk bulan ini.</td></tr>
        <?php endif; ?>
    </table>
</main>
</body>
</html>
