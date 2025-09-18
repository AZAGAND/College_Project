<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Pet.php';

$db = new DBConnection();
$petObj = new Pet($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpemilik = $_POST['idpemilik'] ?? null;
    $nama = trim($_POST['nama'] ?? '');
    $idras_hewan = $_POST['idras_hewan'] ?? null;
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? null;
    $warna_tanda = trim($_POST['warna_tanda'] ?? '');
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? null;

    if (!$idpemilik || !$nama || !$idras_hewan) {
        $_SESSION['msg'] = "❌ Lengkapi: Pemilik, Nama, dan Ras Hewan wajib diisi.";
        header("Location: ../Roles/Resepsionis/Feature/Registrasi_Pet.php");
        exit;
    }

    try {
        $ok = $petObj->create($idpemilik, $nama, $idras_hewan, $tanggal_lahir, $warna_tanda, $jenis_kelamin);
        $_SESSION['msg'] = $ok ? "✅ Pet berhasil diregistrasi!" : "❌ Gagal registrasi pet.";
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Resepsionis/Feature/Registrasi_Pet.php");
    exit;
}
