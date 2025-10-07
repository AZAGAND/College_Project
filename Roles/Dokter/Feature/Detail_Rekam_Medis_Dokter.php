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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekam Medis (Dokter)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-4">
                <a href="Rekam_Medis_Dokter.php" class="relative font-medium pb-1 group inline-block">
                    ← Kembali
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <div class="h-6 w-px bg-blue-700"></div>
                <div class="flex items-center gap-2">
                    <span class="text-xl">🩺</span>
                    <span class="font-bold text-lg">Detail Rekam Medis</span>
                </div>
            </div>
            
            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span class="font-semibold"><?= htmlspecialchars($_SESSION['nama'] ?? 'Dokter'); ?></span></span>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-4xl font-bold mb-3">📋 Detail Rekam Medis Pasien</h1>
            <p class="text-blue-100 text-lg">Informasi lengkap pemeriksaan dan tindakan terapi yang telah dilakukan.</p>
        </div>

        <!-- Informasi Pasien -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-blue-900 mb-6 pb-3 border-b-2 border-blue-100">👤 Informasi Pasien</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">🐾</span>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Nama Hewan</p>
                            <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($rekam['nama_pet']); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">👨‍👩‍👧</span>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Pemilik</p>
                            <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($rekam['nama_pemilik']); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">📅</span>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Tanggal Pemeriksaan</p>
                            <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($rekam['created_at']); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">🔬</span>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Diagnosa</p>
                            <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($rekam['diagnosa']); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">📝</span>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Anamnesa</p>
                            <p class="text-gray-700"><?= htmlspecialchars($rekam['anamnesa']); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">🩺</span>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Temuan Klinis</p>
                            <p class="text-gray-700"><?= htmlspecialchars($rekam['temuan_klinis']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Tindakan Terapi -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-2xl font-bold text-blue-900 mb-6 pb-3 border-b-2 border-blue-100">💉 Detail Tindakan Terapi</h3>

            <?php if ($details): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">No</th>
                                <th class="px-4 py-3 text-left font-semibold">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold">Deskripsi Tindakan</th>
                                <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $no = 1;
                            foreach ($details as $d): ?>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-4 py-4 text-gray-900 font-medium"><?= $no++; ?></td>
                                    <td class="px-4 py-4">
                                        <span class="inline-block bg-blue-100 text-blue-900 px-3 py-1 rounded-lg font-semibold text-sm">
                                            <?= htmlspecialchars($d['kode']); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($d['deskripsi_tindakan_terapi']); ?></td>
                                    <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($d['detail']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📭</div>
                    <p class="text-gray-500 text-lg italic">Belum ada tindakan terapi yang tercatat untuk pasien ini.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Quick Info -->
        <div class="mt-8">
            <div class="bg-blue-50 border-l-4 border-blue-900 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">💡</div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Informasi</h3>
                        <p class="text-gray-700 leading-relaxed">Data rekam medis ini mencatat seluruh pemeriksaan dan tindakan terapi yang telah dilakukan. Pastikan semua informasi terisi dengan lengkap dan akurat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>