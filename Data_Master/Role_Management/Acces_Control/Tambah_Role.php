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

// Ambil notif dari session
$msg = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Role ke User</title>
    <link rel="stylesheet" href="../../../CSS/tambah_role.css">
</head>

<body>
    <div class="container">
        <h2>Tambah Role ke User</h2>
        <?php if (!empty($msg))
            echo "<p>$msg</p>"; ?>

        <form method="post" action="../../../Controller/Tambah_Role_proces.php">
            <label for="iduser">Pilih User</label>
            <select name="iduser" id="iduser" required>
                <option value="">-- Pilih User --</option>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u['iduser'] ?>"><?= $u['nama'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="idrole">Pilih Role</label>
            <select name="idrole" id="idrole" required>
                <option value="">-- Pilih Role --</option>
                <?php foreach ($roles as $r): ?>
                    <option value="<?= $r['idrole'] ?>"><?= $r['nama_role'] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Tambah Role">
        </form>

        <p><a href="../../../Data_Master/Role_Management/role_management.php">⬅ Kembali ke Manajemen Role</a></p>
    </div>
</body>

</html>