<?php
session_start();
require_once __DIR__ . '/../../Class/User.php';
require_once __DIR__ . '/../../DB/dbconnection.php';

// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$db = new DBConnection();
$userObj = new User($db);
$allUsers = $userObj->getAllUsers();

// Ambil notifikasi dari session
$message = $_SESSION['success'] ?? $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- 🔹 Navbar -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👥</span>
                <span class="font-bold text-lg">Menu Manajemen User</span>
            </div>

            <!-- User Info -->
            <div class="flex items-center gap-4">
                <span class="text-blue-100">Halo, <span
                        class="font-semibold"><?= $_SESSION['nama'] ?? 'Admin'; ?></span></span>
                <a href="../../Views/Logout.php"
                    class="relative font-medium pb-1 group inline-block transition-all duration-300">
                    Logout
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- 🔹 Konten Utama -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Header -->
        <!-- Header -->
        <div class="mb-8 border-b-4 border-blue-900 pb-4">
            <h2 class="text-3xl font-bold text-blue-900 mb-2 flex items-center gap-2">
                <span class="text-4xl">👤</span>
                <span>Manajemen User</span>
            </h2>
            <p class="text-gray-600">Kelola data user, ganti password, dan ubah email dengan mudah</p>
        </div>


        <!-- 🔸 Notifikasi -->
        <?php if ($message): ?>
            <div
                class="mb-6 px-4 py-3 rounded-lg border-l-4 <?= strpos($message, '✅') !== false ? 'bg-green-50 border-green-500 text-green-800' : 'bg-red-50 border-red-500 text-red-800'; ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- 🔸 Tombol Tambah -->
        <div class="mb-6">
            <a href="tambah_user.php"
                class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg transition-colors duration-300">
                ➕ Tambah User
            </a>
        </div>

        <!-- 🔸 Tabel User -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">ID</th>
                            <th class="px-4 py-3 text-left font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-left font-semibold">Role</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($allUsers)): ?>
                            <?php foreach ($allUsers as $u): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-gray-800 font-medium"><?= $u['iduser'] ?></td>
                                    <td class="px-4 py-4 text-gray-800"><?= htmlspecialchars($u['nama']) ?></td>
                                    <td class="px-4 py-4 text-gray-700"><?= htmlspecialchars($u['email']) ?></td>
                                    <td class="px-4 py-4 text-gray-700">
                                        <?= htmlspecialchars($u['nama_role'] ?? 'Belum ada role') ?></td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="User_manage/edit_user.php?id=<?= $u['iduser'] ?>"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                                ✏️ Edit
                                            </a>
                                            <a href="User_manage/Ganti_Password.php?id=<?= $u['iduser'] ?>"
                                                onclick="return confirm('Ganti password user ini?')"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                                🔑 Ganti Password
                                            </a>
                                            <!-- <a href="/PHP_Native_Web_OOP-Modul4/Views/Data_Master/Data_User/User_manage/Ganti_Email.php?id=<?= $u['iduser'] ?>"
                                                onclick="return confirm('Ganti email user ini?')"
                                                class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                                📧 Ganti Email
                                            </a> -->
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <div class="text-5xl mb-2">📭</div>
                                        <p class="text-lg font-medium">Belum ada data user</p>
                                        <p class="text-sm">User baru akan muncul di sini setelah ditambahkan</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 🔸 Tombol Kembali -->
        <div class="mt-6">
            <a href="../Data_Master.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Data Master
            </a>
        </div>
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2024 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>