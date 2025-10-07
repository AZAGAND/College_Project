<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../Interface/login_RSHP.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👨‍⚕️</span>
                <span class="font-bold text-lg">RSHP Universitas Airlangga - Portal Dokter</span>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Selamat datang, <span
                        class="font-semibold"><?= $_SESSION['nama'] ?? 'Dokter'; ?></span></span>
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
        <!-- Header Dashboard -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-blue-900 mb-2">👨‍⚕️ Dashboard Dokter</h1>
            <p class="text-gray-600 text-lg">Kelola jadwal konsultasi dan rekam medis pasien Anda</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1: Jadwal Hari Ini -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-5xl opacity-80">📅</div>
                    <div class="bg-white bg-opacity-20 rounded-full px-3 py-1 text-sm font-medium">Hari Ini</div>
                </div>
                <h3 class="text-3xl font-bold mb-1">12</h3>
                <p class="text-blue-100">Jadwal Konsultasi</p>
            </div>

            <!-- Card 2: Pasien Menunggu -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-5xl opacity-80">⏳</div>
                    <div class="bg-white bg-opacity-20 rounded-full px-3 py-1 text-sm font-medium">Pending</div>
                </div>
                <h3 class="text-3xl font-bold mb-1">5</h3>
                <p class="text-yellow-100">Pasien Menunggu</p>
            </div>

            <!-- Card 3: Konsultasi Selesai -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-5xl opacity-80">✅</div>
                    <div class="bg-white bg-opacity-20 rounded-full px-3 py-1 text-sm font-medium">Bulan Ini</div>
                </div>
                <h3 class="text-3xl font-bold mb-1">89</h3>
                <p class="text-green-100">Konsultasi Selesai</p>
            </div>

            <!-- Card 4: Rekam Medis -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-5xl opacity-80">📋</div>
                    <div class="bg-white bg-opacity-20 rounded-full px-3 py-1 text-sm font-medium">Total</div>
                </div>
                <h3 class="text-3xl font-bold mb-1">234</h3>
                <p class="text-purple-100">Rekam Medis</p>
            </div>
        </div>

        <!-- Menu Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Menu 1: Jadwal Konsultasi -->
            <a href="Reservasi/Reservasi_Dokter.php" class="group">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform group-hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                        <div class="text-6xl text-white mb-2">📅</div>
                        <h3 class="text-2xl font-bold text-white">Jadwal Konsultasi</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Lihat dan kelola jadwal konsultasi dengan pasien</p>
                        <div class="flex items-center text-blue-600 font-semibold group-hover:gap-3 transition-all">
                            <span>Buka Menu</span>
                            <span class="transform group-hover:translate-x-2 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menu 2: Rekam Medis -->
            <a href="Feature/Rekam_Medis_Dokter.php" class="group">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform group-hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-6">
                        <div class="text-6xl text-white mb-2">📋</div>
                        <h3 class="text-2xl font-bold text-white">Rekam Medis</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kelola dan input rekam medis pasien hewan</p>
                        <div class="flex items-center text-green-600 font-semibold group-hover:gap-3 transition-all">
                            <span>Buka Menu</span>
                            <span class="transform group-hover:translate-x-2 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menu 3: Data Pasien -->
            <a href="Data_Pasien/Data_Pasien_Dokter.php" class="group">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform group-hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                        <div class="text-6xl text-white mb-2">🐾</div>
                        <h3 class="text-2xl font-bold text-white">Data Pasien</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Lihat informasi lengkap pasien hewan peliharaan</p>
                        <div class="flex items-center text-purple-600 font-semibold group-hover:gap-3 transition-all">
                            <span>Buka Menu</span>
                            <span class="transform group-hover:translate-x-2 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menu 4: Riwayat Tindakan -->
            <a href="Riwayat/Riwayat_Tindakan.php" class="group">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform group-hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-6">
                        <div class="text-6xl text-white mb-2">💉</div>
                        <h3 class="text-2xl font-bold text-white">Riwayat Tindakan</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Lihat riwayat tindakan dan terapi yang dilakukan</p>
                        <div class="flex items-center text-orange-600 font-semibold group-hover:gap-3 transition-all">
                            <span>Buka Menu</span>
                            <span class="transform group-hover:translate-x-2 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menu 5: Laporan -->
            <a href="Laporan/Laporan_Dokter.php" class="group">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform group-hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 p-6">
                        <div class="text-6xl text-white mb-2">📊</div>
                        <h3 class="text-2xl font-bold text-white">Laporan</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Lihat laporan dan statistik praktik medis</p>
                        <div class="flex items-center text-red-600 font-semibold group-hover:gap-3 transition-all">
                            <span>Buka Menu</span>
                            <span class="transform group-hover:translate-x-2 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Menu 6: Profil -->
            <a href="Profil/Profil_Dokter.php" class="group">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform group-hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-gray-500 to-gray-600 p-6">
                        <div class="text-6xl text-white mb-2">👤</div>
                        <h3 class="text-2xl font-bold text-white">Profil Saya</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kelola informasi profil dan akun dokter</p>
                        <div class="flex items-center text-gray-600 font-semibold group-hover:gap-3 transition-all">
                            <span>Buka Menu</span>
                            <span class="transform group-hover:translate-x-2 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Quick Info Section -->
        <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <div class="flex items-start">
                <div class="text-3xl mr-4">ℹ️</div>
                <div>
                    <h4 class="text-lg font-semibold text-blue-900 mb-2">Informasi Penting</h4>
                    <ul class="text-gray-700 space-y-1">
                        <li>• Periksa jadwal konsultasi Anda setiap hari</li>
                        <li>• Pastikan rekam medis pasien selalu terupdate</li>
                        <li>• Hubungi admin untuk perubahan jadwal praktik</li>
                    </ul>
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