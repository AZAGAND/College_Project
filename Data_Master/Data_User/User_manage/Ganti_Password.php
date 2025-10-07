<?php
session_start();
// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$iduser_target = $_GET['id'] ?? null;
if (!$iduser_target)
    die("ID user tidak ditemukan!");

// Ambil notif jika ada
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">🔒</span>
                <span class="font-bold text-lg">Ganti Password</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">🔒 Ganti Password User</h2>
            <p class="text-gray-600">Ubah password untuk keamanan akun</p>
            <p class="text-sm text-gray-500 mt-1">User ID: <span class="font-semibold"><?= htmlspecialchars($iduser_target) ?></span></p>
        </div>

        <!-- Success Message -->
        <?php if ($success): ?>
            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">✅</span>
                        <p class="font-medium"><?= htmlspecialchars($success) ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if ($error): ?>
            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">❌</span>
                        <p class="font-medium"><?= htmlspecialchars($error) ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-blue-900 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Form Ganti Password</h3>
                </div>
                
                <form method="post" action="/PHP_Native_Web_OOP-Modul4/Controller/Ganti_Password_Process.php" class="p-6">
                    <input type="hidden" name="iduser" value="<?= htmlspecialchars($iduser_target) ?>">
                    <input type="hidden" name="redirect_to" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '../../Data_User.php') ?>">

                    <div class="space-y-6">
                        <!-- Password Baru -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Password Baru <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                    name="password_baru" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="Masukkan password baru"
                                    required>
                            <p class="text-sm text-gray-500 mt-1">Minimal 6 karakter, gunakan kombinasi huruf, angka, dan simbol</p>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Ulangi Password Baru <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                    name="retype_password" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="Ketik ulang password baru"
                                    required>
                            <p class="text-sm text-gray-500 mt-1">Pastikan password sama dengan yang di atas</p>
                        </div>

                        <!-- Security Info Box -->
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                            <div class="flex items-start">
                                <span class="text-2xl mr-3">🔐</span>
                                <div>
                                    <h4 class="font-semibold text-blue-900 mb-2">Tips Password yang Kuat:</h4>
                                    <ul class="text-sm text-gray-700 space-y-1">
                                        <li>• Gunakan minimal 8 karakter</li>
                                        <li>• Kombinasikan huruf besar dan kecil (A-Z, a-z)</li>
                                        <li>• Tambahkan angka (0-9)</li>
                                        <li>• Sertakan simbol khusus (!@#$%^&*)</li>
                                        <li>• Hindari kata-kata umum atau informasi pribadi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Warning Box -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <div class="flex items-start">
                                <span class="text-2xl mr-3">⚠️</span>
                                <div>
                                    <p class="text-sm text-gray-700">
                                        <strong>Perhatian:</strong> Setelah password diubah, user harus login kembali menggunakan password baru. 
                                        Pastikan user mengetahui password baru mereka.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" 
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                🔒 Ubah Password
                            </button>
                            <a href="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '../../Data_User.php') ?>" 
                                class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                ← Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Additional Security Info -->
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">🛡️ Keamanan Akun</h4>
                <div class="space-y-3 text-sm text-gray-700">
                    <div class="flex items-start gap-3">
                        <span class="text-green-600 font-bold">✓</span>
                        <p>Password akan dienkripsi secara otomatis</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-green-600 font-bold">✓</span>
                        <p>Sistem akan memvalidasi kesesuaian password</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-green-600 font-bold">✓</span>
                        <p>User harus logout dan login ulang setelah perubahan</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-green-600 font-bold">✓</span>
                        <p>Riwayat perubahan password tersimpan di log sistem</p>
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