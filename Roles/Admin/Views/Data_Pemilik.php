<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Owner.php';

$db = new DBConnection();
$pemilikObj = new Pemilik($db);
$allPemilik = $pemilikObj->getAllPemilik();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemilik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Data Pemilik</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pemilik</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. WA</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allPemilik as $p): ?>
                        <tr>
                            <td><?= $p['idpemilik'] ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['email'] ?></td>
                            <td><?= $p['no_wa'] ?></td>
                            <td><?= $p['alamat'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Tombol kembali di bawah tabel -->
            <div class="mt-3">
                <a href="../../../Data_master/Data_Master.php" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
