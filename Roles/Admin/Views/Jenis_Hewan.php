<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Controller/Jenis_hewan_process.php';

// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$db = new DBConnection();
$conn = $db->getConnection();

$controller = new Jenis_Hewan($conn);

if (isset($_SESSION['error'])) {
    echo '<p style="color:red;">'.$_SESSION['error'].'</p>';
    unset($_SESSION['error']);
}
// Tambah
if (isset($_POST['tambah'])) {
    $controller->store($_POST['nama_jenis']);
    header("Location: Jenis_Hewan.php");
    exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $controller->destroy($_GET['hapus']);
    header("Location: Jenis_Hewan.php");
    exit;
}

$data = $controller->getall();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Jenis Hewan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">📋</span>
                <span class="font-bold text-lg">Master Jenis Hewan</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">📋 Menu Jenis Hewan</h2>
            <p class="text-gray-600">Kelola data jenis hewan dalam sistem</p>
        </div>

        <!-- Form Tambah Jenis -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-semibold text-blue-900 mb-4">➕ Tambah Jenis Baru</h3>
            <form method="post" class="flex flex-col md:flex-row gap-4">
                <input type="text" 
                       name="nama_jenis" 
                       placeholder="Nama Jenis Hewan" 
                       required
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                
                <button type="submit" 
                        name="tambah" 
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 whitespace-nowrap">
                    ➕ Tambah Jenis
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
                            <th class="px-4 py-3 text-center font-semibold">Nama Jenis Hewan</th>
                            <th class="px-4 py-3 text-center font-semibold w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium">
                                        <?= $row['idjenis_hewan']; ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-lg text-sm font-semibold">
                                            <?= htmlspecialchars($row['nama_jenis_hewan']); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="?hapus=<?= $row['idjenis_hewan']; ?>" 
                                           onclick="return confirm('Yakin hapus jenis hewan ini?')"
                                           class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            🗑️ Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">📋</div>
                                        <p class="text-lg font-medium">Belum ada data jenis hewan</p>
                                        <p class="text-sm">Silakan tambahkan jenis hewan baru</p>
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