<?php
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

$iduser_target = $_GET['id'] ?? null;
if (!$iduser_target)
    die("ID user tidak ditemukan!");

// Ambil notif jika ada
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="../../../CSS/ganti_password.css">
</head>

<body>
    <div class="container">
        <h2 class="hidden">Ganti Password User ID: <?= htmlspecialchars($iduser_target) ?></h2>
        <?php if ($success): ?>
            <p class="msg"><?= htmlspecialchars($success) ?></p><?php endif; ?>
        <?php if ($error): ?>
            <p class="err"><?= htmlspecialchars($error) ?></p><?php endif; ?>

        <form method="post" action="/PHP_Native_Web_OOP-Modul4/Controller/Ganti_Password_Process.php">
            <input type="hidden" name="iduser" value="<?= htmlspecialchars($iduser_target) ?>">
            <input type="hidden" name="redirect_to"
                value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '../../Data_User.php') ?>">

            <label>Password Baru</label>
            <input type="password" name="password_baru" required>
            <label>Ulangi Password Baru</label>
            <input type="password" name="retype_password" required>
            <button type="submit">Ubah Password</button>
        </form>
    </div>
</body>

</html>