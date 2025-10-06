<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Dokter.php';

$db = new DBConnection();
$dokterObj = new Dokter($db);

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $dokterObj->create($nama, $email, $password);

    $_SESSION['msg'] = "Dokter baru berhasil ditambahkan.";
    header("Location: ../Roles/Admin/Views/Data_Dokter.php");
    exit;
} elseif ($action === 'delete') {

    $idrole_user = intval($_POST['idrole_user']);
    $dokterObj->delete($idrole_user);
    $_SESSION['msg'] = "Data dokter berhasil dihapus.";
    header("Location: ../Roles/Admin/Views/Data_Dokter.php");
    exit;
}