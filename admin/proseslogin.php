<?php
session_start();
include '../koneksi.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Cek input kosong
if (empty($username) || empty($password)) {
    header("Location: login.php?pesan=data_kosong");
    exit;
}

// Ambil data user
$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' LIMIT 1");
$data = mysqli_fetch_assoc($query);

// Validasi user
if ($data) {
    // Jika tabel user belum punya kolom 'role', kamu bisa skip bagian ini
    if (isset($data['role']) && $data['role'] !== 'admin') {
        header("Location: login.php?pesan=bukan_admin");
        exit;
    }

    // Verifikasi password (gunakan password_hash saat registrasi)
    if (password_verify($password, $data['password']) || $password === $data['password']) {
        $_SESSION['admin'] = $data['username'];
        $_SESSION['role'] = 'admin';
        header("Location: dashboard_admin.php");
        exit;
    } else {
        header("Location: login.php?pesan=password_salah");
        exit;
    }
} else {
    header("Location: login.php?pesan=user_tidak_ditemukan");
    exit;
}
?>
