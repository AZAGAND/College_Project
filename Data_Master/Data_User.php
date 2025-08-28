<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
// hanya admin yang boleh akses
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Administrator') {
    header("Location: login.php");
    exit;
}

// ambil data user
$result = $conn->query("SELECT u.iduser, u.nama, u.email, r.nama_role
                        FROM user u
                        LEFT JOIN role_user ru ON u.iduser = ru.iduser
                        LEFT JOIN role r ON ru.idrole = r.idrole");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet" href="../CSS/data_user.css">
</head>
<body>
    <h2>Manajemen User</h2>
    <a href="tambah_user.php" class="btn btn-add">+ Tambah User</a>
    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['iduser'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['nama_role'] ?? 'Belum ada role' ?></td>
            <td>
                <!-- ✅ Tombol dibungkus div.aksi -->
                <div class="aksi">
                    <a href="edit_user.php?id=<?= $row['iduser'] ?>" class="btn btn-edit">Edit</a>
                    <a href="Ganti_password.php?id=<?= $row['iduser'] ?>" class="btn btn-reset" onclick="return confirm('Ganti password user ini?')">Ganti Password</a>
                    <a href="Ganti_email.php?id=<?= $row['iduser'] ?>" class="btn btn-reset" onclick="return confirm('Ganti email user ini?')">Ganti Email</a>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="Data_Master.php" class="btn btn-add"> ⬅ Kembali ke Data Master</a>
</body>
</html>
