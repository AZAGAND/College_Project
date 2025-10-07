<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Dokter.php';

$db = new DBConnection();
$dokterObj = new Dokter($db);
$data = $dokterObj->getAll();

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👨‍⚕️</span>
                <span class="font-bold text-lg">Manajemen Dokter</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">👨‍⚕️ Daftar Dokter</h2>
            <p class="text-gray-600">Kelola data dokter dalam sistem</p>
        </div>

        <!-- Alert Message -->
        <?php if ($msg): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg shadow">
                <p class="font-medium"><?= htmlspecialchars($msg) ?></p>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Dokter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-semibold text-blue-900 mb-4">➕ Tambah Dokter Baru</h3>
            <form action="../../../Controller/Data_Dokter_Process.php" method="post">
                <input type="hidden" name="action" value="create">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Nama Dokter</label>
                        <input type="text" 
                               name="nama" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               placeholder="Masukkan nama dokter"
                               required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               placeholder="dokter@example.com"
                               required>
                    </div>
                </div>
                
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                    ➕ Tambah Dokter
                </button>
            </form>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-blue-900 text-white px-6 py-4">
                <h3 class="text-lg font-semibold">Data Dokter</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b-2 border-gray-300">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 w-16">No</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Nama</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 w-32">Status</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($data)): ?>
                            <?php $no = 1; foreach ($data as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium">
                                        <?= $no++ ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-gray-900 font-semibold">
                                            <?= htmlspecialchars($row['nama']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="mailto:<?= htmlspecialchars($row['email']) ?>" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            <?= htmlspecialchars($row['email']) ?>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <?php if ($row['status']): ?>
                                            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                ✓ Aktif
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                                ✗ Nonaktif
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <form action="../../../Controller/Data_Dokter_Process.php" method="post" class="inline-block">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="idrole_user" value="<?= $row['idrole_user'] ?>">
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors"
                                                    onclick="return confirm('Yakin hapus dokter ini?')">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">👨‍⚕️</div>
                                        <p class="text-lg font-medium">Belum ada data dokter</p>
                                        <p class="text-sm">Silakan tambahkan dokter baru</p>
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