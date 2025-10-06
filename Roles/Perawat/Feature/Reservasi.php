<?php
require_once(__DIR__ . '/../../../DB/DBconnection.php');
require_once(__DIR__ . '/../../../Class/Reservasi.php');

$db = (new DBconnection())->getConnection();
$reservasi = new Reservasi($db);

$data = $reservasi->getAll();
$hewan = $reservasi->getAllHewan();
$dokter = $reservasi->getAllDokter();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-calendar-check"></i> Daftar Reservasi Dokter</h4>
            </div>

                <!-- TABEL -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>No Temu</th>
                                <th>Nama Hewan</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)): ?>
                                <?php $no = 1;
                                foreach ($data as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><span class="badge bg-secondary"><?= htmlspecialchars($row['no_temu']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($row['nama_pet']) ?></td>
                                        <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
                                        <td>
                                            <?php
                                            $statusBadge = [
                                                'P' => 'warning',
                                                'S' => 'success',
                                                'D' => 'danger'
                                            ];
                                            ?>
                                            <span class="badge bg-<?= $statusBadge[$row['status']] ?? 'secondary' ?>">
                                                <?= $row['status'] == 'P' ? 'Pending' : ($row['status'] == 'S' ? 'Selesai' : 'Dibatalkan') ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                        <td>
                                            <form method="POST" action="/PHP_Native_Web_OOP-Modul4/Controller/Reservasi_Process.php""
                                                class="d-inline">
                                                <input type="hidden" name="idreservasi_dokter"
                                                    value="<?= $row['idreservasi_dokter'] ?>">
                                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                                    <option value="P" <?= $row['status'] == 'P' ? 'selected' : '' ?>>Pending
                                                    </option>
                                                    <option value="S" <?= $row['status'] == 'S' ? 'selected' : '' ?>>Selesai
                                                    </option>
                                                    <option value="D" <?= $row['status'] == 'D' ? 'selected' : '' ?>>Dibatalkan
                                                    </option>
                                                </select>
                                                <button type="submit" name="update" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </form>

                                            <form method="POST" action="/PHP_Native_Web_OOP-Modul4/Controller/Reservasi_Process.php"
                                                class="d-inline">
                                                <input type="hidden" name="idreservasi_dokter"
                                                    value="<?= $row['idreservasi_dokter'] ?>">
                                                <button type="submit" name="delete" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus reservasi ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-muted">Belum ada data reservasi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>