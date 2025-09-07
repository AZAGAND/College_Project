<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Controller/Jenis_hewan_process.php';

$db = new DBConnection();
$conn = $db->getConnection();

$controller = new Jenis_Hewan($conn);

// Tambah
if (isset($_POST['tambah'])) {
    $controller->store($_POST['nama_jenis']);
    header("Location: Jenis_Hewan.php");
    exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $controller->destroy($_GET['hapus']);
    header("Location: Jenis_Hewan.php");
    exit;
}

$data = $controller->index();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Master Jenis Hewan</title>
    <link rel="stylesheet" href="../../../CSS/Jenis_Hewan.css">
</head>

<body>
    <h2>📋 Menu Jenis Hewan</h2>

    <form method="post">
        <input type="text" name="nama_jenis" placeholder="Nama Jenis Hewan" required>
        <button type="submit" name="tambah" class="btn btn-green">+ Tambah Jenis</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jenis Hewan</th>
                <th class="aksi">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['idjenis_hewan']; ?></td>
                    <td><?= $row['nama_jenis_hewan']; ?></td>
                    <td class="aksi">
                        <a href="edit_jenis.php?id=<?= $row['idjenis_hewan']; ?>" class="btn btn-blue">Edit</a>
                        <a href="?hapus=<?= $row['idjenis_hewan']; ?>" onclick="return confirm('Yakin hapus?')"
                            class="btn btn-red">Hapus</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tombol Kembali -->
    <div class="table-footer">
        <a href="../../../Data_master/Data_Master.php" class="btn btn-add">⬅ Kembali ke Data Master</a>
    </div>
</body>

</html>