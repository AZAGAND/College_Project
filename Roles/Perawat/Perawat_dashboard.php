<?php
session_start();
// Cek login dan role
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../Views/Auth/login_RSHP.php");
    exit;
}

$roles = $_SESSION['user']['roles'] ?? [];
$allowed = false;
foreach ($roles as $r) {
    if (strtolower($r['nama_role']) === 'perawat') {
        $allowed = true;
        break;
    }
}
if (!$allowed) {
    header("Location: ../../Views/Auth/login_RSHP.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Perawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f9f9f9;
        }
        .dashboard-container {
            margin-top: 50px;
        }
        .card {
            border-radius: 12px;
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container dashboard-container">
    <h2 class="mb-4 text-center">👩‍⚕️ Dashboard Perawat</h2>
    <div class="row g-4">
        <!-- Menu Rekam Medis -->
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <div class="card-icon">📋</div>
                <h5 class="card-title">Rekam Medis</h5>
                <p class="card-text">Kelola rekam medis pasien dan detail tindakan terapi.</p>
                <a href="Feature/Rekam_Medis.php" class="btn btn-primary">Buka</a>
            </div>
        </div>

        <!-- Menu Reservasi -->
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <div class="card-icon">📅</div>
                <h5 class="card-title">Data Reservasi</h5>
                <p class="card-text">Lihat data reservasi pasien untuk proses rekam medis.</p>
                <a href="Feature/Reservasi.php" class="btn btn-primary">Buka</a>
            </div>
        </div>

        <!-- Menu Logout -->
        <div class="col-md-4">
            <div class="card shadow text-center p-4">
                <div class="card-icon">🚪</div>
                <h5 class="card-title">Logout</h5>
                <p class="card-text">Keluar dari sistem dengan aman.</p>
                <a href="../../Views/Logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
