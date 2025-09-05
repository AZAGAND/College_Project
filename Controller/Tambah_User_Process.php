<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/User.php';

$db = new DBConnection();
$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $success = $userObj->TambahUser($nama, $email, $password);

    if ($success) {
        $_SESSION['message'] = "✅ User berhasil ditambahkan!";
    } else {
        $_SESSION['message'] = "❌ Gagal menambahkan user!";
    }

    header("Location: Data_User.php");
    exit;
}
?>
