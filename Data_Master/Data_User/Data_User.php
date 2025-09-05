<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/User.php';
require_once __DIR__ . '/../../Class/Role.php';

// cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../Login/login_RSHP.php");
    exit;
}

// buat object
$db = new DBConnection();
$userObj = new User($db);

// ambil semua user
$allUsers = $userObj->getAllUsers();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet" href="../../CSS/data_user.css">
</head>
<body>
    <h2>Manajemen User</h2>
    <a href="tambah_user.php" class="btn btn-add">+ Tambah User</a>
    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
        </tr>
        <?php foreach ($allUsers as $u): ?>
        <tr>
            <td><?= $u['iduser'] ?></td>
            <td><?= $u['nama'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['nama_role'] ?? 'Belum ada role' ?></td>
            <td>
                <!-- ✅ Tombol dibungkus div.aksi -->
                <div class="aksi">
                    <a href="edit_user.php?id=<?= $row['iduser'] ?>" class="btn btn-edit">Edit</a>
                    <a href="Ganti_password.php?id=<?= $row['iduser'] ?>" class="btn btn-reset" onclick="return confirm('Ganti password user ini?')">Ganti Password</a>
                    <a href="Ganti_email.php?id=<?= $row['iduser'] ?>" class="btn btn-reset" onclick="return confirm('Ganti email user ini?')">Ganti Email</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../Data_Master.php" class="btn btn-add"> ⬅ Kembali ke Data Master</a>
</body>
</html>
