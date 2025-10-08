<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Temu_Dokter.php';

$db = new DBConnection();
$temuObj = new TemuDokter($db);
$data = $temuObj->getAll();

$Listdokter = $temuObj->getAllDokter();
$pemilikList = $temuObj->getAllPemilik();
$allPetList = $temuObj->getPetByPemilik($idpemilik ?? null);

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Temu Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xl">📋</span>
                <span class="font-bold text-lg">Manajemen Temu Dokter</span>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="../Resepsionis_dashboard.php" class="relative font-medium pb-1 group inline-block">
                    Home
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 flex-grow">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-blue-900 mb-2">👨‍⚕️ Manajemen Temu Dokter</h2>
            <p class="text-gray-600">Kelola jadwal dan pendaftaran temu dengan dokter</p>
        </div>

        <!-- Alert Message -->
        <?php if ($msg): ?>
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-900 p-4 mb-6 rounded-lg">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Temu Dokter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span>➕</span>
                <span>Tambah Jadwal Temu Dokter</span>
            </h3>
            <form method="POST" action="../../../Controller/Temu_Dokter_Process.php">
                <input type="hidden" name="action" value="create">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemilik</label>
                        <select name="idpemilik" id="idpemilik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">-- Pilih Pemilik --</option>
                            <?php foreach ($pemilikList as $p): ?>
                                <option value="<?= $p['idpemilik'] ?>">
                                    <?= htmlspecialchars($p['nama_pemilik']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pet</label>
                        <select name="idpet" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">-- Pilih Pet (Pemilik) --</option>
                            <?php foreach ($allPetList as $pet): ?>
                                <option value="<?= $pet['idpet'] ?>">
                                    <?= htmlspecialchars($pet['nama_pemilik']) ?> - <?= htmlspecialchars($pet['nama_pet']) ?>
                                    (<?= htmlspecialchars($pet['jenis_hewan']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dokter</label>
                        <select name="iddokter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">-- Pilih Dokter --</option>
                            <?php foreach ($Listdokter as $d): ?>
                                <option value="<?= $d['idrole_user'] ?>">
                                    <?= htmlspecialchars($d['nama_dokter']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                    ✓ Tambah Jadwal Temu
                </button>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h3 class="text-lg font-bold">📋 Data Temu Dokter</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold">No</th>
                            <th class="px-4 py-3 text-center font-semibold">No Reservasi</th>
                            <th class="px-4 py-3 text-center font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-center font-semibold">Nama Pet</th>
                            <th class="px-4 py-3 text-center font-semibold">Jenis Hewan</th>
                            <th class="px-4 py-3 text-center font-semibold">Pemilik</th>
                            <th class="px-4 py-3 text-center font-semibold">Dokter</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if ($data):
                            $no = 1;
                            foreach ($data as $row): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center text-gray-900 font-medium"><?= $no++ ?></td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-block bg-gray-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            <?= $row['no_urut'] ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700">
                                        <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="font-medium text-blue-900"><?= $row['nama_pet'] ?></span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <?= $row['jenis_hewan'] ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-700"><?= $row['nama_pemilik'] ?></td>
                                    <td class="px-4 py-4 text-center text-gray-700"><?= $row['nama_dokter'] ?></td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Form Delete -->
                                            <form method="post" action="../../../Controller/Temu_Dokter_Process.php" class="inline-block">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="no_temu" value="<?= $row['no_urut'] ?>">
                                                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors" onclick="return confirm('Yakin hapus jadwal ini?')">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="text-5xl mb-3">📭</div>
                                            <p class="text-lg font-medium">Belum ada data temu dokter</p>
                                            <p class="text-sm">Tambahkan jadwal baru menggunakan form di atas</p>
                                        </div>
                                    </td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer Card -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <a href="../Resepsionis_dashboard.php" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                    ⬅ Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>