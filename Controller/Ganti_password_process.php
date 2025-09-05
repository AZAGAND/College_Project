<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/User.php';

$db = new DBConnection();
$userObj = new User($db);

$iduser = $_POST['iduser'] ?? null;
$password_baru = $_POST['password_baru'] ?? '';
$retype_password = $_POST['retype_password'] ?? '';
$redirect_to = $_POST['redirect_to'] ?? '/PHP_Native_Web_OOP-Modul4/Data_Master/Data_User/Data_User.php';

if(!$iduser){
    $_SESSION['error'] = "ID user tidak ditemukan!";
    header("Location: $redirect_to");
    exit;
}

if($password_baru !== $retype_password){
    $_SESSION['error'] = "Password baru dan ulangi password tidak sama!";
    header("Location: $redirect_to");
    exit;
}

// Update password via class User
if($userObj->updatePassword($iduser, $password_baru)){
    $_SESSION['success'] = "✅ Password berhasil diubah!";
} else {
    $_SESSION['error'] = "❌ Gagal mengubah password!";
}

// Redirect kembali ke halaman sebelumnya
header("Location: $redirect_to");
exit;
