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
$groupedData = $rasObj->getGroupedData();
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

        <!-- Tabel Data Terkelompok -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Hewan</th>
                        <th>Daftar Ras</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($groupedData as $jenis => $data): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="jenis-cell"><?= htmlspecialchars($data['jenis_nama']); ?></td>
                            <td>
                                <div class="ras-container">
                                    <?php foreach ($data['ras_list'] as $ras): ?>
                                        <div class="ras-item">
                                            <span class="ras-name"><?= htmlspecialchars($ras['nama']); ?></span>
                                            <button class="delete-ras" 
                                                    onclick="if(confirm('Yakin hapus ras <?= htmlspecialchars($ras['nama']); ?>?')) { window.location.href='?hapus=<?= $ras['id']; ?>'; }"
                                                    title="Hapus <?= htmlspecialchars($ras['nama']); ?>">
                                                ×
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($groupedData)): ?>
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 40px; color: #666;">
                                Belum ada data ras hewan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol Kembali -->
        <div class="table-footer">
            <a href="../../../Data_master/Data_Master.php" class="btn btn-add">⬅ Kembali ke Data Master</a>
        </div>
    </div>
</body>

</html>