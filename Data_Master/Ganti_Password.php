<?php
session_start();
require_once __DIR__ . "/../DB/dbconnection.php";

$error = '';
$success = '';

// Verifikasi apakah user sudah login dan memiliki role yang benar
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'Administrator') {
    // Alihkan ke halaman login jika tidak memiliki hak akses yang benar
    header('Location: ../login_RSHP.php');
    exit();
}

$iduser_target = $_GET['id'] ?? null;

if (!$iduser_target) {
    die("ID pengguna tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password_baru = $_POST['password_baru'] ?? '';
    $retype_password = $_POST['retype_password'] ?? '';

    if ($password_baru === $retype_password) {
        $hashed = password_hash($password_baru, PASSWORD_BCRYPT);

        // Perbarui kueri untuk menggunakan iduser_target
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE iduser = ?");
        $stmt->bind_param("si", $hashed, $iduser_target);

        if ($stmt->execute()) {
            $success = "Password berhasil diubah untuk pengguna dengan ID: " . $iduser_target;
        } else {
            $error = "Gagal mengubah password: " . $conn->error;
        }
        $stmt->close();
    } else {
        $error = "Password baru dan ulangi password tidak sama!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="../CSS/ganti_password.css">
</head>

<body>
    <div class="container">
        <h2 class="hidden">Ganti Password Pengguna ID: <?= htmlspecialchars($iduser_target) ?></h2>
        <?php if ($success): ?>
            <p class="msg"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="err"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="Ganti_Password.php?id=<?= htmlspecialchars($iduser_target) ?>">
            <label>Password Baru</label>
            <input type="password" name="password_baru" required>
            <label>Ulangi Password Baru</label>
            <input type="password" name="retype_password" required>
            <button type="submit">Ubah Password</button>
            <p style="text-align:center; margin-top:15px;">
                <a href="../Data_Master/Data_User.php"
                    style="display:inline-block; padding:10px 15px; background:#2ecc71; color:white; border-radius:5px; text-decoration:none;">
                    ← Kembali ke Data User
                </a>
            </p>
        </form>
    </div>
</body>

</html>

<style>
    /* Tambahkan kode CSS ini di file ganti_password.css atau di <style> tag */
    .hidden {
        display: none;
    }
</style>