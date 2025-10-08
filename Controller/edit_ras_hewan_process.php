<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Ras_Hewan.php';

$db = new DBConnection();
$rasObj = new RasHewan($db->getConnection());

$id = $_GET['id'] ?? ($_POST['idras_hewan'] ?? null);
$notif = "";
$ras = null;
$rasList = [];
$jenis = null;

// 🔹 Ambil data ras & jenis berdasarkan ID
if ($id) {
    $ras = $rasObj->getById($id);

    if ($ras) {
        $jenis = $rasObj->getJenisByRasId($id);
        $rasList = $rasObj->getRasByJenis($jenis['idjenis_hewan']);
    } else {
        $notif = "❌ Data ras tidak ditemukan!";
    }
}

// 🔹 Proses update data ras
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama_ras'])) {
    $namaBaru = trim($_POST['nama_ras']);
    $idJenis = $ras['idjenis_hewan'] ?? null;

    if ($id && $idJenis && $rasObj->update($id, $namaBaru, $idJenis)) {
        $_SESSION['notif'] = "✅ Nama ras berhasil diperbarui!";
        header("Location: ../Ras_Hewan.php");
        exit;
    } else {
        $notif = "❌ Gagal memperbarui nama ras!";
    }
}
