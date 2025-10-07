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

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">➕</span>
                <span class="font-bold text-lg">Tambah User Baru</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">➕ Tambah User Baru</h2>
            <p class="text-gray-600">Buat akun pengguna baru untuk sistem</p>
        </div>

        <!-- Alert Notification -->
        <?php if (!empty($notif)): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg shadow">
                <div class="flex items-center">
                    <span class="text-2xl mr-3">ℹ️</span>
                    <p class="font-medium"><?= htmlspecialchars($notif); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-blue-900 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Form Registrasi User</h3>
                </div>
                
                <form method="post" action="../../Controller/tambah_user_process.php" class="p-6">
                    <div class="space-y-6">
                        <!-- Nama -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                    name="nama" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="Masukkan nama lengkap"
                                    required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                    name="email" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="contoh@email.com"
                                    required>
                            <p class="text-sm text-gray-500 mt-1">Gunakan email yang valid dan aktif</p>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                    name="password" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="Minimal 6 karakter"
                                    required>
                            <p class="text-sm text-gray-500 mt-1">Gunakan kombinasi huruf, angka, dan simbol</p>
                        </div>

                        <!-- Retype Password -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                    name="retype" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                    placeholder="Ketik ulang password"
                                    required>
                            <p class="text-sm text-gray-500 mt-1">Pastikan password sama dengan di atas</p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <div class="flex items-start">
                                <span class="text-2xl mr-3">⚠️</span>
                                <div>
                                    <p class="text-sm text-gray-700">
                                        <strong>Catatan:</strong> Pastikan semua data diisi dengan benar. 
                                        Password tidak dapat dilihat setelah disimpan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-4">
                            <button type="submit" 
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                💾 Simpan User
                            </button>
                            <a href="data_user.php" 
                                class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                ← Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="max-w-2xl mx-auto mt-6">
            <div class="bg-blue-50 rounded-lg p-4">
                <h4 class="font-semibold text-blue-900 mb-2">Tips Keamanan Password:</h4>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>• Gunakan minimal 8 karakter</li>
                    <li>• Kombinasikan huruf besar dan kecil</li>
                    <li>• Tambahkan angka dan simbol khusus</li>
                    <li>• Hindari menggunakan informasi pribadi</li>
                    <li>• Jangan gunakan password yang sama dengan akun lain</li>
                </ul>
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