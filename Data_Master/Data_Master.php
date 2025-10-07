<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-4">
                <a href="../Roles/Admin/Admin.php" class="relative font-medium pb-1 group inline-block">
                    ← Home
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <div class="h-6 w-px bg-blue-700"></div>
                <div class="flex items-center gap-2">
                    <span class="text-xl">📁</span>
                    <span class="font-bold text-lg">Data Master</span>
                </div>
            </div>
            
            <!-- User Info & Logout -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span class="font-semibold">Admin</span></span>
                <a href="../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
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
            <h1 class="text-4xl font-bold mb-3">📁 Data Master</h1>
            <p class="text-blue-100 text-lg">Kelola seluruh data master sistem informasi klinik hewan dengan mudah dan terintegrasi.</p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Menu 1: Data User -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">👤</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data User</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola data pengguna sistem dan informasi akun.</p>
                    <a href="Data_User/Data_User.php" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Data User
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
                        <span>Info akun lengkap</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Status aktivasi user</span>
                    </div>
                </div>
            </div>

            <!-- Menu 2: Manajemen Role -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">⚙️</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Manajemen Role</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola role dan hak akses pengguna sistem.</p>
                    <a href="Role_Management/role_management.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Role
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Pengaturan role</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Hak akses user</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Permission management</span>
                    </div>
                </div>
            </div>

            <!-- Menu 3: Ras Hewan -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🐾</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Ras Hewan</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola data ras hewan peliharaan yang terdaftar.</p>
                    <a href="../Roles/Admin/Views/Ras_hewan.php" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Ras Hewan
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Daftar ras lengkap</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Karakteristik ras</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Database terintegrasi</span>
                    </div>
                </div>
            </div>

            <!-- Menu 4: Jenis Hewan -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🐱</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Jenis Hewan</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola kategori jenis hewan (kucing, anjing, dll).</p>
                    <a href="../Roles/Admin/Views/Jenis_hewan.php" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Jenis Hewan
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Kategori jenis hewan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Klasifikasi lengkap</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Master data jenis</span>
                    </div>
                </div>
            </div>

            <!-- Menu 5: Data Pemilik -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📋</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data Pemilik</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola informasi pemilik hewan peliharaan.</p>
                    <a href="../Roles/Admin/Views/Data_pemilik.php" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Data Pemilik
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Profil pemilik</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Kontak & alamat</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Riwayat kepemilikan</span>
                    </div>
                </div>
            </div>

            <!-- Menu 6: Data Dokter -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">👨‍⚕️</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data Dokter</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola informasi dokter hewan dan spesialisasi.</p>
                    <a href="../Roles/Admin/Views/Data_Dokter.php" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Data Dokter
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Profil dokter</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Spesialisasi & keahlian</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Jadwal praktik</span>
                    </div>
                </div>
            </div>

            <!-- Menu 7: Data Hewan -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🐶</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data Hewan</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola database hewan peliharaan terdaftar.</p>
                    <a href="../Roles/Admin/Views/Data_pet.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Data Hewan
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
                        <span>Riwayat kesehatan</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Data pemilik terkait</span>
                    </div>
                </div>
            </div>

            <!-- Menu 8: Data Kategori -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">📂</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Data Kategori</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola kategori untuk klasifikasi data sistem.</p>
                    <a href="../Roles/Admin/Views/Data_Kategori.php" class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Kategori
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Kategori sistem</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Klasifikasi data</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Master kategori</span>
                    </div>
                </div>
            </div>

            <!-- Menu 9: Kategori Klinis -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">🩺</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Kategori Klinis</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola kategori pemeriksaan dan diagnosis klinis.</p>
                    <a href="../Roles/Admin/Views/Data_Kategori_Klinis.php" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Kategori Klinis
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Kategori diagnosis</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Klasifikasi medis</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Standar pemeriksaan</span>
                    </div>
                </div>
            </div>

            <!-- Menu 10: Kode Tindakan Terapi -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="text-6xl mb-4">💉</div>
                    <h2 class="text-2xl font-bold text-blue-900 mb-3">Kode Tindakan Terapi</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola kode dan jenis tindakan terapi medis.</p>
                    <a href="../Roles/Admin/Views/Data_Kode_Tindakan.php" class="inline-block bg-lime-600 hover:bg-lime-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                        Kelola Kode Tindakan
                    </a>
                </div>
                
                <!-- Info tambahan -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Kode tindakan standar</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <span>✓</span>
                        <span>Jenis terapi</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span>✓</span>
                        <span>Database prosedur</span>
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
                        <h3 class="font-bold text-blue-900 mb-2">Tips Pengelolaan Data Master</h3>
                        <p class="text-gray-700 leading-relaxed">Pastikan data master selalu terupdate dan akurat. Lakukan verifikasi berkala untuk menjaga integritas database. Gunakan fitur pencarian untuk menemukan data dengan cepat.</p>
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