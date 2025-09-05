<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/User.php';
require_once __DIR__ . '/../Class/Role.php';

$db = new DBConnection();
$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['iduser'] ?? null;
    $nama = trim($_POST['nama']);

    if (!$id) {
        $_SESSION['error'] = "❌ ID user tidak ditemukan!";
        header("Location: ../Data_Master/Data_User/Data_user.php");
        exit;
    }

    try {
        $userObj->updateuser($id, $nama, $userObj->getUserById($id)['email']); // update nama saja
        $_SESSION['success'] = "✅ User berhasil diperbarui!";
    } catch (Exception $e) {
        $_SESSION['error'] = "❌ Error: " . $e->getMessage();
    }

    // **Redirect ke Data_user agar notif muncul di tabel utama**
    header("Location: ../Data_Master/Data_User/Data_user.php");
    exit;
}
