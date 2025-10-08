<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Rekam_Medis.php';
require_once __DIR__ . '/../../../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);

// Ambil semua data rekam medis
$allRekam = $rekamObj->getAll();

// Helper aman
function esc($val)
{
    return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rekam Medis (Dokter)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen h-full bg-gray-50"">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-4">
                <a href="../Dokter_Dashboard.php" class="relative font-medium pb-1 group inline-block">
                    ← Home
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <div class="h-6 w-px bg-blue-700"></div>
                <div class="flex items-center gap-2">
                    <span class="text-xl">🩺</span>
                    <span class="font-bold text-lg">Data Rekam Medis</span>
                </div>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span
                        class="font-semibold"><?= htmlspecialchars($_SESSION['nama'] ?? 'Dokter'); ?></span></span>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-4xl font-bold mb-3">📋 Daftar Rekam Medis</h1>
            <p class="text-blue-100 text-lg">Lihat dan kelola rekam medis pasien hewan peliharaan yang telah diperiksa.
            </p>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">No</th>
                            <th class="px-4 py-3 text-left font-semibold">Nomor Reservasi</th>
                            <th class="px-4 py-3 text-left font-semibold">Pemilik</th>
                            <th class="px-4 py-3 text-left font-semibold">Pet</th>
                            <th class="px-4 py-3 text-left font-semibold">Diagnosa</th>
                            <th class="px-4 py-3 text-left font-semibold">Anamnesa</th>
                            <th class="px-4 py-3 text-left font-semibold">Temuan Klinis</th>
                            <th class="px-4 py-3 text-left font-semibold">Dokter Pemeriksa</th>
                            <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $no = 1;
                        foreach ($allRekam as $row): ?>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-4 py-4 text-gray-900 font-medium"><?= $no++; ?></td>
                                <td class="px-4 py-4 text-gray-700">
                                    <span
                                        class="font-semibold text-blue-900"><?= htmlspecialchars($row['idreservasi']); ?></span>
                                    <span class="text-gray-500">- <?= htmlspecialchars($row['no_urut']); ?></span>
                                </td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['nama_pemilik']); ?></td>
                                <td class="px-4 py-4 text-gray-700">
                                    <span
                                        class="font-medium text-gray-900"><?= htmlspecialchars($row['nama_pet']); ?></span>
                                </td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['diagnosa']); ?></td>
                                <td class="px-4 py-4 text-gray-700 max-w-xs truncate"
                                    title="<?= htmlspecialchars($row['catatan']); ?>">
                                    <?= htmlspecialchars($row['catatan']); ?>
                                </td>
                                <td class="px-4 py-4 text-gray-700 max-w-xs truncate"
                                    title="<?= htmlspecialchars($row['temuan_klinis']); ?>">
                                    <?= htmlspecialchars($row['temuan_klinis']); ?>
                                </td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['nama_dokter']); ?></td>
                                <td class="px-4 py-4 text-gray-700">
                                    <span class="text-sm"><?= htmlspecialchars($row['tanggal']); ?></span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <a href="Detail_Rekam_Medis_Dokter.php?idrekam_medis=<?= $row['idrekam_medis']; ?>"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-300">
                                        🔍 Detail
                                    </a>
                                </td>
                                <input type="hidden" name="idrekam_medis" value="<?= $row['idrekam_medis']; ?>">
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="mt-8">
            <div class="bg-blue-50 border-l-4 border-blue-900 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">💡</div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Informasi</h3>
                        <p class="text-gray-700 leading-relaxed">Klik tombol <strong>Detail</strong> untuk melihat
                            informasi lengkap rekam medis pasien, termasuk tindakan terapi yang telah dilakukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>