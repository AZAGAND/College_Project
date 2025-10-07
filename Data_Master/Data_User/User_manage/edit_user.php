<?php
session_start();
require_once __DIR__ . '/../../../Class/User.php';
require_once __DIR__ . '/../../../DB/dbconnection.php';

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
$userObj = new User($db);

$id = $_GET['id'] ?? null;
if (!$id)
    die("ID user tidak ditemukan");

$user = $userObj->getUserById($id);
if (!$user)
    die("User tidak ditemukan");

// Ambil session notif
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">✏️</span>
                <span class="font-bold text-lg">Edit User</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">✏️ Edit User</h2>
            <p class="text-gray-600">Ubah informasi data pengguna</p>
        </div>

        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-blue-900 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Form Edit User</h3>
                </div>
                
                <form method="post" action="/PHP_Native_Web_OOP-Modul4/Controller/edit_user_process.php" class="p-6">
                    <input type="hidden" name="iduser" value="<?= htmlspecialchars($user['iduser']); ?>">

                    <div class="space-y-6">
                        <!-- User ID Display -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                User ID
                            </label>
                            <div class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                                <?= htmlspecialchars($user['iduser']); ?>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">ID user tidak dapat diubah</p>
                        </div>

                        <!-- Nama User -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Nama User <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                    name="nama" 
                                    value="<?= htmlspecialchars($user['nama']); ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="Masukkan nama lengkap"
                                    required>
                            <p class="text-sm text-gray-500 mt-1">Nama akan ditampilkan di sistem</p>
                        </div>

                        <!-- Email Display (Optional) -->
                        <?php if (isset($user['email'])): ?>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Email
                            </label>
                            <div class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                                <?= htmlspecialchars($user['email']); ?>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Email tidak dapat diubah melalui form ini</p>
                        </div>
                        <?php endif; ?>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                            <div class="flex items-start">
                                <span class="text-2xl mr-3">ℹ️</span>
                                <div>
                                    <p class="text-sm text-gray-700">
                                        <strong>Catatan:</strong> Perubahan nama akan segera berlaku setelah disimpan. 
                                        Untuk mengubah password atau email, silakan gunakan menu khusus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" 
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                💾 Simpan Perubahan
                            </button>
                            <a href="../data_user.php" 
                                class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                ← Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Additional Actions Card -->
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">🔧 Aksi Lainnya</h4>
                <div class="space-y-3">
                    <a href="../Ganti_Password/ganti_password.php?iduser=<?= htmlspecialchars($user['iduser']); ?>" 
                        class="flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🔒</span>
                            <div>
                                <p class="font-semibold text-gray-900">Ganti Password</p>
                                <p class="text-sm text-gray-600">Ubah password user ini</p>
                            </div>
                        </div>
                        <span class="text-gray-400 group-hover:text-gray-600 transition-colors">→</span>
                    </a>

                    <a href="../Role_Management/role_management.php" 
                        class="flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">👥</span>
                            <div>
                                <p class="font-semibold text-gray-900">Kelola Role</p>
                                <p class="text-sm text-gray-600">Atur hak akses user</p>
                            </div>
                        </div>
                        <span class="text-gray-400 group-hover:text-gray-600 transition-colors">→</span>
                    </a>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">⚠️</span>
                    <div>
                        <h4 class="font-semibold text-yellow-900 mb-1">Perhatian</h4>
                        <p class="text-sm text-gray-700">
                            Pastikan nama yang dimasukkan benar dan sesuai. Perubahan akan langsung terlihat 
                            di semua bagian sistem yang menampilkan nama user ini.
                        </p>
                    </div>
                </div>
            </div>
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