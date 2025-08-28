<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';

// mengambil semua user + role nya
$query = "
    SELECT u.iduser, u.nama, u.email, r.idrole, r.nama_role, ru.status, ru.idrole_user
    FROM user u
    JOIN role_user ru ON u.iduser = ru.iduser
    JOIN role r ON ru.idrole = r.idrole
    ORDER BY u.iduser
";
$result = $conn->query($query);

// bikin array users
$users = [];
while ($row = $result->fetch_assoc()) {
    $id = $row['iduser'];

    if (!isset($users[$id])) {
        $users[$id] = [
            "iduser" => $row['iduser'],
            "nama" => $row['nama'],
            "email" => $row['email'],
            "roles" => []
        ];
    }

    $users[$id]['roles'][] = [
        "idrole_user" => $row['idrole_user'],
        "idrole" => $row['idrole'],
        "nama_role" => $row['nama_role'],
        "status" => $row['status']
    ];
}

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