<?php
session_start();
require_once __DIR__ . '/../../../Controller/Pemilik_Controller.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Pemilik') {
    header("Location: ../../Views/login_RSHP.php");
    exit;
}

$controller = new PemilikController();
$iduser = $_SESSION['user']['id'];
$namauser = $_SESSION['user']['nama'];
$myPets = $controller->listHewan($iduser);

function esc($v)
{
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>🐾 Hewan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- 🔹 Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold">🐾 Daftar Hewan Peliharaan Saya</h1>
        <span>👋 Halo, <?= esc($namauser); ?></span>
    </nav>

    <!-- 🔸 Konten Utama -->
    <main class="container mx-auto px-6 py-8 flex-grow">
        <div class="bg-white rounded-xl shadow-lg p-6 overflow-hidden">

            <h2 class="text-2xl font-bold text-blue-900 border-b-4 border-blue-900 pb-3 mb-6">
                🐶 Hewan Terdaftar
            </h2>

            <?php if (!empty($myPets)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed border-collapse">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold w-[10%] break-words">No</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold w-[25%] break-words">Nama</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold w-[25%] break-words">Jenis Hewan</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold w-[20%] break-words">Ras</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold w-[20%] break-words">Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-800">
                            <?php $no = 1; foreach ($myPets as $p): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3"><?= $no++; ?></td>
                                    <td class="px-4 py-3 font-medium"><?= esc($p['nama']); ?></td>
                                    <td class="px-4 py-3"><?= esc($p['jenis_hewan']); ?></td>
                                    <td class="px-4 py-3"><?= esc($p['ras']); ?></td>
                                    <td class="px-4 py-3">
                                        <?= $p['jenis_kelamin'] === 'B' ? 'Betina' : 'Jantan'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-12 text-gray-500 italic">
                    <p>Belum ada hewan terdaftar di akun ini 🐾</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="../Pemilik_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                ⬅ Kembali ke Rekam Medis
            </a>
        </div>
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-blue-900 text-white py-4 text-center mt-auto shadow-inner">
        <p class="text-blue-200 text-sm">&copy; 2025 RSHP Universitas Airlangga — Sistem Informasi Klinik Hewan</p>
    </footer>

</body>
</html>
