<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Temu_Dokter.php';

$db = new DBConnection();
$temuObj = new TemuDokter($db);
$data = $temuObj->getAll();


$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Temu Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">👨‍⚕️ Manajemen Temu Dokter</h2>

    <?php if ($msg): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <!-- Form Tambah -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">Tambah Temu Dokter</div>
        <div class="card-body">
            <form method="post" action="../../../Controller/Temu_Dokter_Process.php">
                <input type="hidden" name="action" value="create">

                <div class="mb-3">
                    <label>Nama Pet (idpet)</label>
                    <input type="text" name="idpet" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Dokter (iddokter)</label>
                    <input type="text" name="iddokter" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">Data Temu Dokter</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>No Temu</th>
                        <th>Tanggal</th>
                        <th>Nama Pet</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($data): $no=1; foreach ($data as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['no_temu'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td><?= $row['nama_pet'] ?></td>
                        <td><?= $row['nama_pemilik'] ?></td>
                        <td><?= $row['nama_dokter'] ?></td>
                        <td><?= $row['keluhan'] ?></td>
                        <td>
                            <!-- Form Edit -->
                            <form method="post" action="../../../Controller/Temu_Dokter_Process.php" class="d-inline">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="no_temu" value="<?= $row['no_temu'] ?>">
                                <input type="hidden" name="iddokter" value="<?= $row['iddokter'] ?? '' ?>">
                                <input type="hidden" name="keluhan" value="<?= $row['keluhan'] ?>">
                                <button class="btn btn-warning btn-sm">✏️ Edit</button>
                            </form>

                            <!-- Form Delete -->
                            <form method="post" action="../../../Controller/Temu_Dokter_Process.php" class="d-inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="no_temu" value="<?= $row['no_temu'] ?>">
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="8" class="text-center">Belum ada data</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
