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
<body class="bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👨‍⚕️</span>
                <span class="font-bold text-lg">Dashboard Dokter</span>
            </div>
            
            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span class="font-semibold"><?= $_SESSION['nama'] ?? 'Dokter'; ?></span></span>
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
            <h1 class="text-4xl font-bold mb-3">👨‍⚕️ Selamat Datang, Dokter!</h1>
            <p class="text-blue-100 text-lg">Kelola jadwal konsultasi, rekam medis, dan data pasien dengan sistem terintegrasi.</p>
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

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Menu 1: Jadwal Konsultasi -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📅</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Jadwal Konsultasi</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat dan kelola jadwal konsultasi dengan pasien hewan peliharaan.</p>
                    <a href="Reservasi/Reservasi_Dokter.php" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Buka Jadwal
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Jadwal konsultasi harian</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Detail pasien & pemilik</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Status reservasi real-time</span>
                    </div>
                </div>
            </div>

            <!-- Menu 2: Rekam Medis -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📋</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Rekam Medis</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola dan input rekam medis pasien dengan detail lengkap.</p>
                    <a href="Feature/Rekam_Medis_Dokter.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Rekam Medis
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Input diagnosis & terapi</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Riwayat pemeriksaan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Data medis terintegrasi</span>
                    </div>
                </div>
            </div>

            <!-- Menu 3: Data Pasien -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🐾</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data Pasien</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat informasi lengkap pasien hewan yang Anda tangani.</p>
                    <a href="Data_Pasien/Data_Pasien_Dokter.php" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Lihat Data Pasien
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Profil hewan lengkap</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Informasi pemilik</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Riwayat kunjungan</span>
                    </div>
                </div>
            </div>

            <!-- Menu 4: Riwayat Tindakan -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">💉</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Riwayat Tindakan</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat riwayat tindakan dan terapi yang telah dilakukan.</p>
                    <a href="Riwayat/Riwayat_Tindakan.php" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Lihat Riwayat
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Log tindakan medis</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Detail terapi & obat</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Tracking hasil perawatan</span>
                    </div>
                </div>
            </div>

            <!-- Menu 5: Laporan -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📊</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Laporan</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Lihat laporan dan statistik praktik medis Anda.</p>
                    <a href="Laporan/Laporan_Dokter.php" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Lihat Laporan
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Statistik konsultasi</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Analisis kinerja</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Laporan periodik</span>
                    </div>
                </div>
            </div>

            <!-- Menu 6: Profil -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">👤</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Profil Saya</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola informasi profil dan akun dokter Anda.</p>
                    <a href="Profil/Profil_Dokter.php" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Buka Profil
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Informasi pribadi</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Spesialisasi & keahlian</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Pengaturan akun</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="mt-8 max-w-7xl mx-auto">
            <div class="bg-blue-50 border-l-4 border-blue-900 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">💡</div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Tips Penggunaan</h3>
                        <p class="text-gray-700 leading-relaxed">Periksa jadwal konsultasi Anda setiap hari untuk memastikan tidak ada pasien yang terlewat. Pastikan rekam medis pasien selalu terupdate dengan informasi terkini. Hubungi admin untuk perubahan jadwal praktik atau kendala sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>