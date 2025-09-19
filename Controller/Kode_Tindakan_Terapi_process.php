<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Kode_Tindakan_Terapi.php';

$db = new DBConnection();
$tindakanObj = new Kode_Tindakan_Terapi($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $tindakanObj->create($_POST['kode'], $_POST['deskripsi_tindakan_terapi'], $_POST['idkategori_klinis']);
            $_SESSION['msg'] = "✅ Tindakan berhasil ditambahkan.";
        } elseif ($action === 'update') {
            $tindakanObj->update($_POST['idkode_tindakan_terapi'], $_POST['kode'], $_POST['deskripsi_tindakan_terapi'], $_POST['idkategori_klinis']);
            $_SESSION['msg'] = "✅ Tindakan berhasil diperbarui.";
        } elseif ($action === 'delete') {
            $tindakanObj->delete($_POST['idkode_tindakan_terapi']);
            $_SESSION['msg'] = "✅ Tindakan berhasil dihapus.";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Admin/Views/data_kode_tindakan.php");
    exit;
}
