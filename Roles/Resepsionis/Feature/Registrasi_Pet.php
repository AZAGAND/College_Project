<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Owner.php'; // kalau filenya Owner.php, ganti sesuai

$db = new DBConnection();
$conn = $db->getConnection();

// ambil pemilik
$pemilikObj = new Pemilik($db);
$allPemilik = $pemilikObj->getAllPemilik();

// ambil jenis & ras (nama kolom sesuai dump SQL)
$allJenis = $conn->query("SELECT idjenis_hewan, nama_jenis_hewan FROM jenis_hewan")->fetchAll(PDO::FETCH_ASSOC);
$allRas = $conn->query("SELECT idras_hewan, nama_ras FROM ras_hewan")->fetchAll(PDO::FETCH_ASSOC);

// notif
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Registrasi Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h3>Registrasi Pet</h3>
            </div>
            <div class="card-body">
                <?php if ($msg): ?>
                    <div class="alert alert-info"><?= $msg ?></div>
                <?php endif; ?>

                <form method="post" action="../../../Controller/Register_Pet_process.php">
                    <!-- Pemilik -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Pemilik</label>
                        <select name="idpemilik" class="form-control" required>
                            <option value="">-- Pilih Pemilik --</option>
                            <?php foreach ($allPemilik as $p): ?>
                                <option value="<?= $p['idpemilik'] ?>"><?= $p['nama'] ?> (<?= $p['email'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Nama Pet -->
                    <div class="mb-3">
                        <label class="form-label">Nama Pet</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>

                    <!-- Jenis Hewan (optional, hanya untuk filter UI; tidak disimpan ke tabel pet) -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Hewan</label>
                        <select name="idjenis_hewan" class="form-control">
                            <option value="">-- Pilih Jenis Hewan (opsional) --</option>
                            <?php foreach ($allJenis as $j): ?>
                                <option value="<?= $j['idjenis_hewan'] ?>"><?= $j['nama_jenis_hewan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Ras Hewan (INILAH yang disimpan ke tabel pet sebagai idras_hewan) -->
                    <div class="mb-3">
                        <label class="form-label">Ras Hewan</label>
                        <select name="idras_hewan" class="form-control" required>
                            <option value="">-- Pilih Ras Hewan --</option>
                            <?php foreach ($allRas as $r): ?>
                                <option value="<?= $r['idras_hewan'] ?>"><?= $r['nama_ras'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tambahan kolom yang memang ada di tabel pet -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna / Tanda</label>
                        <input type="text" class="form-control" name="warna_tanda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="J">Jantan</option>
                            <option value="B">Betina</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Daftar</button>
                    <a href="../Resepsionis_Dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>