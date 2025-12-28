<?php
session_start();
include 'db.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Ambil user berdasarkan email dan role owner
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND role = 'owner' LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows > 0){
        $user = $result->fetch_assoc();
        if($password === $user['password']){ // karena password plaintext
            // Login berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard_owner.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan atau bukan akun owner!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login Owner - Drip & Dry Laundry</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<style>
body {
    font-family:'Nunito', sans-serif;
    background:#f8f9fa;
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}
.card {
    background:white;
    padding:40px 30px;
    border-radius:16px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    width:100%;
    max-width:400px;
}
h1 {
    text-align:center;
    color:#4A5F80;
    margin-bottom:25px;
}
input {
    width:100%;
    padding:12px 15px;
    margin:10px 0;
    border:2px solid #e8ecef;
    border-radius:10px;
    font-size:15px;
}
input:focus {
    outline:none;
    border-color:#4A5F80;
    background:white;
}
button {
    width:100%;
    padding:12px;
    background:linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
    border:none;
    color:white;
    font-weight:600;
    font-size:16px;
    border-radius:10px;
    cursor:pointer;
    margin-top:15px;
    transition:all 0.3s ease;
}
button:hover {
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(74,95,128,0.3);
}
.error {
    background:#fee;
    color:#c33;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    text-align:center;
}
</style>
</head>
<body>
<div class="card">
    <h1>Login Owner</h1>
    <?php if($error): ?>
        <div class="error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
