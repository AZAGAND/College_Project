<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Dokter.php';

$db = new DBConnection();
$dokterObj = new Dokter($db);
$data = $dokterObj->getAll();

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">👨‍⚕️ Daftar Dokter</h2>
        <?php if ($msg): ?>
            <div class="alert alert-info"><?= $msg ?></div><?php endif; ?>

        <!-- Form Tambah Dokter -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">Tambah Dokter</div>
            <div class="card-body">
                <form action="../../../Controller/Data_Dokter_Process.php" method="post">
                    <input type="hidden" name="action" value="create">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah Dokter</button>
                </form>
            </div>
        </div>


        <div class="card shadow">
            <div class="card-header bg-dark text-white">Data Dokter</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data):
                            $no = 1;
                            foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= $row['status'] ? 'Aktif' : 'Nonaktif' ?></td>
                                    <td>
                                        <form action="../../../Controller/data_Dokter_Process.php" method="post"
                                            class="d-inline">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="idrole_user" value="<?= $row['idrole_user'] ?>">
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus dokter?')">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada dokter</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
            </div>
            </table>
            <div class="card-footer">
            <a href="../../../Data_master/Data_Master.php" class="btn btn-secondary rounded-pill">⬅ Kembali ke Dashboard </a>
            </div>
            </div>
        </div>
    </div>
</body>

</html>