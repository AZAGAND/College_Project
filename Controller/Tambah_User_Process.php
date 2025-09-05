<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/User.php';

// Buat object User
$db = new DBConnection();
$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $retype = $_POST['retype'];

    // Validasi password
    if ($password !== $retype) {
        $_SESSION['message'] = "❌ Password dan Retype tidak sama!";
        header("Location: ../Data_Master/tambah_user.php");
        exit;
    }

    try {
        $success = $userObj->tambahuser($nama, $email, $password);

        if ($success) {
            $_SESSION['message'] = "✅ User berhasil ditambahkan!";
        } else {
            $_SESSION['message'] = "❌ Gagal menambahkan user!";
        }

    } catch (Exception $e) {
        $_SESSION['message'] = "❌ Error: " . $e->getMessage();
    }

    // Redirect kembali ke Data_user.php setelah berhasil / gagal
    header("Location: ../Data_Master/Data_User/Data_user.php");
    exit;

}
