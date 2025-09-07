<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Controller/Ras_hewan_process.php';
require_once __DIR__ . '/../../../Controller/Jenis_hewan_process.php';

$db = new DBConnection();
$conn = $db->getConnection();

// pakai controller
$rasObj = new Ras_Hewan($conn);
$jenisObj = new Jenis_Hewan($conn);

// Tambah data
if (isset($_POST['tambah'])) {
    $rasObj->store($_POST['nama_ras'], $_POST['idjenis']);
    header("Location: Ras_Hewan.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $rasObj->destroy($_GET['hapus']);
    header("Location: Ras_Hewan.php");
    exit;
}

// Ambil data
$dataRas = $rasObj->index();
$dataJenis = $jenisObj->index();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Master Ras Hewan</title>
    <link rel="stylesheet" href="../../../CSS/Ras_Hewan.css">
</head>

<body>
    <div class="container">
        <h2>🐾 Menu Ras Hewan</h2>

        <!-- Form Tambah -->
        <form method="post">
            <input type="text" name="nama_ras" placeholder="Nama Ras" required>
            <select name="idjenis" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                <?php foreach ($dataJenis as $j): ?>
                    <option value="<?= $j['idjenis_hewan']; ?>"><?= $j['nama_jenis_hewan']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="tambah" class="btn btn-green">+ Tambah Ras</button>
        </form>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Ras</th>
                    <th>Jenis Hewan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataRas as $row): ?>
                    <tr>
                        <td><?= $row['idras_hewan']; ?></td>
                        <td><?= $row['nama_ras']; ?></td>
                        <td><?= $row['nama_jenis_hewan']; ?></td>
                        <td class="aksi">
                            <a href="?hapus=<?= $row['idras_hewan']; ?>" onclick="return confirm('Yakin hapus data ini?')"
                                class="btn btn-red">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tombol Kembali -->
        <div class="table-footer">
            <a href="../../../Data_master/Data_Master.php" class="btn btn-add">⬅ Kembali ke Data Master</a>
        </div>
    </div>
</body>

</html>