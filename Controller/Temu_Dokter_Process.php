<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Temu_Dokter.php';

$db = new DBConnection();
$temuObj = new TemuDokter($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $idpemilik = $_POST['idpemilik'];
            $idpet    = $_POST['idpet'];
            $iddokter = $_POST['iddokter'];
            

            $temuObj->create($idpemilik, $idpet, $iddokter);
            $_SESSION['msg'] = "✅ Temu dokter berhasil ditambahkan!";
        }
        elseif ($action === 'update') {
            $idpemilik = $_POST['idpemilik'];
            $no_temu  = $_POST['no_temu'];
            $iddokter = $_POST['iddokter'];
            

            $temuObj->update($no_temu, $iddokter);
            $_SESSION['msg'] = "✏️ Data temu dokter berhasil diperbarui!";
        }
        elseif ($action === 'delete') {
            $no_temu = $_POST['no_temu'];
            $temuObj->delete($no_temu);
            $_SESSION['msg'] = "🗑️ Temu dokter berhasil dihapus!";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Resepsionis/Feature/Temu_Dokter.php");
    exit;
}
