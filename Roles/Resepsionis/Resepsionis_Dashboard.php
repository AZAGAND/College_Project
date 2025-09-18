<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/Owner.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Resepsionis') {
    header("Location: ../../Views/Auth/login_RSHP.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Resepsionis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard Resepsionis</a>
        <div class="d-flex">
            <span class="navbar-text me-3">Halo, <?= $_SESSION['nama'] ?? 'Resepsionis'; ?></span>
            <a href="../../Views/Logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <!-- Menu Registrasi -->
        <div class="col-md-4">
            <div class="card shadow-lg mb-3">
                <div class="card-header bg-success text-white">Registrasi</div>
                <div class="card-body">
                    <a href="Feature/registrasi_Pemilik.php" class="btn btn-primary w-100 mb-2">➕ Registrasi Pemilik</a>
                    <a href="Feature/registrasi_pet.php" class="btn btn-primary w-100">➕ Registrasi Pet</a>
                </div>
            </div>
        </div>

        <!-- Menu Temu Dokter -->
        <div class="col-md-4">
            <div class="card shadow-lg mb-3">
                <div class="card-header bg-info text-white">Temu Dokter</div>
                <div class="card-body">
                    <a href="temu_dokter.php" class="btn btn-info w-100">🩺 Daftar Temu Dokter</a>
                </div>
            </div>
        </div>

        <!-- Menu Info / Statistik -->
        <div class="col-md-4">
            <div class="card shadow-lg mb-3">
                <div class="card-header bg-warning text-dark">Informasi</div>
                <div class="card-body">
                    <p>Gunakan menu registrasi untuk menambahkan pemilik baru beserta pet-nya, 
                    kemudian lakukan pendaftaran Temu Dokter sesuai kebutuhan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
