<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php?pesan=belum_login");
    exit;
}

include 'koneksi.php';

// Handle form submission untuk booking baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_FILES['bukti_pembayaran'])) {
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $dropoff = isset($_POST['dropoff']) ? 1 : 0;
    $payment = $_POST['payment'] ?? '';
    $id_user = $_SESSION['user_id'];

    if (empty($date) || empty($time) || empty($payment)) {
        $error = "All fields are required.";
    } else {
        // Cek apakah kolom status ada
        $check_status_sql = "SHOW COLUMNS FROM booking LIKE 'status'";
        $status_column_exists = $conn->query($check_status_sql)->num_rows > 0;
        
        if ($status_column_exists) {
            $sql = "INSERT INTO booking (date, time, dropoff, payment, id_user, status) VALUES (?, ?, ?, ?, ?, 1)";
        } else {
            $sql = "INSERT INTO booking (date, time, dropoff, payment, id_user) VALUES (?, ?, ?, ?, ?)";
        }
        
        $stmt = $conn->prepare($sql);
        
        if ($status_column_exists) {
            $stmt->bind_param("ssisi", $date, $time, $dropoff, $payment, $id_user);
        } else {
            $stmt->bind_param("ssis", $date, $time, $dropoff, $payment, $id_user);
        }

        if (!$stmt->execute()) {
            $error = "Failed to save booking: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Handle file upload untuk bukti pembayaran
$uploadSuccess = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bukti_pembayaran'])) {
    $check_bukti_sql = "SHOW COLUMNS FROM booking LIKE 'bukti_pembayaran'";
    $bukti_column_exists = $conn->query($check_bukti_sql)->num_rows > 0;
    
    if ($bukti_column_exists) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['bukti_pembayaran']['name']);
        $targetFile = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES['bukti_pembayaran']['tmp_name']);
        if ($check !== false && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $targetFile)) {
                $updateSql = "UPDATE booking SET bukti_pembayaran = ? WHERE id_user = ? ORDER BY booking_id DESC LIMIT 1";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("si", $fileName, $_SESSION['user_id']);
                $updateStmt->execute();
                $updateStmt->close();
                $uploadSuccess = true;
            }
        }
    } else {
        $uploadError = "Payment proof upload feature is not available yet.";
    }
}

// Ambil data booking terbaru
$sql = "SELECT * FROM booking WHERE id_user = ? ORDER BY booking_id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Booking Confirmation - Drip & Dry Laundry</title>
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
            height: 45px;
        }
        
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .nav-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        .confirmation-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
        }
        
        .confirmation-card {
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
            text-align: center;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 36px;
        }
        
        .confirmation-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .confirmation-subtitle {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .booking-details {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            text-align: left;
            margin: 25px 0;
            border: 1px solid #e9ecef;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #7f8c8d;
            font-weight: 600;
        }
        
        .detail-value {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .total-amount {
            background: #4A5F80;
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            font-weight: 700;
        }
        
        .upload-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            border: 2px dashed #dee2e6;
        }
        
        .upload-title {
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .upload-btn {
            background: #4A5F80;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        
        .upload-btn:hover {
            background: #3b4a63;
            transform: translateY(-2px);
        }
        
        .bukti-image {
            max-width: 100%;
            border-radius: 8px;
            margin: 15px 0;
            border: 2px solid #e9ecef;
        }
        
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
        }
        
        .action-btn {
            padding: 14px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: #4A5F80;
            color: white;
        }
        
        .btn-primary:hover {
            background: #3b4a63;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
            font-weight: 600;
        }
        
        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        
        .alert-success {
            background: #efe;
            color: #363;
            border: 1px solid #cfc;
        }
        
        @media (max-width: 768px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .confirmation-container {
                padding: 15px;
                margin: 20px auto;
            }
            
            .confirmation-card {
                padding: 25px;
            }
            
            .confirmation-title {
                font-size: 24px;
            }
            
            .booking-details {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="nav-controls">
                <a href="dashboard.php" class="nav-btn">
                    <span class="material-symbols-outlined">home</span>
                </a>
            </div>
        </div>
    </div>

    <div class="confirmation-container">
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="form.php" class="upload-btn">Back to Form</a>
            </div>
        <?php elseif ($booking): ?>
            <div class="confirmation-card">
                <div class="success-icon">
                    <span class="material-symbols-outlined">check</span>
                </div>
                
                <h1 class="confirmation-title">Booking Confirmed!</h1>
                <p class="confirmation-subtitle">Thank you for choosing Drip & Dry Laundry. Your booking has been successfully processed.</p>
                
                <div class="booking-details">
                    <div class="detail-item">
                        <span class="detail-label">Booking ID</span>
                        <span class="detail-value">#<?php echo $booking['booking_id']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Pickup Date</span>
                        <span class="detail-value"><?php echo $booking['date']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Time Slot</span>
                        <span class="detail-value"><?php echo $booking['time']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Drop-off Service</span>
                        <span class="detail-value"><?php echo $booking['dropoff'] ? 'Yes (+Rp 5,000)' : 'No'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Payment Method</span>
                        <span class="detail-value"><?php echo strtoupper($booking['payment']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value" style="color: #4A5F80; font-weight: 700;">Confirmed</span>
                    </div>
                </div>
                
                <?php
                $total = $booking['dropoff'] ? 25000 : 20000;
                $totalFormatted = "Rp " . number_format($total, 0, ',', '.');
                ?>
                <div class="total-amount">Total: <?php echo $totalFormatted; ?></div>
                
                <?php if (isset($uploadSuccess) && $uploadSuccess): ?>
                    <div class="alert alert-success">
                        ✅ Payment proof successfully uploaded!
                    </div>
                    <img src="uploads/<?php echo htmlspecialchars($booking['bukti_pembayaran']); ?>" class="bukti-image" alt="Payment Proof">
                <?php elseif (isset($uploadError)): ?>
                    <div class="alert alert-error">
                        ℹ️ <?php echo $uploadError; ?>
                    </div>
                <?php elseif ($booking['payment'] === 'qris' && empty($booking['bukti_pembayaran'])): ?>
                    <div class="upload-section">
                        <h3 class="upload-title">📎 Upload Payment Proof (QRIS)</h3>
                        <?php
                        $conn_temp = new mysqli("localhost", "root", "", "dripdry");
                        $check_sql = "SHOW COLUMNS FROM booking LIKE 'bukti_pembayaran'";
                        $check_result = $conn_temp->query($check_sql);
                        $conn_temp->close();
                        
                        if ($check_result->num_rows > 0): ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="file" name="bukti_pembayaran" accept="image/*" required 
                                       style="margin: 15px 0; padding: 10px; border-radius: 6px; background: white; color: #333; width: 100%; border: 1px solid #ddd;">
                                <button type="submit" class="upload-btn">📤 Upload Proof</button>
                            </form>
                        <?php else: ?>
                            <p style="color: #7f8c8d; text-align: center;">Payment proof upload feature coming soon.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="action-buttons">
                    <a href="dashboard.php" class="action-btn btn-primary">🏠 Dashboard</a>
                    <a href="cekupdate.php" class="action-btn btn-secondary">🔄 Track Order</a>
                </div>
            </div>
            
        <?php else: ?>
            <div class="confirmation-card">
                <div style="text-align: center; color: #dc3545; font-size: 48px; margin-bottom: 20px;">❌</div>
                <h1 class="confirmation-title">No Booking Found</h1>
                <p class="confirmation-subtitle">We couldn't find any booking information. Please try booking again.</p>
                <div style="text-align: center; margin-top: 30px;">
                    <a href="tanggal.php" class="upload-btn">Make a Booking</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>