<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Data Master</title>
</head>

<body class="bg-gray-50">
    <?php
    include("../Navigation/menu.php");
    ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white shadow-xl">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-6 pb-3 border-b border-blue-700">Menu Data Master</h3>
                <nav class="space-y-2">
                    <a href="Data_User/Data_User.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">👤</span>
                        <span class="font-medium">Data User</span>
                    </a>
                    <a href="Role_Management/role_management.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">⚙️</span>
                        <span class="font-medium">Manajemen Role</span>
                    </a>
                    <a href="../Roles/Admin/Views/Ras_hewan.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">🐾</span>
                        <span class="font-medium">Menu Ras Hewan</span>
                    </a>
                    <a href="../Roles/Admin/Views/Jenis_hewan.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">🐱</span>
                        <span class="font-medium">Menu Jenis Hewan</span>
                    </a>
                    <a href="../Roles/Admin/Views/Data_pemilik.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">📋</span>
                        <span class="font-medium">Data Pemilik</span>
                    </a>
                    <a href="../Roles/Admin/Views/Data_Dokter.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">👨‍⚕️</span>
                        <span class="font-medium">Data Dokter</span>
                    </a>
                    <a href="../Roles/Admin/Views/Data_pet.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">🐶</span>
                        <span class="font-medium">Data Hewan</span>
                    </a>
                    <a href="../Roles/Admin/Views/Data_Kategori.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">📂</span>
                        <span class="font-medium">Data Kategori</span>
                    </a>
                    <a href="../Roles/Admin/Views/Data_Kategori_Klinis.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">🩺</span>
                        <span class="font-medium">Data Kategori Klinis</span>
                    </a>
                    <a href="../Roles/Admin/Views/Data_Kode_Tindakan.php"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg border border-blue-700 hover:bg-blue-800 hover:border-blue-600 transition-all duration-200 group">
                        <span class="text-xl">💉</span>
                        <span class="font-medium">Data Kode Tindakan Terapi</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Konten utama -->
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
                    <h2 class="text-3xl font-bold text-blue-900 mb-4">Selamat Datang di Data Master</h2>
                    <p class="text-gray-700 text-lg leading-relaxed">Pilih menu di sidebar kiri untuk mengelola data.
                    </p>
                </div>

                <!-- Card Info tambahan -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="text-3xl mb-3">👥</div>
                        <h3 class="font-bold text-blue-900 mb-2">Manajemen User</h3>
                        <p class="text-gray-600 text-sm">Kelola data pengguna dan role</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="text-3xl mb-3">🐾</div>
                        <h3 class="font-bold text-blue-900 mb-2">Data Hewan</h3>
                        <p class="text-gray-600 text-sm">Kelola ras, jenis, dan data hewan</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="text-3xl mb-3">💉</div>
                        <h3 class="font-bold text-blue-900 mb-2">Data Medis</h3>
                        <p class="text-gray-600 text-sm">Kelola kategori dan tindakan medis</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>