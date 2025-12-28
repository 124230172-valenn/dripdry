<?php
session_start();
include 'koneksi.php';

// Validasi input kosong
if (empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: login.php?pesan=data_kosong");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Verifikasi password
    if ($password === $row['password']) {
        // Simpan data user ke session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['status'] = "login";
        $_SESSION['login_time'] = time();

        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?pesan=password_salah");
        exit;
    }
} else {
    header("Location: login.php?pesan=user_tidak_ditemukan");
    exit;
}

$stmt->close();
$conn->close();
?>