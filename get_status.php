<?php
session_start();
include 'koneksi.php';

$user_id = $_GET['user_id'] ?? $_SESSION['user_id'] ?? 0;

if ($user_id == 0) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 0, 'error' => 'User tidak valid']);
    exit;
}

// Query untuk mendapatkan status terbaru
$sql = "SELECT status FROM booking WHERE id_user = ? ORDER BY booking_id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$status = 0; // Default status (belum ada booking)
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = $row['status'] ?? 1; // Default ke 1 jika null
}

header('Content-Type: application/json');
echo json_encode(['status' => $status]);

$stmt->close();
$conn->close();
?>