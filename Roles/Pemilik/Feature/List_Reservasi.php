<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Pemilik.php';
require_once __DIR__ . '/../../../Class/Reservasi.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Pemilik') {
    header("Location: ../../../Views/login_RSHP.php");
    exit;
}

$db = new DBConnection();
$pemilikObj = new Pemilik($db);
$reservasiObj = new Reservasi($db);

$iduser = $_SESSION['iduser'];
$idpemilik = $pemilikObj->getIdPemilikByUser($iduser);
$reservasiList = $reservasiObj->getReservasiByPemilik($idpemilik);

function esc($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reservasi Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
<nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow">
    <h1 class="text-xl font-bold">📅 Daftar Reservasi Saya</h1>
    <a href="../Pemilik_Dashboard.php" class="bg-gray-700 hover:bg-gray-800 px-4 py-2 rounded-lg">⬅ Kembali</a>
</nav>

<main class="container mx-auto p-6 flex-grow">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">📋 Riwayat & Reservasi Aktif</h2>
        <?php if ($reservasiList): ?>
        <table class="w-full border-collapse">
            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="py-2 px-3 text-left">No</th>
                    <th class="py-2 px-3 text-left">Hewan</th>
                    <th class="py-2 px-3 text-left">Dokter</th>
                    <th class="py-2 px-3 text-left">Tanggal</th>
                    <th class="py-2 px-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $no=1; foreach ($reservasiList as $r): ?>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-3"><?= $no++; ?></td>
                    <td class="py-2 px-3"><?= esc($r['nama_pet']); ?></td>
                    <td class="py-2 px-3"><?= esc($r['nama_dokter']); ?></td>
                    <td class="py-2 px-3"><?= esc(date('d M Y', strtotime($r['tanggal_reservasi']))); ?></td>
                    <td class="py-2 px-3">
                        <?php
                            $status = strtolower($r['status']);
                            $color = match($status) {
                                'selesai' => 'bg-green-200 text-green-800',
                                'dibatalkan' => 'bg-red-200 text-red-800',
                                default => 'bg-yellow-200 text-yellow-800'
                            };
                        ?>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?= $color ?>">
                            <?= ucfirst($r['status']); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p class="text-gray-500 italic">Belum ada reservasi yang tercatat.</p>
        <?php endif; ?>
    </div>
</main>

<footer class="bg-blue-900 text-white py-4 text-center mt-auto">
    <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga</p>
</footer>
</body>
</html>
