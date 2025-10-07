<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Rekam_Medis.php';
require_once __DIR__ . '/../../../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);
$detailObj = new RekamMedisDetail($db);

$idrekam = $_GET['idrekam_medis'] ?? null;
if (!$idrekam) {
    header("Location: Rekam_Medis.php");
    exit;
}

$rekam = $rekamObj->getById($idrekam);
$details = $detailObj->getByRekamMedis($idrekam);

function esc($val)
{
    return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Rekam Medis (Dokter)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow">
        <h1 class="text-xl font-bold">🩺 Detail Rekam Medis Pasien</h1>
    </nav>

    <main class="container mx-auto p-6 flex-grow">
        <!-- Informasi utama -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Pasien</h2>
            <p><strong>Nama Hewan:</strong> <?= esc($rekam['nama_pet']); ?></p>
            <p><strong>Pemilik:</strong> <?= esc($rekam['nama_pemilik']); ?></p>
            <p><strong>Diagnosa:</strong> <?= esc($rekam['diagnosa']); ?></p>
            <p><strong>Anamnesa:</strong> <?= esc($rekam['anamnesa']); ?></p>
            <p><strong>Temuan Klinis:</strong> <?= esc($rekam['temuan_klinis']); ?></p>
            <p><strong>Tanggal Pemeriksaan:</strong> <?= esc($rekam['created_at']); ?></p>
        </div>

        <!-- Daftar tindakan -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">📋 Detail Tindakan Terapi</h3>

            <?php if ($details): ?>
                <table class="w-full border-collapse">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="py-2 px-3 text-left">No</th>
                            <th class="py-2 px-3 text-left">Kode</th>
                            <th class="py-2 px-3 text-left">Deskripsi</th>
                            <th class="py-2 px-3 text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $no = 1;
                        foreach ($details as $d): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-3"><?= $no++; ?></td>
                                <td class="py-2 px-3"><?= esc($d['kode']); ?></td>
                                <td class="py-2 px-3"><?= esc($d['deskripsi_tindakan_terapi']); ?></td>
                                <td class="py-2 px-3"><?= esc($d['detail']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-500 italic">Belum ada tindakan yang tercatat.</p>
            <?php endif; ?>
        </div>
        <div class="mt-6">
            <a href="../Dokter_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">⬅ Kembali ke
                Rekam Medis</a>
        </div>
    </main>

    <footer class="bg-blue-900 text-white py-6 text-center mt-auto">
        <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga</p>
    </footer>

</body>

</html>