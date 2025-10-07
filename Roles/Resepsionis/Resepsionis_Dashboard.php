<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/Owner.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Resepsionis') {
    header("Location: ../../Views/Auth/login_RSHP.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Resepsionis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">📋</span>
                <span class="font-bold text-lg">Dashboard Resepsionis</span>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span
                        class="font-semibold"><?= $_SESSION['nama'] ?? 'Resepsionis'; ?></span></span>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-4xl font-bold mb-3">👋 Selamat Datang, Resepsionis!</h1>
            <p class="text-blue-100 text-lg">Kelola registrasi pemilik, pet, dan jadwal temu dokter dengan mudah.</p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card Registrasi -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-green-600 text-white px-6 py-4">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <span>✏️</span>
                        <span>Registrasi</span>
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Daftarkan pemilik dan hewan peliharaan baru ke sistem</p>
                    <div class="space-y-3">
                        <a href="Feature/registrasi_Pemilik.php"
                            class="block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md">
                            ➕ Registrasi Pemilik
                        </a>
                        <a href="Feature/registrasi_pet.php"
                            class="block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md">
                            ➕ Registrasi Pet
                        </a>
                    </div>
                </div>

                <!-- Info tambahan -->
                <div class="px-6 pb-6">
                    <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded">
                        <div class="flex items-start gap-2">
                            <span class="text-green-600 font-bold">ℹ️</span>
                            <p class="text-sm text-gray-700">Mulai dengan registrasi pemilik, kemudian tambahkan data
                                pet mereka</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Temu Dokter -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-cyan-600 text-white px-6 py-4">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <span>🩺</span>
                        <span>Temu Dokter</span>
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Kelola jadwal dan pendaftaran temu dengan dokter</p>
                    <a href="Feature/temu_dokter.php"
                        class="block bg-cyan-600 hover:bg-cyan-700 text-white text-center font-semibold px-6 py-3 rounded-lg transition-colors duration-300 shadow-md">
                        📅 Daftar Temu Dokter
                    </a>
                </div>

                <!-- Info tambahan -->
                <div class="px-6 pb-6">
                    <div class="bg-cyan-50 border-l-4 border-cyan-600 p-4 rounded">
                        <div class="flex items-start gap-2">
                            <span class="text-cyan-600 font-bold">ℹ️</span>
                            <p class="text-sm text-gray-700">Buat jadwal temu pasien dengan dokter yang tersedia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Informasi -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="bg-yellow-500 text-gray-900 px-6 py-4">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <span>💡</span>
                        <span>Panduan</span>
                    </h2>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-800 mb-3">Alur Kerja:</h3>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white rounded-full text-sm font-bold flex-shrink-0">1</span>
                            <p class="text-gray-700 text-sm">Registrasi pemilik baru beserta informasi lengkapnya</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white rounded-full text-sm font-bold flex-shrink-0">2</span>
                            <p class="text-gray-700 text-sm">Daftarkan hewan peliharaan milik pemilik tersebut</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span
                                class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white rounded-full text-sm font-bold flex-shrink-0">3</span>
                            <p class="text-gray-700 text-sm">Buat jadwal temu dokter sesuai kebutuhan pasien</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Info -->
                <div class="px-6 pb-6">
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <h4 class="font-bold text-gray-800 mb-3 text-sm">Quick Stats</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Pemilik Terdaftar:</span>
                                <span class="font-bold text-gray-900">-</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Pet Terdaftar:</span>
                                <span class="font-bold text-gray-900">-</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Jadwal Hari Ini:</span>
                                <span class="font-bold text-gray-900">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Tips -->
        <div class="mt-8">
            <div class="bg-blue-50 border-l-4 border-blue-900 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="text-3xl">📌</div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Tips Penting</h3>
                        <p class="text-gray-700 leading-relaxed">Pastikan data pemilik dan pet sudah terdaftar sebelum
                            membuat jadwal temu dokter. Verifikasi kembali informasi yang diinput untuk menghindari
                            kesalahan data.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2024 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>