<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Kode_Tindakan_Terapi.php';

$db = new DBConnection();
$tindakanObj = new Kode_Tindakan_Terapi($db);
$allTindakan = $tindakanObj->getAll();

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kode Tindakan Terapi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">💉</span>
                <span class="font-bold text-lg">Data Kode Tindakan Terapi</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">💉 Data Kode Tindakan Terapi</h2>
            <p class="text-gray-600">Kelola kode dan deskripsi tindakan terapi klinis</p>
        </div>

        <!-- Alert Message -->
        <?php if ($msg): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg shadow">
                <p class="font-medium"><?= htmlspecialchars($msg) ?></p>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Tindakan -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-semibold text-blue-900 mb-4">➕ Tambah Kode Tindakan Baru</h3>
            <form method="post" action="../../../Controller/Kode_Tindakan_Process.php">
                <input type="hidden" name="action" value="create">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">Kode</label>
                        <input type="text" name="kode"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Kode" required>
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                        <input type="text" name="deskripsi_tindakan_terapi"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Deskripsi tindakan" required>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-gray-700 font-medium mb-2">Kategori Klinis</label>
                        <select name="idkategori_klinis"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="1">Terapi</option>
                            <option value="2">Tindakan</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 flex items-end">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                            ➕ Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold w-20">ID</th>
                            <th class="px-4 py-3 text-center font-semibold w-24">Kode</th>
                            <th class="px-4 py-3 text-center font-semibold">Deskripsi</th>
                            <th class="px-4 py-3 text-center font-semibold w-40">Kategori Klinis</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($allTindakan)): ?>
                            <?php foreach ($allTindakan as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium">
                                        <?= htmlspecialchars($row['idkode_tindakan_terapi']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span
                                            class="inline-block bg-purple-100 text-purple-800 px-3 py-1 rounded-lg text-sm font-bold">
                                            <?= htmlspecialchars($row['kode']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700">
                                        <?= htmlspecialchars($row['deskripsi_tindakan_terapi']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <?php if ($row['nama_kategori_klinis'] == 'Terapi'): ?>
                                            <span
                                                class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                💊 Terapi
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                🏥 Tindakan
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2 flex-wrap">
                                            <!-- Form Update -->
                                            <form method="post" action="../../../Controller/Kode_Tindakan_Process.php"
                                                class="flex items-center gap-2 flex-wrap">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="idkode_tindakan_terapi"
                                                    value="<?= $row['idkode_tindakan_terapi'] ?>">

                                                <input type="text" name="kode" value="<?= htmlspecialchars($row['kode']) ?>"
                                                    class="w-16 px-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    placeholder="Kode" required>
                                                <input type="text" name="deskripsi_tindakan_terapi"
                                                    value="<?= htmlspecialchars($row['deskripsi_tindakan_terapi']) ?>"
                                                    class="w-32 px-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    placeholder="Deskripsi" required>
                                                <select name="idkategori_klinis"
                                                    class="px-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    required>
                                                    <option value="1" <?= $row['nama_kategori_klinis'] == 'Terapi' ? 'selected' : '' ?>>Terapi</option>
                                                    <option value="2" <?= $row['nama_kategori_klinis'] == 'Tindakan' ? 'selected' : '' ?>>Tindakan</option>
                                                </select>
                                                <button type="submit"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm font-medium transition-colors whitespace-nowrap">
                                                    ✏️ Update
                                                </button>
                                            </form>

                                            <!-- Form Delete -->
                                            <form method="post" action="../../../Controller/Kode_Tindakan_Process.php"
                                                onsubmit="return confirm('Yakin hapus tindakan ini?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="idkode_tindakan_terapi"
                                                    value="<?= $row['idkode_tindakan_terapi'] ?>">
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-medium transition-colors whitespace-nowrap">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">💉</div>
                                        <p class="text-lg font-medium">Belum ada data kode tindakan terapi</p>
                                        <p class="text-sm">Silakan tambahkan kode tindakan baru</p>
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