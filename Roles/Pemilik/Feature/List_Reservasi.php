<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Owner.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Pemilik') {
    header("Location: ../../Views/login_RSHP.php");
    exit;
}

$db = new DBConnection();
$pemilikObj = new Pemilik($db);
$iduser = $_SESSION['user']['id'];
$namauser = $_SESSION['user']['nama'];
$reservasiSaya = $pemilikObj->getMyReservations($iduser);

function esc($v)
{
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reservasi Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col font-sans">

    <!-- 🔹 Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow">
        <div class="flex items-center gap-2">
            <span class="text-2xl">📅</span>
            <h1 class="text-xl font-bold">Daftar Reservasi Saya</h1>
        </div>
        <span class="text-blue-100">👋 Halo, <strong><?= esc($namauser); ?></strong></span>
    </nav>

    <!-- 🔹 Konten Utama -->
    <main class="container mx-auto p-6 flex-grow">
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-2xl font-semibold text-blue-900 mb-2">🐾 Jadwal Temu Dokter</h2>
            <p class="text-gray-600 mb-6">Berikut adalah daftar reservasi hewan peliharaanmu di RSHP Universitas
                Airlangga.</p>

            <?php if ($reservasiSaya): ?>
                <div class="overflow-x-auto rounded-lg">
                    <table class="w-full border-collapse">
                        <thead class="bg-blue-900 text-white text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">No</th>
                                <th class="px-4 py-3 text-left font-semibold">Nomor Temu</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama Hewan</th>
                                <th class="px-4 py-3 text-left font-semibold">Jenis Hewan</th>
                                <th class="px-4 py-3 text-left font-semibold">Dokter</th>
                                <th class="px-4 py-3 text-left font-semibold">Tanggal Temu</th>
                                <th class="px-4 py-3 text-center font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-800">
                            <?php $no = 1;
                            foreach ($reservasiSaya as $r): ?>
                                <tr class="hover:bg-blue-50 transition duration-150">
                                    <td class="px-4 py-3 text-gray-700"><?= $no++; ?></td>
                                    <td class="px-4 py-3 font-medium text-blue-800"><?= esc($r['no_temu']); ?></td>
                                    <td class="px-4 py-3"><?= esc($r['nama_pet']); ?></td>
                                    <td class="px-4 py-3"><?= esc($r['jenis_hewan']); ?></td>
                                    <td class="px-4 py-3"><?= esc($r['nama_dokter']); ?></td>
                                    <td class="px-4 py-3"><?= date('d M Y, H:i', strtotime($r['tanggal'])); ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <?php
                                        $status = $r['status'];
                                        switch ($status) {
                                            case 'S':
                                                $label = '✅ Selesai';
                                                $class = 'bg-green-100 text-green-800 border border-green-300 px-3 py-1 rounded-full text-xs font-semibold';
                                                break;
                                            case 'B':
                                                $label = '❌ Dibatalkan';
                                                $class = 'bg-red-100 text-red-800 border border-red-300 px-3 py-1 rounded-full text-xs font-semibold';
                                                break;
                                            case 'P':
                                                $label = '⏳ Menunggu';
                                                $class = 'bg-yellow-100 text-yellow-800 border border-yellow-300 px-3 py-1 rounded-full text-xs font-semibold';
                                                break;
                                            default:
                                                $label = '⚪ Belum Diproses';
                                                $class = 'bg-gray-100 text-gray-700 border border-gray-300 px-3 py-1 rounded-full text-xs font-semibold';
                                        }
                                        ?>
                                        <span class="<?= $class ?>"><?= $label ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center text-gray-500 py-6 italic">
                    Belum ada reservasi yang terdaftar di akun ini.
                </div>
            <?php endif; ?>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="../Pemilik_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Pemilik Dashboard
            </a>
        </div>
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-blue-900 text-white py-5 text-center mt-auto">
        <p class="text-blue-200 text-sm">&copy; 2025 RSHP Universitas Airlangga — Sistem Informasi Klinik Hewan</p>
    </footer>
</body>

</html>