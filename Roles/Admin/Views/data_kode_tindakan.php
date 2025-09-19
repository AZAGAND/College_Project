<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Kode_Tindakan_Terapi.php';

$db = new DBConnection();
$tindakanObj = new Kode_Tindakan_Terapi($db);
$allTindakan = $tindakanObj->getAll();

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kode Tindakan Terapi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Data Kode Tindakan Terapi</h3>
        </div>
        <div class="card-body">
            <?php if ($msg): ?>
                <div class="alert alert-info"><?= $msg ?></div>
            <?php endif; ?>

            <!-- Form Tambah -->
            <form method="post" action="../../../Controller/Kode_Tindakan_Process.php" class="mb-4">
                <input type="hidden" name="action" value="create">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="kode" class="form-control" placeholder="Kode" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="deskripsi_tindakan_terapi" class="form-control" placeholder="Deskripsi" required>
                    </div>
                    <div class="col-md-3">
                        <select name="idkategori_klinis" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="1">Terapi</option>
                            <option value="2">Tindakan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Tambah</button>
                    </div>
                </div>
            </form>

            <!-- Tabel Data -->
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Kategori Klinis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allTindakan as $row): ?>
                        <tr>
                            <td><?= $row['idkode_tindakan_terapi'] ?></td>
                            <td><?= $row['kode'] ?></td>
                            <td><?= $row['deskripsi_tindakan_terapi'] ?></td>
                            <td><?= $row['nama_kategori_klinis'] ?></td>
                            <td>
                                <!-- Update -->
                                <form method="post" action="../../../Controller/Kode_Tindakan_Process.php" class="d-inline">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="idkode_tindakan_terapi" value="<?= $row['idkode_tindakan_terapi'] ?>">
                                    <input type="text" name="kode" value="<?= $row['kode'] ?>" required>
                                    <input type="text" name="deskripsi_tindakan_terapi" value="<?= $row['deskripsi_tindakan_terapi'] ?>" required>
                                    <select name="idkategori_klinis" required>
                                        <option value="1" <?= $row['nama_kategori_klinis'] == 'Terapi' ? 'selected' : '' ?>>Terapi</option>
                                        <option value="2" <?= $row['nama_kategori_klinis'] == 'Tindakan' ? 'selected' : '' ?>>Tindakan</option>
                                    </select>
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>

                                <!-- Delete -->
                                <form method="post" action="../../../Controller/Kode_Tindakan_Process.php" class="d-inline" onsubmit="return confirm('Yakin hapus tindakan ini?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="idkode_tindakan_terapi" value="<?= $row['idkode_tindakan_terapi'] ?>">
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
