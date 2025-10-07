<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Owner.php';
$db = new DBConnection();
$conn = $db->getConnection();

// ambil pemilik
$pemilikObj = new Pemilik($db);
$allPemilik = $pemilikObj->getAllPemilik();

// ambil jenis & ras (nama kolom sesuai dump SQL)
$allJenis = $conn->query("SELECT idjenis_hewan, nama_jenis_hewan FROM jenis_hewan")->fetchAll(PDO::FETCH_ASSOC);
$allRas = $conn->query("SELECT idras_hewan, nama_ras FROM ras_hewan")->fetchAll(PDO::FETCH_ASSOC);

// notif
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xl">🐾</span>
                <span class="font-bold text-lg">Registrasi Pet</span>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="../Resepsionis_Dashboard.php" class="relative font-medium pb-1 group inline-block">
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
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-blue-900 mb-2">🐾 Registrasi Hewan Peliharaan</h2>
                <p class="text-gray-600">Daftarkan hewan peliharaan baru untuk pemilik yang sudah terdaftar</p>
            </div>

            <!-- Alert Message -->
            <?php if ($msg): ?>
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-900 p-4 mb-6 rounded-lg">
                    <?= $msg ?>
                </div>
            <?php endif; ?>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form method="post" action="../../../Controller/Register_Pet_process.php" class="space-y-6">
                    
                    <!-- Section 1: Data Pemilik -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <span>👤</span>
                            <span>Informasi Pemilik</span>
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Pemilik <span class="text-red-500">*</span>
                            </label>
                            <select name="idpemilik" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">-- Pilih Pemilik --</option>
                                <?php foreach ($allPemilik as $p): ?>
                                    <option value="<?= $p['idpemilik'] ?>">
                                        <?= $p['nama'] ?> (<?= $p['email'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Section 2: Data Pet -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <span>🐶</span>
                            <span>Informasi Pet</span>
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Pet -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Pet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: Max, Luna, Bella" required>
                            </div>

                            <!-- Jenis Hewan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Hewan
                                </label>
                                <select name="idjenis_hewan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Pilih Jenis Hewan (opsional) --</option>
                                    <?php foreach ($allJenis as $j): ?>
                                        <option value="<?= $j['idjenis_hewan'] ?>">
                                            <?= $j['nama_jenis_hewan'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Untuk filter, tidak wajib diisi</p>
                            </div>

                            <!-- Ras Hewan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Ras Hewan <span class="text-red-500">*</span>
                                </label>
                                <select name="idras_hewan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                    <option value="">-- Pilih Ras Hewan --</option>
                                    <?php foreach ($allRas as $r): ?>
                                        <option value="<?= $r['idras_hewan'] ?>">
                                            <?= $r['nama_ras'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Lahir
                                </label>
                                <input type="date" name="tanggal_lahir" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Kelamin
                                </label>
                                <select name="jenis_kelamin" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Pilih --</option>
                                    <option value="J">Jantan</option>
                                    <option value="B">Betina</option>
                                </select>
                            </div>

                            <!-- Warna / Tanda -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Warna / Tanda Khusus
                                </label>
                                <input type="text" name="warna_tanda" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: Putih dengan bercak coklat, hitam belang">
                            </div>
                        </div>
                    </div>

                    <!-- Info Note -->
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                        <p class="text-sm text-green-900">
                            <span class="font-semibold">Info:</span> Pastikan pemilik sudah terdaftar sebelum mendaftarkan pet. Data ras hewan wajib diisi karena berkaitan dengan jenis hewan.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                            ✓ Daftar Pet
                        </button>
                        <a href="../Resepsionis_Dashboard.php" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg text-center transition-colors duration-300">
                            ⬅ Kembali
                        </a>
                    </div>
                </form>
            </div>
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