<?php
session_start();
require_once __DIR__ . '/../../Class/User.php';
require_once __DIR__ . '/../../DB/dbconnection.php';

// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$db = new DBConnection();
$userObj = new User($db);
$allUsers = $userObj->getAllUsers();

// Ambil notifikasi dari session
$message = $_SESSION['success'] ?? $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet" href="/PHP_Native_Web_OOP-Modul4/CSS/data_user.css">
</head>

<body>
    <h2>Manajemen User</h2>

    <!-- Tombol Tambah User -->
    <a href="tambah_user.php" class="btn btn-add">+ Tambah User</a>
    <!-- Toast Notifikasi -->
    <?php if ($message): ?>
        <div id="toast" class="<?= strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <!-- Table User -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($allUsers as $u): ?>
            <tr>
                <td><?= $u['iduser'] ?></td>
                <td><?= $u['nama'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['nama_role'] ?? 'Belum ada role' ?></td>
                <td>
                    <div class="aksi">
                        <a href="User_manage/edit_user.php?id=<?= $u['iduser'] ?>" class="btn btn-edit">Edit</a>
                        <a href="User_manage/Ganti_Password.php?id=<?= $u['iduser'] ?>" class="btn btn-reset"
                            onclick="return confirm('Ganti password user ini?')">Ganti Password</a>
                        <a href="/PHP_Native_Web_OOP-Modul4/Views/Data_Master/Data_User/User_manage/Ganti_Email.php?id=<?= $u['iduser'] ?>"
                            class="btn btn-reset" onclick="return confirm('Ganti email user ini?')">Ganti Email</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Tombol Kembali -->
    <div class="table-footer">
        <a href="../Data_Master.php" class="btn btn-add">⬅ Kembali ke Data Master</a>
    </div>


    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 4000);
            }
        });
    </script>
</body>

</html>