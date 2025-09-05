<?php
session_start();
require_once __DIR__ . '/../../Class/User.php';
require_once __DIR__ . '/../../DB/dbconnection.php';

$db = new DBConnection();
$userObj = new User($db);
$allUsers = $userObj->getAllUsers();

// Ambil notif dari session
$message = $_SESSION['success'] ?? $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
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
    <a href="User_manage/tambah_user.php" class="btn btn-add">+ Tambah User</a>
    <?php if ($message): ?>
        <div id="toast" class="<?= strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
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
                        <a href="User_manage/Ganti_Email.php?id=<?= $u['iduser'] ?>" class="btn btn-reset"
                            onclick="return confirm('Ganti email user ini?')">Ganti Email</a>
                    </div>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
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