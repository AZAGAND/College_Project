<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../DB/Class.php';

// cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../Login/login_RSHP.php");
    exit;
}

$db = new DBConnection();
$roleObj = new Role($db);

// ambil semua role
$allRoles = $roleObj->getAllRoles();

// contoh: ambil role untuk user login
$userRoles = $roleObj->getRolesByUser($_SESSION['user']['id']);


// toggle status
if (isset($_GET['toggle'])) {
    $idrole_user = (int) $_GET['toggle'];
    $conn->query("UPDATE role_user SET status = IF(status=1,0,1) WHERE idrole_user=$idrole_user");
    header("Location: role_management.php");
    exit();
}

// hapus role
if (isset($_GET['delete'])) {
    $idrole_user = (int) $_GET['delete'];
    $conn->query("DELETE FROM role_user WHERE idrole_user=$idrole_user");
    header("Location: role_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Role</title>

</head>

<body>
    <h2>Manajemen Role</h2>
    <a href="tambah_role.php" class="btn add">+ Tambah Role Baru</a>
    <link rel="stylesheet" href="../CSS/role_management.css">
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
                    <td>
                        <div class="aksi">
                            <a href="?toggle=<?= $r['idrole_user'] ?>" class="btn <?= $r['status'] ? 'inactive' : 'active' ?>">
                                <?= $r['status'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                            </a>
                            <a href="?delete=<?= $r['idrole_user'] ?>" class="btn delete"
                                onclick="return confirm('Hapus role ini dari user?')">Hapus</a>    
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
    <a href="Data_Master.php" class="btn add">⬅ kembali ke Data master</a>
</body>

</html>