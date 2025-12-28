<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php?pesan=belum_login");
    exit;
}

$id_user = $_SESSION['user_id'];

// Cek apakah user sudah memiliki booking
$sql = "SELECT booking_id, dropoff FROM booking WHERE id_user = ? ORDER BY booking_id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: update1.php");
} else {
    $row = $result->fetch_assoc();
    
    // Cek apakah kolom status ada di database
    $check_status_sql = "SHOW COLUMNS FROM booking LIKE 'status'";
    $check_result = $conn->query($check_status_sql);
    
    if ($check_result->num_rows > 0) {
        $status_sql = "SELECT status FROM booking WHERE id_user = ? ORDER BY booking_id DESC LIMIT 1";
        $status_stmt = $conn->prepare($status_sql);
        $status_stmt->bind_param("i", $id_user);
        $status_stmt->execute();
        $status_result = $status_stmt->get_result();
        $status_row = $status_result->fetch_assoc();
        $status = $status_row['status'] ?? 1;
        $status_stmt->close();
    } else {
        $status = 1;
    }
    
    if ($status >= 1) {
        header("Location: update3.php");
    } else {
        header("Location: update2.php");
    }
}

$stmt->close();
$conn->close();
exit;
?>