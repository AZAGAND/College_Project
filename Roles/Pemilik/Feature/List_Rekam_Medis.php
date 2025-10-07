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

$rekamMedisSaya = $controller->listRekamMedis($iduser);

function esc($v)
{
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>🩺 Rekam Medis Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- 🔹 Navbar -->
    <nav class="bg-blue-900 text-white px-8 py-5 flex justify-between items-center shadow-md">
        <h1 class="text-2xl font-bold flex items-center gap-2">
            🩺 Rekam Medis Saya
        </h1>
        <span class="text-lg">👋 Halo, <strong><?= esc($namauser); ?></strong></span>
    </nav>

    <!-- 🔸 Konten -->
    <main class="container mx-auto px-10 py-10 flex-grow">
        <div class="bg-white rounded-2xl shadow-lg p-8 w-full">
            <h2 class="text-2xl font-bold mb-6 text-blue-900 border-b-4 border-blue-900 pb-3 flex items-center gap-2">
                📋 Daftar Rekam Medis
            </h2>

            <?php if ($rekamMedisSaya): ?>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-base text-gray-800 table-fixed">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold w-[5%] break-words">No</th>
                                <th class="px-4 py-3 text-left font-semibold w-[20%] break-words">Nama Hewan</th>
                                <th class="px-4 py-3 text-left font-semibold w-[20%] break-words">Dokter</th>
                                <th class="px-4 py-3 text-left font-semibold w-[30%] break-words">Diagnosa</th>
                                <th class="px-4 py-3 text-left font-semibold w-[15%] break-words">Tanggal</th>
                                <th class="px-4 py-3 text-center font-semibold w-[10%] break-words">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <?php $no = 1;
                            foreach ($rekamMedisSaya as $r): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium"><?= $no++; ?></td>
                                    <td class="px-4 py-3"><?= esc($r['nama_pet']); ?></td>
                                    <td class="px-4 py-3"><?= esc($r['nama_dokter']); ?></td>
                                    <td class="px-4 py-3"><?= esc($r['diagnosa']); ?></td>
                                    <td class="px-4 py-3"><?= date('d M Y', strtotime($r['tanggal'])); ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="List_Detail_Rekam_Medis.php?idrekam_medis=<?= $r['idrekam_medis']; ?>"
                                            class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1.5 rounded-lg shadow transition">
                                            🔍 Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-12 text-gray-500 italic text-lg">
                    <p>Belum ada rekam medis untuk akun ini 📋</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- 🔸 Tombol Kembali -->
        <div class="mt-6">
            <a href="../Pemilik_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                ⬅ Kembali ke Rekam Medis
            </a>
        </div>
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-blue-900 text-white py-5 text-center mt-auto shadow-inner">
        <p class="text-blue-200 text-base">&copy; 2025 RSHP Universitas Airlangga — Sistem Informasi Klinik Hewan</p>
    </footer>

</body>
</html>
