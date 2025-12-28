<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Drip & Dry Laundry</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .logo {
            max-width: 180px;
            display: block;
            margin: 0 auto 30px auto;
            filter: drop-shadow(0 5px 15px rgba(74, 95, 128, 0.3));
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .welcome-text h1 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .welcome-text p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            color: #2c3e50;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .input-field {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e8ecef;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #4A5F80;
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 95, 128, 0.1);
        }
        
        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 95, 128, 0.3);
        }
        
        .message {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
        
        .message.error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        
        .message.success {
            background: #efe;
            color: #363;
            border: 1px solid #cfc;
        }
        
        .footer-links {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e8ecef;
        }
        
        .footer-links a {
            color: #4A5F80;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #3b4a63;
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
            }
            
            .welcome-text h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
        
        <div class="welcome-text">
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>
        
        <?php if (isset($_GET['pesan'])): ?>
            <div class="message <?php echo $_GET['pesan'] == 'logout_sukses' ? 'success' : 'error'; ?>">
                <?php 
                if ($_GET['pesan'] == 'password_salah') echo 'Password salah. Silakan coba lagi.';
                elseif ($_GET['pesan'] == 'user_tidak_ditemukan') echo 'Username tidak ditemukan.';
                elseif ($_GET['pesan'] == 'data_kosong') echo 'Username dan password harus diisi.';
                elseif ($_GET['pesan'] == 'belum_login') echo 'Silakan login terlebih dahulu.';
                elseif ($_GET['pesan'] == 'logout_sukses') echo 'Logout berhasil.';
                ?>
            </div>
        <?php endif; ?>
        
        <form action="proseslogin.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="input-field" placeholder="Enter your username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-field" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="login-btn">Sign In</button>
        </form>
        
        <div class="footer-links">
            <p>Don't have an account? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>