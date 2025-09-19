<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Kategori.php';

$db = new DBConnection();
$kategoriObj = new Kategori($db);
$allKategori = $kategoriObj->getAll();

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Data Kategori</h3>
        </div>
        <div class="card-body">
            <?php if ($msg): ?>
                <div class="alert alert-info"><?= $msg ?></div>
            <?php endif; ?>

            <!-- Form Tambah Kategori -->
            <form method="post" action="../../../Controller/Kategori_Process.php" class="mb-4">
                <input type="hidden" name="action" value="create">
                <div class="input-group">
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori baru" required>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>

            <!-- Tabel Kategori -->
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allKategori as $kat): ?>
                        <tr>
                            <td><?= $kat['idkategori'] ?></td>
                            <td><?= $kat['nama_kategori'] ?></td>
                            <td>
                                <!-- Update (inline form) -->
                                <form method="post" action="../../../Controller/Kategori_Process.php" class="d-inline">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="idkategori" value="<?= $kat['idkategori'] ?>">
                                    <input type="text" name="nama_kategori" value="<?= $kat['nama_kategori'] ?>" required>
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>

                                <!-- Delete -->
                                <form method="post" action="../../../Controller/Kategori_Process.php" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="idkategori" value="<?= $kat['idkategori'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="../../../Data_master/Data_Master.php" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>
</div>
</body>
</html>
