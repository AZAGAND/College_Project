<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Rekam_Medis.php';
require_once __DIR__ . '/../../../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);
$detailObj = new RekamMedisDetail($db);

$allRekam = $rekamObj->getAll();
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis (Perawat)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center">
            <div class="flex-1 flex justify-center items-center">
                <a href="../Perawat_Dashboard.php" class="relative font-medium pb-1 group inline-block">
                    Home
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
            <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block ml-auto">
                Logout
                <span
                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 flex-grow">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-blue-900 mb-2">📋 Manajemen Rekam Medis</h2>
            <p class="text-gray-600">Kelola rekam medis pasien dan detail tindakan terapi</p>
        </div>

        <!-- Alert Message -->
        <?php if ($msg): ?>
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-900 p-4 mb-6 rounded-lg">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Rekam Medis -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">➕ Tambah Rekam Medis Baru</h3>
            <form method="post" action="../../Controller/Rekam_Medis_Process.php">
                <input type="hidden" name="action" value="create">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ID Reservasi</label>
                        <input type="number" name="idreservasi"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan ID Reservasi" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Diagnosa</label>
                        <input type="text" name="diagnosa"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Diagnosa penyakit" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <input type="text" name="catatan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Catatan tambahan">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-300">
                            Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Rekam Medis -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">ID</th>
                            <th class="px-4 py-3 text-left font-semibold">Reservasi</th>
                            <th class="px-4 py-3 text-left font-semibold">Pemilik</th>
                            <th class="px-4 py-3 text-left font-semibold">Pet</th>
                            <th class="px-4 py-3 text-left font-semibold">Diagnosa</th>
                            <th class="px-4 py-3 text-left font-semibold">Catatan</th>
                            <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold">Detail Tindakan</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($allRekam as $row): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-900 font-medium"><?= $row['idrekam_medis'] ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= $row['idreservasi'] ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= $row['nama_pemilik'] ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= $row['nama_pet'] ?></td>
                                <td class="px-4 py-4">
                                    <span
                                        class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= $row['diagnosa'] ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-gray-700"><?= $row['catatan'] ?></td>
                                <td class="px-4 py-4 text-gray-700"><?= $row['tanggal'] ?></td>
                                <td class="px-4 py-4">
                                    <?php $details = $detailObj->getByRekamMedis($row['idrekam_medis']); ?>

                                    <!-- Daftar Detail -->
                                    <?php if (count($details) > 0): ?>
                                        <div class="mb-3">
                                            <ul class="space-y-1 text-sm">
                                                <?php foreach ($details as $d): ?>
                                                    <li class="text-gray-700">
                                                        <span class="font-medium text-blue-900"><?= $d['kode'] ?></span> -
                                                        <?= $d['deskripsi_tindakan_terapi'] ?>
                                                        <span class="text-green-600 font-medium">(<?= $d['hasil'] ?>)</span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Form Tambah Detail -->
                                    <div class="bg-gray-50 p-3 rounded-lg mt-2">
                                        <p class="text-xs font-medium text-gray-700 mb-2">Tambah Detail:</p>
                                        <form method="post" action="../../Controller/RekamMedis_Process.php"
                                            class="space-y-2">
                                            <input type="hidden" name="action" value="add_detail">
                                            <input type="hidden" name="idrekam_medis" value="<?= $row['idrekam_medis'] ?>">
                                            <input type="number" name="idtindakan" placeholder="ID Tindakan"
                                                class="w-full px-3 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"
                                                required>
                                            <input type="text" name="hasil" placeholder="Hasil"
                                                class="w-full px-3 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500"
                                                required>
                                            <button type="submit"
                                                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-3 py-1 rounded transition-colors">
                                                + Tambah Detail
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <form method="post" action="../../Controller/RekamMedis_Process.php"
                                        onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?')"
                                        class="inline-block">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="idrekam_medis" value="<?= $row['idrekam_medis'] ?>">
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-300">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="../Perawat_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2024 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>