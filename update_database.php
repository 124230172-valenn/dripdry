<?php
// File untuk memperbaiki struktur database - UPDATE TERBARU
include 'koneksi.php';

echo "<h2>Memperbaiki Struktur Database Drip & Dry...</h2>";
echo "<style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
    .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; }
    .success { color: green; font-weight: bold; }
    .error { color: red; font-weight: bold; }
    .info { color: blue; }
</style>";

echo "<div class='container'>";

$queries = [
    "Menambahkan kolom status" => "ALTER TABLE booking ADD COLUMN IF NOT EXISTS status TINYINT(1) DEFAULT 1 AFTER id_user",
    "Menambahkan kolom bukti_pembayaran" => "ALTER TABLE booking ADD COLUMN IF NOT EXISTS bukti_pembayaran VARCHAR(255) NULL AFTER status", 
    "Menambahkan kolom created_at" => "ALTER TABLE booking ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
    "Menambahkan kolom updated_at" => "ALTER TABLE booking ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    "Menambahkan unique constraint username" => "ALTER TABLE user ADD UNIQUE KEY IF NOT EXISTS username (username)",
    "Menambahkan unique constraint email" => "ALTER TABLE user ADD UNIQUE KEY IF NOT EXISTS email (email)"
];

$success_count = 0;
$skip_count = 0;
$error_count = 0;

foreach ($queries as $description => $query) {
    echo "<p><strong>Memproses:</strong> $description...</p>";
    
    // Cek dulu apakah perlu dijalankan (extra safety)
    $need_to_run = true;
    $column_name = "";
    
    if (strpos($query, "ADD COLUMN") !== false) {
        $parts = explode("ADD COLUMN", $query);
        if (count($parts) > 1) {
            $column_name = explode(" ", trim($parts[1]))[0];
            $check_sql = "SHOW COLUMNS FROM booking LIKE '$column_name'";
            $result = $conn->query($check_sql);
            if ($result->num_rows > 0) {
                $need_to_run = false;
                $skip_count++;
                echo "<p class='info'>↳ Kolom <strong>$column_name</strong> sudah ada</p>";
            }
        }
    }
    
    if ($need_to_run) {
        if ($conn->query($query)) {
            echo "<p class='success'>✅ Berhasil: $description</p>";
            $success_count++;
        } else {
            echo "<p class='error'>❌ Gagal: " . $conn->error . "</p>";
            $error_count++;
        }
    }
}

echo "<hr>";
echo "<h3>📊 Hasil Update Database:</h3>";
echo "<p class='success'>✅ Berhasil: $success_count</p>";
echo "<p class='info'>⏩ Skip: $skip_count</p>";
echo "<p class='error'>❌ Error: $error_count</p>";

if ($error_count == 0) {
    echo "<h3 class='success'>🎉 Perbaikan database selesai dan sukses!</h3>";
} else {
    echo "<h3 class='error'>⚠️ Ada beberapa error, silakan cek manual di PHPMyAdmin</h3>";
}

echo "<div style='margin-top: 20px;'>";
echo "<a href='login.php' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>🔐 Login</a>";
echo "<a href='dashboard.php' style='background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>📊 Dashboard</a>";
echo "<a href='index.php' style='background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>🏠 Home</a>";
echo "</div>";

echo "</div>";

$conn->close();
?>