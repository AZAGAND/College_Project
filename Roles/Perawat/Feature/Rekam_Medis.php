<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Rekam_Medis.php';
require_once __DIR__ . '/../../../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);
$detailObj = new RekamMedisDetail($db);

$allRekam = $rekamObj->getAll();
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekam Medis (Perawat)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">📋 Manajemen Rekam Medis</h2>
    <?php if ($msg): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <!-- Tambah Rekam Medis -->
    <form method="post" action="../../Controller/Rekam_Medis_Process.php" class="mb-4">
        <input type="hidden" name="action" value="create">
        <div class="row">
            <div class="col-md-3">
                <input type="number" name="idreservasi" class="form-control" placeholder="ID Reservasi" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="diagnosa" class="form-control" placeholder="Diagnosa" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="catatan" class="form-control" placeholder="Catatan">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-success w-100">Tambah</button>
            </div>
        </div>
    </form>

    <!-- Tabel Rekam Medis -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Reservasi</th>
            <th>Pemilik</th>
            <th>Pet</th>
            <th>Diagnosa</th>
            <th>Catatan</th>
            <th>Tanggal</th>
            <th>Detail</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allRekam as $row): ?>
            <tr>
                <td><?= $row['idrekam_medis'] ?></td>
                <td><?= $row['idreservasi'] ?></td>
                <td><?= $row['nama_pemilik'] ?></td>
                <td><?= $row['nama_pet'] ?></td>
                <td><?= $row['diagnosa'] ?></td>
                <td><?= $row['catatan'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td>
                    <?php $details = $detailObj->getByRekamMedis($row['idrekam_medis']); ?>
                    <ul>
                        <?php foreach ($details as $d): ?>
                            <li><?= $d['kode'] ?> - <?= $d['deskripsi_tindakan_terapi'] ?> (<?= $d['hasil'] ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Form tambah detail -->
                    <form method="post" action="../../Controller/RekamMedis_Process.php">
                        <input type="hidden" name="action" value="add_detail">
                        <input type="hidden" name="idrekam_medis" value="<?= $row['idrekam_medis'] ?>">
                        <input type="number" name="idtindakan" placeholder="ID Tindakan" required>
                        <input type="text" name="hasil" placeholder="Hasil" required>
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                    </form>
                </td>
                <td>
                    <!-- Hapus Rekam -->
                    <form method="post" action="../../Controller/RekamMedis_Process.php" onsubmit="return confirm('Yakin hapus?')" class="d-inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="idrekam_medis" value="<?= $row['idrekam_medis'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../Perawat_Dashboard.php" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</body>
</html>
