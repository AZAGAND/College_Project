<?php
session_start();
// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../CSS/Data_Master.css" rel="stylesheet">
    <title>Data Master</title>
</head>
<body>
    <nav>
        <a href="Data_Master.php">🏠 Data Master</a>
    </nav>

    <div class="menu">
        <!-- Arahkan ke Data_User.php -->
        <a href="Data_User/Data_User.php">👤 Data User</a>

        <!-- Arahkan ke role_management.php -->
        <a href="Role_Management/role_management.php">⚙️ Manajemen Role</a>

        <!-- Arahkan balik ke halaman Admin -->
        <a href="../Roles/Admin/admin.php">⬅ Back to Admin Page</a>
    </div>
</body>
</html>
