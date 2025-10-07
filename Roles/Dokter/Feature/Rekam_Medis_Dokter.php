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
    <title>Data Rekam Medis (Dokter)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white shadow-lg px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">🩺 Data Rekam Medis Pasien</h1>
        <div>
            <span class="mr-3 text-blue-100">Halo, <?= esc($_SESSION['nama'] ?? 'Dokter'); ?></span>
            <a href="../../Views/Logout.php" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded">Logout</a>
        </div>
    </nav>

    <!-- Konten -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">📋 Daftar Rekam Medis</h2>

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
                            <th class="px-4 py-3 text-left font-semibold">temuan klinis</th>
                            <th class="px-4 py-3 text-left font-semibold">Dokter Pemeriksa</th>
                            <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $no = 1;
                        foreach ($allRekam as $row): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-900 font-medium"><?= $no++; ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['idreservasi']); ?> -
                                    <?= htmlspecialchars($row['no_temu']); ?>
                                </td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['nama_pemilik']); ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['nama_pet']); ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['diagnosa']); ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['catatan']); ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= esc($row['temuan_klinis']); ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['nama_dokter']); ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($row['tanggal']); ?></td>
                                <td class="px-4 py-4 flex gap-2">
                                    <a href="Detail_Rekam_Medis_Dokter.php?idrekam_medis=<?= $row['idrekam_medis']; ?>"
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-2 rounded-lg">
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

        <div class="mt-6">
            <a href="../Dokter_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">⬅ Kembali ke
                Dashboard</a>
        </div>
    </main>

    <footer class="bg-blue-900 text-white py-6 text-center">
        <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga</p>
    </footer>

</body>

</html>