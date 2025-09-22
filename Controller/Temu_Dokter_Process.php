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
            $idpet    = $_POST['idpet'];
            $iddokter = $_POST['iddokter'];
            $keluhan  = $_POST['keluhan'];

            $temuObj->create($idpet, $iddokter);
            $_SESSION['msg'] = "✅ Temu dokter berhasil ditambahkan!";
        }
        elseif ($action === 'update') {
            $no_temu  = $_POST['no_temu'];
            $iddokter = $_POST['iddokter'];
            $keluhan  = $_POST['keluhan'];

            $temuObj->update($no_temu, $keluhan, $iddokter);
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
