<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Pemilik') {
    header("Location: ../../Views/login_RSHP.php");
    exit;
}

$nama = $_SESSION['nama'] ?? 'Pemilik';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">🐕</span>
                <span class="font-bold text-lg">Dashboard Pemilik</span>
            </div>
            
            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span class="font-semibold"><?= htmlspecialchars($nama) ?></span></span>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-4xl font-bold mb-3">🐾 Selamat Datang, <?= htmlspecialchars($nama) ?>!</h1>
            <p class="text-blue-100 text-lg">Lihat dan kelola informasi hewan peliharaanmu dengan mudah melalui dashboard ini.</p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Menu Hewan Saya -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🐶</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Hewan Saya</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat dan kelola daftar hewan peliharaan yang kamu miliki dengan lengkap.</p>
                    <a href="Feature/List_Hewan.php" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Lihat Hewan Saya
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Data lengkap hewan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Informasi kesehatan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Riwayat perawatan</span>
                    </div>
                </div>
            </div>

            <!-- Menu Reservasi Saya -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📅</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Reservasi Saya</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat jadwal temu dokter dan kelola reservasi untuk hewan peliharaanmu.</p>
                    <a href="Feature/List_Reservasi.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Lihat Reservasi
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Jadwal konsultasi</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Status reservasi</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Detail dokter & waktu</span>
                    </div>
                </div>
            </div>

            <!-- Menu Rekam Medis Saya -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🩺</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Rekam Medis Saya</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat hasil pemeriksaan dan riwayat tindakan medis dari dokter.</p>
                    <a href="Feature/List_Rekam_Medis.php" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Lihat Rekam Medis
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Hasil pemeriksaan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Diagnosis & tindakan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Riwayat lengkap</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="mt-8 max-w-6xl mx-auto">
            <div class="bg-blue-50 border-l-4 border-blue-900 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">💡</div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Tips Penggunaan</h3>
                        <p class="text-gray-700 leading-relaxed">Periksa jadwal reservasi secara berkala dan pastikan hewan peliharaan Anda siap untuk konsultasi. Rekam medis dapat diakses kapan saja untuk memantau kesehatan hewan kesayangan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga — Sistem Informasi Klinik Hewan. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>