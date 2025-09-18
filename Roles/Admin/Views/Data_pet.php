<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Pet.php';

// koneksi
$db = new DBConnection();
$petObj = new Pet($db);

// ambil semua data pet
$allPets = $petObj->getAllPets();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Data Pet</h3>
        </div>
        <div class="card-body">
            <?php if (empty($allPets)): ?>
                <div class="alert alert-warning">Belum ada data pet.</div>
            <?php else: ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Pet</th>
                            <th>Nama Pet</th>
                            <th>Jenis</th>
                            <th>Ras</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna/Tanda</th>
                            <th>Jenis Kelamin</th>
                            <th>Pemilik</th>
                            <th>Email Pemilik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allPets as $pet): ?>
                            <tr>
                                <td><?= $pet['idpet'] ?></td>
                                <td><?= $pet['nama_pet'] ?></td>
                                <td><?= $pet['nama_jenis_hewan'] ?></td>
                                <td><?= $pet['nama_ras'] ?></td>
                                <td><?= $pet['tanggal_lahir'] ?: '-' ?></td>
                                <td><?= $pet['warna_tanda'] ?: '-' ?></td>
                                <td><?= $pet['jenis_kelamin'] == 'J' ? 'Jantan' : ($pet['jenis_kelamin'] == 'B' ? 'Betina' : '-') ?></td>
                                <td><?= $pet['nama_pemilik'] ?></td>
                                <td><?= $pet['email'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <div class="mt-3">
                <a href="../../../Data_master/Data_Master.php" class="btn btn-secondary">⬅ Kembali</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
