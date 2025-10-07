<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Rekam_Medis.php';
require_once __DIR__ . '/../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);
$detailObj = new RekamMedisDetail($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $rekamObj->create($_POST['idreservasi'], $_POST['diagnosa'], $_POST['catatan'], $_POST['temuan_klinis']);
            $_SESSION['msg'] = "✅ Rekam medis berhasil ditambahkan.";
        } elseif ($action === 'update') {
            $rekamObj->update(
                $_POST['idrekam_medis'],
                $_POST['diagnosa'],
                $_POST['anamnesa'],
                $_POST['temuan_klinis']
            );
            $_SESSION['msg'] = "✅ Rekam medis berhasil diperbarui.";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Perawat/Feature/Rekam_Medis.php");
    exit;
}
