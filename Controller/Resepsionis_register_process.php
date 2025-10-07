<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Owner.php';

$db = new DBConnection();
$pemilik = new Pemilik($db);

$notif = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nama = trim($_POST['nama']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $no_wa = trim($_POST['no_wa']);
        $alamat = trim($_POST['alamat']);

        $pemilik->set_data_user($nama, $email, $password, $no_wa, $alamat);
        $pemilik->create();

        $_SESSION['notif'] = "✅ Pemilik berhasil didaftarkan!";
        header("Location: ../Roles/Resepsionis/Feature/Registrasi_Pemilik.php");
    } catch (Exception $e) {
        $_SESSION['notif'] = "❌ Error: " . $e->getMessage();
        header("Location: ../Roles/Resepsionis/Feature/Registrasi_Pemilik.php");
        exit;
    }
}

?>