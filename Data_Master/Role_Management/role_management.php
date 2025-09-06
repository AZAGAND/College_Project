<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/Role.php';

// cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../Login/login_RSHP.php");
    exit;
}

// koneksi
$db = new DBConnection();
$roleObj = new role($db); // ✅ sesuai class kamu (huruf kecil)

// ambil semua user dengan roles
$users = $roleObj->getAllUsersWithRoles();

// toggle status
if (isset($_GET['toggle'])) {
    $idrole_user = (int) $_GET['toggle'];
    $roleObj->toggleRoleStatus($idrole_user);
    header("Location: role_management.php");
    exit();
}

// hapus role
if (isset($_GET['delete'])) {
    $idrole_user = (int) $_GET['delete'];
    $roleObj->deleteRoleFromUser($idrole_user);
    header("Location: role_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Role</title>
    <link rel="stylesheet" href="../../CSS/role_management.css">
</head>

<body>
    <h2>Manajemen Role</h2>
    <a href="tambah_role.php" class="btn add">+ Tambah Role Baru</a>

    <table>
        <tr>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($users as $u): ?>
            <?php foreach ($u['roles'] as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($u['nama']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($r['nama_role']) ?></td>
                    <td><?= $r['status'] ? "Aktif" : "Tidak Aktif" ?></td>
                    <td class="aksi">
                        <a href="?toggle=<?= $r['idrole_user'] ?>" class="btn <?= $r['status'] ? 'inactive' : 'active' ?>">
                            <?= $r['status'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                        </a>
                        <a href="?delete=<?= $r['idrole_user'] ?>" class="btn delete"
                            onclick="return confirm('Hapus role ini dari user?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>

    <a href="../Data_Master.php" class="btn add">⬅ Kembali ke Data Master</a>
</body>

</html>