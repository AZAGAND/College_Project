<?php
session_start();

require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Role.php';

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
$roleObj = new Role($db);

$allUsers = $roleObj->getAllUsers();
$allRoles = $roleObj->getAllRoles();

// Ambil notif dari session
$msg = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Role ke User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👥</span>
                <span class="font-bold text-lg">Tambah Role ke User</span>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span
                        class="font-semibold"><?= $_SESSION['nama'] ?? 'Admin'; ?></span></span>
                <a href="../../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">👥 Tambah Role ke User</h2>
            <p class="text-gray-600">Assign role baru untuk pengguna yang sudah terdaftar</p>
        </div>

        <!-- Alert Message -->
        <?php if (!empty($msg)): ?>
            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">ℹ️</span>
                        <p class="font-medium"><?= htmlspecialchars($msg); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-blue-900 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Form Assignment Role</h3>
                </div>
                
                <form method="post" action="../../../Controller/Tambah_Role_proces.php" class="p-6">
                    <div class="space-y-6">
                        <!-- Pilih User -->
                        <div>
                            <label for="iduser" class="block text-gray-700 font-semibold mb-2">
                                Pilih User <span class="text-red-500">*</span>
                            </label>
                            <select name="iduser" 
                                    id="iduser" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    required>
                                <option value="">-- Pilih User --</option>
                                <?php foreach ($allUsers as $u): ?>
                                    <option value="<?= $u['iduser'] ?>">
                                        <?= htmlspecialchars($u['nama']) ?> (<?= htmlspecialchars($u['email']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Pilih user yang akan diberikan role</p>
                        </div>

                        <!-- Pilih Role -->
                        <div>
                            <label for="idrole" class="block text-gray-700 font-semibold mb-2">
                                Pilih Role <span class="text-red-500">*</span>
                            </label>
                            <select name="idrole" 
                                    id="idrole" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    required>
                                <option value="">-- Pilih Role --</option>
                                <?php foreach ($allRoles as $r): ?>
                                    <option value="<?= $r['idrole'] ?>">
                                        <?= htmlspecialchars($r['nama_role']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Tentukan hak akses yang akan diberikan</p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <div class="flex items-start">
                                <span class="text-2xl mr-3">⚠️</span>
                                <div>
                                    <p class="text-sm text-gray-700">
                                        <strong>Perhatian:</strong> Pastikan Anda memberikan role yang sesuai dengan tanggung jawab user. 
                                        Satu user dapat memiliki lebih dari satu role.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-4">
                            <button type="submit" 
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                ✓ Tambah Role
                            </button>
                            <a href="../../../Data_Master/Role_Management/role_management.php" 
                                class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                ← Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Role Information Card -->
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">📌 Informasi Role</h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="text-blue-600 font-bold">•</span>
                        <p class="text-gray-700 text-sm">
                            <strong>Admin:</strong> Memiliki akses penuh ke seluruh sistem
                        </p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-green-600 font-bold">•</span>
                        <p class="text-gray-700 text-sm">
                            <strong>Dokter:</strong> Dapat mengelola rekam medis dan konsultasi
                        </p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-purple-600 font-bold">•</span>
                        <p class="text-gray-700 text-sm">
                            <strong>Perawat:</strong> Dapat mengelola jadwal dan data pasien
                        </p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-orange-600 font-bold">•</span>
                        <p class="text-gray-700 text-sm">
                            <strong>Pemilik:</strong> Dapat melihat data hewan peliharaan sendiri
                        </p>
                    </div>
                </div>
            </div>
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