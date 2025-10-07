<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/Role.php';

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
$roleObj = new role($db);

// ambil semua user dengan roles
$users = $roleObj->getAllUsersWithRoles();

// toggle status
if (isset($_GET['toggle'])) {
    $idrole_user = (int) $_GET['toggle'];
    $roleObj->toggleRoleStatus($idrole_user);
    header("Location: role_management.php");
    exit();
}

// hapus role
if (isset($_GET['delete'])) {
    $idrole_user = (int) $_GET['delete'];
    $roleObj->deleteRoleFromUser($idrole_user);
    header("Location: role_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Brand / Nama -->
            <div class="flex items-center gap-2">
                <span class="text-xl">👥</span>
                <span class="font-bold text-lg">Manajemen Role</span>
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
            <h2 class="text-3xl font-bold text-blue-900 mb-2">👥 Manajemen Role Pengguna</h2>
            <p class="text-gray-600">Kelola role dan hak akses pengguna sistem</p>
        </div>

        <!-- Tombol Tambah Role -->
        <div class="mb-6">
            <a href="acces_control/tambah_role.php"
                class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ➕ Tambah Role Baru
            </a>
        </div>

        <!-- Card Tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold">Nama User</th>
                            <th class="px-4 py-3 text-center font-semibold">Email</th>
                            <th class="px-4 py-3 text-center font-semibold">Role</th>
                            <th class="px-4 py-3 text-center font-semibold">Status</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $u): ?>
                                <?php foreach ($u['roles'] as $r): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-4 text-center text-gray-900 font-medium">
                                            <?= htmlspecialchars($u['nama']) ?>
                                        </td>
                                        <td class="px-4 py-4 text-center text-gray-700">
                                            <?= htmlspecialchars($u['email']) ?>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                <?= htmlspecialchars($r['nama_role']) ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <?php if ($r['status']): ?>
                                                <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                    ✓ Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                                    ✗ Tidak Aktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Tombol Toggle Status -->
                                                <a href="?toggle=<?= $r['idrole_user'] ?>"
                                                    class="<?= $r['status'] ? 'bg-orange-600 hover:bg-orange-700' : 'bg-green-600 hover:bg-green-700' ?> text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                                    <?= $r['status'] ? '⊗ Nonaktifkan' : '✓ Aktifkan' ?>
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <a href="?delete=<?= $r['idrole_user'] ?>"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors"
                                                    onclick="return confirm('Hapus role ini dari user?')">
                                                    🗑️ Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="text-5xl mb-3">📭</div>
                                        <p class="text-lg font-medium">Belum ada data role pengguna</p>
                                        <p class="text-sm">Data role akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="../Data_Master.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Data Master
            </a>
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