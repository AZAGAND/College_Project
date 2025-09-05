<?php
session_start();
require_once __DIR__ . '/../../../Class/User.php';
require_once __DIR__ . '/../../../DB/dbconnection.php';

$db = new DBConnection();
$userObj = new User($db);

$id = $_GET['id'] ?? null;
if (!$id)
    die("ID user tidak ditemukan");

$user = $userObj->getUserById($id);
if (!$user)
    die("User tidak ditemukan");

// Ambil session notif
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../../CSS/edit_user.css">
</head>

<body>
    <div class="container">
        <h2>Edit User</h2>
        <form method="post" action="/PHP_Native_Web_OOP-Modul4/Controller/edit_user_process.php">
            <input type="hidden" name="iduser" value="<?= htmlspecialchars($user['iduser']); ?>">
            <label>Nama User</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="../data_user.php">← Kembali ke Data User</a>
    </div>
</body>
</html>