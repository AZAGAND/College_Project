<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Pet.php';

// koneksi
$db = new DBConnection();
$petObj = new Pet($db);

// ambil semua data pet
$allPets = $petObj->getAllPets();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">🐾</span>
                <span class="font-bold text-lg">Data Hewan Peliharaan</span>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span
                        class="font-semibold"><?= $_SESSION['nama'] ?? 'Admin'; ?></span></span>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-blue-900 mb-2">🐾 Data Hewan Peliharaan</h2>
            <p class="text-gray-600">Informasi lengkap hewan peliharaan yang terdaftar</p>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <?php if (empty($allPets)): ?>
                <!-- Alert Warning -->
                <div class="p-6">
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
                        <div class="flex items-center">
                            <span class="text-2xl mr-3">⚠️</span>
                            <p class="font-medium">Belum ada data hewan peliharaan.</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">ID Pet</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Nama Pet</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Jenis</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Ras</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Tanggal Lahir</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Warna/Tanda</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Jenis Kelamin</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Pemilik</th>
                                <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Email Pemilik</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($allPets as $pet): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium whitespace-nowrap">
                                        <?= htmlspecialchars($pet['idpet']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="text-gray-900 font-semibold">
                                            <?= htmlspecialchars($pet['nama_pet']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <?= htmlspecialchars($pet['nama_jenis_hewan']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700 whitespace-nowrap">
                                        <?= htmlspecialchars($pet['nama_ras']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700 whitespace-nowrap">
                                        <?= $pet['tanggal_lahir'] ? htmlspecialchars($pet['tanggal_lahir']) : '<span class="text-gray-400">-</span>' ?>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700 whitespace-nowrap">
                                        <?= $pet['warna_tanda'] ? htmlspecialchars($pet['warna_tanda']) : '<span class="text-gray-400">-</span>' ?>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <?php if ($pet['jenis_kelamin'] == 'J'): ?>
                                            <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                ♂️ Jantan
                                            </span>
                                        <?php elseif ($pet['jenis_kelamin'] == 'B'): ?>
                                            <span class="inline-block bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-medium">
                                                ♀️ Betina
                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700 font-medium whitespace-nowrap">
                                        <?= htmlspecialchars($pet['nama_pemilik']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <a href="mailto:<?= htmlspecialchars($pet['email']) ?>" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            <?= htmlspecialchars($pet['email']) ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="../../../Data_master/Data_Master.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Data Master
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2024 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
