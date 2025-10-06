<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Temu_Dokter.php';

$db = new DBConnection();
$temuObj = new TemuDokter($db);
$data = $temuObj->getAll();

$Listdokter = $temuObj->getAllDokter();
$pemilikList = $temuObj->getAllPemilik();
$allPetList = $temuObj->getPetByPemilik($idpemilik ?? null);

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

        <form method="POST" action="../../../Controller/Temu_Dokter_Process.php" class="card p-3 mb-4 shadow-sm">
            <input type="hidden" name="action" value="create">

            <div class="mb-3">
                <label class="form-label">Nama Pemilik</label>
                <select name="idpemilik" id="idpemilik" class="form-select" required>
                    <option value="">-- Pilih Pemilik --</option>
                    <?php foreach ($pemilikList as $p): ?>
                        <option value="<?= $p['idpemilik'] ?>">
                            <?= htmlspecialchars($p['nama_pemilik']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Pet</label>
                <select name="idpet" class="form-select" required>
                    <option value="">-- Pilih Pet (Pemilik) --</option>
                    <?php foreach ($allPetList as $pet): ?>
                        <option value="<?= $pet['idpet'] ?>">
                            <?= htmlspecialchars($pet['nama_pemilik']) ?> - <?= htmlspecialchars($pet['nama_pet']) ?>
                            (<?= htmlspecialchars($pet['jenis_hewan']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Dokter</label>
                <select name="iddokter" class="form-select" required>
                    <option value="">-- Pilih Dokter --</option>
                    <?php foreach ($Listdokter as $d): ?>
                        <option value="<?= $d['idrole_user'] ?>">
                            <?= htmlspecialchars($d['nama_dokter']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Tambah</button>
        </form>



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
                            <th>Jenis Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data):
                            $no = 1;
                            foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['no_temu'] ?></td>
                                    <td><?= date('d M Y, H:i', strtotime($row['tanggal'])) ?></td>
                                    <td><?= $row['nama_pet'] ?></td>
                                    <td><?= $row['jenis_hewan'] ?></td>
                                    <td><?= $row['nama_pemilik'] ?></td>
                                    <td><?= $row['nama_dokter'] ?></td>
                                    <td>
                                        <!-- Form Edit -->
                                        <form method="post" action="../../../Controller/Temu_Dokter_Process.php"
                                            class="d-inline">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="no_temu" value="<?= $row['no_temu'] ?>">
                                            <input type="hidden" name="iddokter" value="<?= $row['iddokter'] ?? '' ?>">
                                            <!-- <input type="hidden" name="keluhan" value="<?= $row['keluhan'] ?>"> -->
                                            <button class="btn btn-warning btn-sm">✏️ Edit</button>
                                        </form>

                                        <!-- Form Delete -->
                                        <form method="post" action="../../../Controller/Temu_Dokter_Process.php"
                                            class="d-inline">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="no_temu" value="<?= $row['no_temu'] ?>">
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">🗑️
                                                Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="../Resepsionis_dashboard.php" class="btn btn-secondary rounded-pill">⬅ Kembali ke
                        Dashboard </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>