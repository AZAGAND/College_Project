<?php
require_once(__DIR__ . '/../../../DB/DBconnection.php');
require_once(__DIR__ . '/../../../Class/Reservasi.php');

$db = (new DBconnection())->getConnection();
$reservasi = new Reservasi($db);

$data = $reservasi->getAll();
$hewan = $reservasi->getAllHewan();
$dokter = $reservasi->getAllDokter();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">📅</span>
                <span class="font-bold text-lg">Menu Reservasi Dokter (Perawat)</span>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span
                        class="font-semibold"><?= $_SESSION['nama'] ?? 'Perawat'; ?></span></span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">📋 Daftar Reservasi Dokter</h2>
            <p class="text-gray-600">Kelola dan update status reservasi pasien dengan mudah</p>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold">No</th>
                            <th class="px-4 py-3 text-center font-semibold">No Temu</th>
                            <th class="px-4 py-3 text-center font-semibold">Nama Hewan</th>
                            <th class="px-4 py-3 text-center font-semibold">Dokter</th>
                            <th class="px-4 py-3 text-center font-semibold">Status</th>
                            <th class="px-4 py-3 text-center font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($data)): ?>
                            <?php $no = 1;
                            foreach ($data as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium"><?= $no++ ?></td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-block bg-gray-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            <?= htmlspecialchars($row['no_urut']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700 font-medium">
                                        <?= htmlspecialchars($row['nama_pet']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700">
                                        <?= htmlspecialchars($row['nama_dokter']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <?php
                                        $statusClass = [
                                            'P' => 'bg-yellow-100 text-yellow-800',
                                            'S' => 'bg-green-100 text-green-800',
                                            'D' => 'bg-red-100 text-red-800'
                                        ];
                                        $statusText = [
                                            'P' => 'Pending',
                                            'S' => 'Selesai',
                                            'D' => 'Dibatalkan'
                                        ];
                                        ?>
                                        <span class="inline-block <?= $statusClass[$row['status']] ?? 'bg-gray-100 text-gray-800' ?> px-3 py-1 rounded-full text-sm font-medium">
                                            <?= $statusText[$row['status']] ?? 'Unknown' ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700">
                                        <?= htmlspecialchars($row['tanggal']) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Form Update Status -->
                                            <form method="POST" action="/PHP_Native_Web_OOP-Modul4/Controller/Reservasi_Process.php" class="flex items-center gap-2">
                                                <input type="hidden" name="idreservasi_dokter" value="<?= $row['idreservasi_dokter'] ?>">
                                                <select name="status" class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    <option value="P" <?= $row['status'] == 'P' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="S" <?= $row['status'] == 'S' ? 'selected' : '' ?>>Selesai</option>
                                                    <option value="D" <?= $row['status'] == 'D' ? 'selected' : '' ?>>Dibatalkan</option>
                                                </select>
                                                <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                                    ↻ Update
                                                </button>
                                            </form>

                                            <!-- Form Delete -->
                                            <form method="POST" action="/PHP_Native_Web_OOP-Modul4/Controller/Reservasi_Process.php">
                                                <input type="hidden" name="idreservasi_dokter" value="<?= $row['idreservasi_dokter'] ?>">
                                                <button type="submit" name="delete" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors" onclick="return confirm('Yakin hapus reservasi ini?')">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">📭</div>
                                        <p class="text-lg font-medium">Belum ada data reservasi</p>
                                        <p class="text-sm">Data reservasi akan muncul di sini</p>
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
            <a href="../Perawat_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Dashboard
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
