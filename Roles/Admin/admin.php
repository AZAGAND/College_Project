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
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">🏥</span>
                <span class="font-bold text-lg">Dashboard Admin</span>
            </div>
            
            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span class="font-semibold">Admin</span></span>
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
            <h1 class="text-4xl font-bold mb-3">👋 Selamat Datang, Admin!</h1>
            <p class="text-blue-100 text-lg">Kelola sistem informasi klinik hewan dengan mudah melalui dashboard ini.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1: Users -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">👥</div>
                    <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold">Users</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">247</h3>
                <p class="text-gray-600 text-sm">Total Pengguna</p>
            </div>

            <!-- Card 2: Pets -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">🐾</div>
                    <div class="bg-green-100 text-green-900 px-3 py-1 rounded-full text-sm font-semibold">Pets</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">1,523</h3>
                <p class="text-gray-600 text-sm">Hewan Terdaftar</p>
            </div>

            <!-- Card 3: Doctors -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">👨‍⚕️</div>
                    <div class="bg-purple-100 text-purple-900 px-3 py-1 rounded-full text-sm font-semibold">Doctors</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">42</h3>
                <p class="text-gray-600 text-sm">Dokter Aktif</p>
            </div>

            <!-- Card 4: Treatments -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">💉</div>
                    <div class="bg-red-100 text-red-900 px-3 py-1 rounded-full text-sm font-semibold">Treatments</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">3,891</h3>
                <p class="text-gray-600 text-sm">Total Perawatan</p>
            </div>
        </div>

        <!-- Feature Cards -->
        <h2 class="text-2xl font-bold text-blue-900 mb-6">📊 Menu Utama</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-8">
            <!-- Menu 1: Data Master -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📁</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data Master</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola data master sistem seperti pengguna, hewan, dan dokter.</p>
                    <a href="../../Data_Master/Data_Master.php" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Data Master
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Manajemen pengguna</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Data dokter & perawat</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Database terintegrasi</span>
                    </div>
                </div>
            </div>

            <!-- Menu 2: Pengaturan Sistem -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">⚙️</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Pengaturan Sistem</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Konfigurasi sistem dan preferensi aplikasi.</p>
                    <a href="Feature/Settings.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Buka Pengaturan
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Konfigurasi sistem</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Manajemen akses</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Security settings</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & System Status -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto">
            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">📌 Aktivitas Terbaru</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                        <div class="bg-blue-100 p-2 rounded-full text-xl">🐶</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Hewan baru didaftarkan</h3>
                            <p class="text-sm text-gray-600">Golden Retriever "Max" oleh Dr. Sarah</p>
                            <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                        <div class="bg-green-100 p-2 rounded-full text-xl">✅</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Perawatan selesai</h3>
                            <p class="text-sm text-gray-600">Vaksinasi untuk Persian Cat "Luna"</p>
                            <p class="text-xs text-gray-400 mt-1">4 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                        <div class="bg-purple-100 p-2 rounded-full text-xl">👤</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Pengguna baru terdaftar</h3>
                            <p class="text-sm text-gray-600">John Doe terdaftar sebagai pemilik hewan</p>
                            <p class="text-xs text-gray-400 mt-1">6 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-orange-100 p-2 rounded-full text-xl">📋</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Laporan dibuat</h3>
                            <p class="text-sm text-gray-600">Laporan keuangan bulanan telah dibuat</p>
                            <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">🖥️ Status Sistem</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="text-3xl">✅</div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Database</h3>
                                <p class="text-sm text-gray-600">Koneksi stabil</p>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-green-600">Online</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="text-3xl">🔒</div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Security</h3>
                                <p class="text-sm text-gray-600">Sistem aman</p>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-green-600">Protected</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="text-3xl">⚡</div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Performance</h3>
                                <p class="text-sm text-gray-600">Performa optimal</p>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-green-600">Optimal</span>
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
                        <p class="text-gray-700 leading-relaxed">Pastikan untuk membackup data secara berkala. Monitor aktivitas sistem dan periksa status keamanan secara rutin. Gunakan laporan untuk menganalisis performa klinik hewan Anda.</p>
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