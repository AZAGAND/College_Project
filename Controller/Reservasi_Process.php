<?php
session_start();
require_once __DIR__ . '/../DB/DBconnection.php';
require_once __DIR__ . '/../Class/Reservasi.php';

// 🔹 INIT
$db = (new DBconnection())->getConnection();
$reservasi = new Reservasi($db);

// 🔹 Ambil data dropdown & tabel
$hewan = $reservasi->getAllHewan();
$dokter = $reservasi->getAllDokter();
$data = $reservasi->getAll();

// 🔹 Cek jika ada action POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CREATE
    if (isset($_POST['create'])) {
        $success = $reservasi->create($_POST['idpet'], $_POST['idrole_user']);
        $_SESSION['msg'] = $success
            ? "✅ Reservasi baru berhasil ditambahkan!"
            : "❌ Gagal menambah reservasi!";
        header("Location: /PHP_Native_Web_OOP-Modul4/Roles/Perawat/Feature/Reservasi.php");
        exit;
    }

    // UPDATE
    if (isset($_POST['update'])) {
        $id = $_POST['idreservasi_dokter'];
        $status = $_POST['status'];
        $success = $reservasi->updateStatus($id, $status);
        $_SESSION['msg'] = $success ? "✏️ Status reservasi diperbarui!" : "❌ Gagal memperbarui status!";
        header("Location: /PHP_Native_Web_OOP-Modul4/Roles/Perawat/Feature/Reservasi.php");
        exit;
    }

    // DELETE
    if (isset($_POST['delete'])) {
        $success = $reservasi->delete($_POST['idreservasi_dokter']);
        $_SESSION['msg'] = $success
            ? "🗑️ Reservasi berhasil dihapus!"
            : "❌ Gagal menghapus reservasi!";
        header("Location: /PHP_Native_Web_OOP-Modul4/Roles/Perawat/Feature/Reservasi.php");
        exit;
    }
}

// 🔹 Kirim ke View
include __DIR__ . "/../Roles/Perawat/Feature/Reservasi.php";
exit;