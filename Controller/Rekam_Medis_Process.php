<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/RekamMedis.php';
require_once __DIR__ . '/../Class/RekamMedisDetail.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);
$detailObj = new RekamMedisDetail($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $rekamObj->create($_POST['idreservasi'], $_POST['diagnosa'], $_POST['catatan']);
            $_SESSION['msg'] = "✅ Rekam medis berhasil ditambahkan.";
        } elseif ($action === 'update') {
            $rekamObj->update($_POST['idrekam_medis'], $_POST['diagnosa'], $_POST['catatan']);
            $_SESSION['msg'] = "✅ Rekam medis berhasil diperbarui.";
        } elseif ($action === 'delete') {
            $rekamObj->delete($_POST['idrekam_medis']);
            $_SESSION['msg'] = "✅ Rekam medis berhasil dihapus.";
        } elseif ($action === 'add_detail') {
            $detailObj->create($_POST['idrekam_medis'], $_POST['idtindakan'], $_POST['hasil']);
            $_SESSION['msg'] = "✅ Detail rekam medis berhasil ditambahkan.";
        } elseif ($action === 'update_detail') {
            $detailObj->update($_POST['iddetail'], $_POST['idtindakan'], $_POST['hasil']);
            $_SESSION['msg'] = "✅ Detail rekam medis berhasil diperbarui.";
        } elseif ($action === 'delete_detail') {
            $detailObj->delete($_POST['iddetail']);
            $_SESSION['msg'] = "✅ Detail rekam medis berhasil dihapus.";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Perawat/RekamMedis.php");
    exit;
}
