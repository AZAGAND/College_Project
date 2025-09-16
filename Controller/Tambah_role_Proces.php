<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Role.php';

$db = new DBConnection();
$roleObj = new Role($db);

// Ambil semua user & role untuk dipakai di View
$allUsers = $roleObj->getAllUsers();
$allRoles = $roleObj->getAllRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iduser = $_POST['iduser'];
    $idrole = $_POST['idrole'];

    if ($roleObj->addRole($iduser, $idrole)) {
        $_SESSION['message'] = "✅ Role berhasil ditambahkan ke user!";
    } else {
        $_SESSION['message'] = "❌ Gagal menambahkan role ke user.";
    }

    header("Location: ../Data_Master/Role_Management/role_management.php");
    exit;
}
