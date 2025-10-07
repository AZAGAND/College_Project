<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Owner.php';

$db = new DBConnection();
$pemilikObj = new Pemilik($db);
$allPemilik = $pemilikObj->getAllPemilik();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👤</span>
                <span class="font-bold text-lg">Data Pemilik</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">👤 Data Pemilik Hewan</h2>
            <p class="text-gray-600">Informasi lengkap pemilik hewan yang terdaftar</p>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold w-24">ID Pemilik</th>
                            <th class="px-4 py-3 text-center font-semibold">Nama</th>
                            <th class="px-4 py-3 text-center font-semibold">Email</th>
                            <th class="px-4 py-3 text-center font-semibold">No. WA</th>
                            <th class="px-4 py-3 text-center font-semibold">Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($allPemilik)): ?>
                            <?php foreach ($allPemilik as $p): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium">
                                        <?= htmlspecialchars($p['idpemilik']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-gray-900 font-semibold">
                                            <?= htmlspecialchars($p['nama']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="mailto:<?= htmlspecialchars($p['email']) ?>" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            <?= htmlspecialchars($p['email']) ?>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="https://wa.me/<?= htmlspecialchars($p['no_wa']) ?>" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 hover:underline">
                                            <span>📱</span>
                                            <span><?= htmlspecialchars($p['no_wa']) ?></span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700">
                                        <?= htmlspecialchars($p['alamat']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">👤</div>
                                        <p class="text-lg font-medium">Belum ada data pemilik</p>
                                        <p class="text-sm">Data pemilik akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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