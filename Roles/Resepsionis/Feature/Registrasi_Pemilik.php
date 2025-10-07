<?php session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xl">📝</span>
                <span class="font-bold text-lg">Registrasi Pemilik</span>
            </div>

            <div class="flex items-center gap-4">
                <a href="../resepsionis_dashboard.php" class="relative font-medium pb-1 group inline-block">
                    Home
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="../../Views/Logout.php" class="relative font-medium pb-1 group inline-block">
                    Logout
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-blue-900 mb-2">📝 Registrasi Pemilik Baru</h2>
                <p class="text-gray-600">Daftarkan pemilik hewan peliharaan baru ke sistem</p>
            </div>

            <!-- Alert Message -->
            <?php if (isset($_SESSION['notif'])): ?>
                <div
                    class="bg-blue-50 border-l-4 border-blue-500 text-blue-900 p-3 mb-4 rounded-lg flex items-center gap-2 shadow-sm">
                    <span class="text-green-600 text-lg"></span>
                    <span class="font-medium"><?= htmlspecialchars($_SESSION['notif']); ?></span>
                </div>
                <?php unset($_SESSION['notif']); ?>
            <?php endif; ?>


            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form method="post" action="../../../Controller/Resepsionis_register_process.php" class="space-y-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="contoh@email.com" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan password" required>
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div>
                        <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="no_wa" id="no_wa"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="08xxxxxxxxxx" required>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat" id="alamat" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>

                    <!-- Info Note -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <p class="text-sm text-blue-900">
                            <span class="font-semibold">Info:</span> Pastikan semua data diisi dengan benar. Data ini
                            akan digunakan untuk keperluan komunikasi dan administrasi.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                            ✓ Daftar Sekarang
                        </button>
                        <a href="../resepsionis_dashboard.php"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg text-center transition-colors duration-300">
                            ⬅ Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2024 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>