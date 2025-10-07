<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$detailObj = new RekamMedisDetail($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $idrekam = $_POST['idrekam_medis'];
            $idkode = $_POST['idkode_tindakan_terapi'];
            $detail = $_POST['detail'];

            $detailObj->create($idrekam, $idkode, $detail);
            $_SESSION['msg'] = "✅ Detail tindakan berhasil ditambahkan.";
        } elseif ($action === 'update') {
            $iddetail = $_POST['iddetail_rekam_medis'];
            $idkode = $_POST['idkode_tindakan_terapi'];
            $detail = $_POST['detail'];

            $detailObj->update($iddetail, $idkode, $detail);
            $_SESSION['msg'] = "✅ Detail tindakan berhasil diperbarui.";
        } elseif ($action === 'delete') {
            $iddetail = $_POST['iddetail_rekam_medis'];
            $detailObj->delete($iddetail);
            $_SESSION['msg'] = "🗑️ Detail tindakan berhasil dihapus.";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    // kembali ke halaman detail
    $idrekam = $_POST['idrekam_medis'] ?? '';
    header("Location: ../Roles/Perawat/Feature/Detail_Rekam_Medis.php?idrekam_medis=$idrekam");
    exit;
}
