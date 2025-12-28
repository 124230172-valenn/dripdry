<?php
session_start();
include "koneksi.php";

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validasi input kosong
if (empty($email) || empty($username) || empty($password)) {
    echo "<script>alert('Semua field harus diisi.'); window.location.href='register.php';</script>";
    exit;
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Format email tidak valid.'); window.location.href='register.php';</script>";
    exit;
}

// Cek duplikasi email menggunakan prepared statement
$check_email = $conn->prepare("SELECT id FROM user WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain.'); window.location.href='register.php';</script>";
    exit;
}
$check_email->close();

// Cek duplikasi username menggunakan prepared statement
$check_username = $conn->prepare("SELECT id FROM user WHERE username = ?");
$check_username->bind_param("s", $username);
$check_username->execute();
$check_username->store_result();

if ($check_username->num_rows > 0) {
    echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.'); window.location.href='register.php';</script>";
    exit;
}
$check_username->close();

// Insert data baru menggunakan prepared statement
$stmt = $conn->prepare("INSERT INTO user (email, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $username, $password);

if ($stmt->execute()) {
    // Dapatkan ID user yang baru dibuat
    $new_user_id = $stmt->insert_id;
    
    // Set session
    $_SESSION['user_id'] = $new_user_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['status'] = "login";
    
    echo "<script>alert('Registrasi berhasil!'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Registrasi gagal: " . $stmt->error . "'); window.location.href='register.php';</script>";
}

$stmt->close();
$conn->close();
?>