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
    <?php
    include("../Navigation/menu.php");
    ?>

    
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="Data_User/Data_User.php">👤 Data User</a>
            <a href="Role_Management/role_management.php">⚙️ Manajemen Role</a>
            <a href="../Roles/Admin/Views/Ras_hewan.php">🐾 Menu Ras Hewan</a>
            <a href="../Roles/Admin/Views/Jenis_hewan.php">🐱 Menu Jenis Hewan</a>
            <a href="../Roles/Admin/Views/Data_pemilik.php">📋 Data Pemilik</a>
            <a href="../Roles/Admin/Views/Data_pet.php">🐶 Data Hewan</a>
            <a href="../Roles/Admin/Views/Data_Kategori.php">📋 Data Kategori</a>
            <a href="../Roles/Admin/Views/Data_Kategori_Klinis.php">🩺 Data Kategori Klinis</a>
            <a href="../Roles/Admin/Views/Data_Kode_Tindakan.php">💉 Data Kode Tindakan Terapi</a>
        </aside>

        <!-- Konten utama -->
        <main class="content">
            <h2>Selamat Datang di Data Master</h2>
            <p>Pilih menu di sidebar kiri untuk mengelola data.</p>
        </main>>
</body >

</html >