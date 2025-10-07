<?php
// ✅ Semua data dikirim dari controller process()
$rekam = $data['rekam'] ?? [];
$details = $data['details'] ?? [];
$namauser = $_SESSION['user']['nama'] ?? 'Pemilik';

function esc($v)
{
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>🩺 Detail Rekam Medis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- 🔹 Navbar -->
    <nav class="bg-blue-900 text-white px-8 py-5 flex justify-between items-center shadow-md">
        <h1 class="text-2xl font-bold flex items-center gap-2">
            🩺 Detail Rekam Medis
        </h1>
        <span class="text-lg">👋 Halo, <strong><?= esc($namauser); ?></strong></span>
    </nav>

    <!-- 🔸 Konten Utama -->
    <main class="container mx-auto px-10 py-10 flex-grow">
        <div class="bg-white rounded-2xl shadow-lg p-8 w-full">
            <h2 class="text-2xl font-bold text-blue-900 border-b-4 border-blue-900 pb-3 mb-6 flex items-center gap-2">
                🐕 <?= esc($rekam['nama_pet'] ?? '-') ?>
                <span class="text-gray-700 text-lg">(<?= esc($rekam['jenis_hewan'] ?? '-') ?>)</span>
            </h2>

            <div class="space-y-2 mb-6 text-gray-800">
                <p><strong>👨‍⚕️ Dokter Pemeriksa:</strong> <?= esc($rekam['nama_dokter'] ?? '-') ?></p>
                <p><strong>📅 Tanggal Pemeriksaan:</strong>
                    <?= isset($rekam['created_at']) ? date('d M Y, H:i', strtotime($rekam['created_at'])) : '-' ?>
                </p>
            </div>

            <hr class="my-6">

            <!-- 🔹 Diagnosa -->
            <h3 class="text-xl font-semibold text-blue-800 mb-3 flex items-center gap-2">📋 Diagnosa</h3>
            <div class="bg-gray-50 rounded-lg p-4 shadow-inner mb-8 text-gray-700 leading-relaxed">
                <p><strong>Anamnesa:</strong> <?= esc($rekam['anamnesa'] ?? '-') ?></p>
                <p><strong>Temuan Klinis:</strong> <?= esc($rekam['temuan_klinis'] ?? '-') ?></p>
                <p><strong>Diagnosa:</strong> <?= esc($rekam['diagnosa'] ?? '-') ?></p>
            </div>

            <!-- 🔹 Detail Tindakan -->
            <h3 class="text-xl font-semibold text-blue-800 mb-3 flex items-center gap-2">💉 Detail Tindakan</h3>
            <?php if (!empty($details)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-base text-gray-800 table-fixed">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold w-[10%] break-words">No</th>
                                <th class="px-4 py-3 text-left font-semibold w-[15%] break-words">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold w-[35%] break-words">Deskripsi</th>
                                <th class="px-4 py-3 text-left font-semibold w-[40%] break-words">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $no = 1;
                            foreach ($details as $d): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium"><?= $no++; ?></td>
                                    <td class="px-4 py-3"><?= esc($d['kode'] ?? '-') ?></td>
                                    <td class="px-4 py-3"><?= esc($d['deskripsi_tindakan_terapi'] ?? '-') ?></td>
                                    <td class="px-4 py-3"><?= esc($d['detail'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-10 text-gray-500 italic text-lg">
                    <p>Belum ada tindakan tercatat 💭</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- 🔸 Tombol Kembali -->
        <div class="mt-6">
            <a href="List_Rekam_Medis.php"
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