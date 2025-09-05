<?php
include __DIR__ . '/../DB/dbconnection.php';
session_start();
// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$id = $_GET['id'] ?? 0;

// password default
$newPass = password_hash("123456", PASSWORD_BCRYPT);

$stmt = $conn->prepare("UPDATE user SET password=? WHERE iduser=?");
$stmt->bind_param("si", $newPass, $id);

// Simpan status eksekusi dalam variabel
$success = false;
if ($stmt->execute()) {
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Reset Password</title>
    <link rel="stylesheet" href="../CSS/Reset_password.css">
</head>
<body>

    <div class="container <?php echo $success ? 'success' : 'error'; ?>">
        <?php if ($success): ?>
            <h2>✅ Berhasil!</h2>
            <p>Password user ID **<?php echo htmlspecialchars($id); ?>** berhasil direset ke **`123456`**</p>
        <?php else: ?>
            <h2>❌ Gagal!</h2>
            <p>Gagal mereset password. Silakan coba lagi.</p>
        <?php endif; ?>
        <a href="data_user.php" class="back-link">← Kembali</a>
    </div>

</body>
</html>