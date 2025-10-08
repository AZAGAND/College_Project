<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Kategori_Klinis.php';

$db = new DBConnection();
$katObj = new Kategori_Klinis($db);
$allKat = $katObj->getAll();

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori Klinis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">🏥</span>
                <span class="font-bold text-lg">Data Kategori Klinis</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">🏥 Data Kategori Klinis</h2>
            <p class="text-gray-600">Kelola kategori layanan klinis untuk hewan</p>
        </div>

        <!-- Alert Message -->
        <?php if ($msg): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg shadow">
                <p class="font-medium"><?= htmlspecialchars($msg) ?></p>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Kategori Klinis -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-semibold text-green-700 mb-4">➕ Tambah Kategori Klinis Baru</h3>
            <form method="post" action="../../../Controller/KategoriKlinis_Process.php" class="flex flex-col md:flex-row gap-4">
                <input type="hidden" name="action" value="create">
                <input type="text" 
                        name="nama_kategori_klinis" 
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                        placeholder="Nama kategori klinis baru"
                        required>
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 whitespace-nowrap">
                    ➕ Tambah
                </button>
            </form>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold w-24">ID</th>
                            <th class="px-4 py-3 text-center font-semibold">Nama Kategori Klinis</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($allKat)): ?>
                            <?php foreach ($allKat as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium">
                                        <?= htmlspecialchars($row['idkategori_klinis']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-lg text-sm font-semibold">
                                            <?= htmlspecialchars($row['nama_kategori_klinis']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2 flex-wrap">
                                            <!-- Form Update -->
                                            <form method="post" action="../../../Controller/KategoriKlinis_Process.php" class="flex items-center gap-2">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="idkategori_klinis" value="<?= $row['idkategori_klinis'] ?>">
                                                <input type="text" 
                                                        name="nama_kategori_klinis" 
                                                        value="<?= htmlspecialchars($row['nama_kategori_klinis']) ?>" 
                                                        class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                                        required>
                                                <button type="submit" 
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
                                                    ✏️ Update
                                                </button>
                                            </form>

                                            <!-- Form Delete -->
                                            <form method="post" action="../../../Controller/KategoriKlinis_Process.php" onsubmit="return confirm('Yakin hapus kategori klinis ini?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="idkategori_klinis" value="<?= $row['idkategori_klinis'] ?>">
                                                <button type="submit" 
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">🏥</div>
                                        <p class="text-lg font-medium">Belum ada data kategori klinis</p>
                                        <p class="text-sm">Silakan tambahkan kategori klinis baru</p>
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