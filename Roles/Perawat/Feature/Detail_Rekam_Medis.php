<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Rekam_Medis.php';
require_once __DIR__ . '/../../../Class/Detail_Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);
$detailObj = new RekamMedisDetail($db);

// Ambil ID Rekam Medis dari URL
$idrekam = $_GET['idrekam_medis'] ?? null;
if (!$idrekam) {
    header("Location: Rekam_Medis.php");
    exit;
}

// Ambil data utama
$rekam = $rekamObj->getById($idrekam);
$details = $detailObj->getByRekamMedis($idrekam);

// Ambil data tindakan untuk dropdown
$stmt = $db->getConnection()->prepare("
    SELECT idkode_tindakan_terapi, kode, deskripsi_tindakan_terapi 
    FROM kode_tindakan_terapi ORDER BY kode ASC
");
$stmt->execute();
$tindakanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pesan session
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);

// Helper aman
function esc($val)
{
    return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Rekam Medis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow">
        <h1 class="text-xl font-bold">🩺 Detail Rekam Medis</h1>
    </nav>

    <main class="container mx-auto p-6 flex-grow">

        <!-- Info Rekam Medis -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-2">Informasi Rekam Medis</h2>
            <p><strong>Pasien:</strong> <?= esc($rekam['nama_pet']); ?> (<?= esc($rekam['nama_pemilik']); ?>)</p>
            <p><strong>Diagnosa:</strong> <?= esc($rekam['diagnosa']); ?></p>
            <p><strong>Anamnesa:</strong> <?= esc($rekam['anamnesa']); ?></p>
            <p><strong>Temuan Klinis:</strong> <?= esc($rekam['temuan_klinis']); ?></p>
            <p><strong>Tanggal:</strong> <?= esc($rekam['created_at']); ?></p>
        </div>

        <!-- Alert -->
        <?php if ($msg): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-900 p-4 mb-4 rounded"><?= esc($msg); ?></div>
        <?php endif; ?>

        <!-- Form Tambah Detail -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">➕ Tambah Detail Tindakan Terapi</h3>
            <form method="POST" action="/PHP_Native_Web_OOP-Modul4/Controller/Detail_Rekam_Medis_Process.php">
                <input type="hidden" name="action" value="create">
                <input type="hidden" name="idrekam_medis" value="<?= esc($idrekam); ?>">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Dropdown Tindakan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Tindakan Terapi</label>
                        <select name="idkode_tindakan_terapi" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Pilih Tindakan --</option>
                            <?php foreach ($tindakanList as $t): ?>
                                <option value="<?= esc($t['idkode_tindakan_terapi']); ?>">
                                    <?= esc($t['kode']); ?> - <?= esc($t['deskripsi_tindakan_terapi']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Keterangan detail -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan / Detail</label>
                        <input type="text" name="detail" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan hasil atau keterangan tindakan">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="md:col-span-3 flex justify-end mt-3">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                            Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Detail -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">📋 Daftar Detail Tindakan Terapi</h3>
            <table class="w-full border-collapse">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th class="py-2 px-3 text-left">No</th>
                        <th class="py-2 px-3 text-left">Kode</th>
                        <th class="py-2 px-3 text-left">Deskripsi</th>
                        <th class="py-2 px-3 text-left">Detail</th>
                        <th class="py-2 px-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if ($details): ?>
                        <?php $no = 1;
                        foreach ($details as $d): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-3"><?= $no++; ?></td>
                                <td class="py-2 px-3"><?= esc($d['kode']); ?></td>
                                <td class="py-2 px-3"><?= esc($d['deskripsi_tindakan_terapi']); ?></td>
                                <td class="py-2 px-3"><?= esc($d['detail']); ?></td>
                                <td class="py-2 px-3 text-center">
                                    <!-- Tombol Edit -->
                                    <button type="button" onclick="toggleEditForm(<?= $d['iddetail_rekam_medis']; ?>)"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1 rounded">
                                        ✏️ Edit
                                    </button>

                                    <!-- Form Hapus -->
                                    <form method="POST"
                                        action="/PHP_Native_Web_OOP-Modul4/Controller/Detail_Rekam_Medis_Process.php"
                                        onsubmit="return confirm('Yakin ingin menghapus detail ini?')"
                                        class="inline-block ml-2">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="iddetail_rekam_medis"
                                            value="<?= esc($d['iddetail_rekam_medis']); ?>">
                                        <input type="hidden" name="idrekam_medis" value="<?= esc($idrekam); ?>">
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                            🗑️ Hapus
                                        </button>
                                    </form>

                                    <!-- Form Edit (disembunyikan awalnya) -->
                                    <form id="editForm-<?= $d['iddetail_rekam_medis']; ?>" method="POST"
                                        action="/PHP_Native_Web_OOP-Modul4/Controller/Detail_Rekam_Medis_Process.php"
                                        class="hidden mt-2 bg-gray-50 p-3 rounded border border-gray-300">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="iddetail_rekam_medis"
                                            value="<?= esc($d['iddetail_rekam_medis']); ?>">
                                        <input type="hidden" name="idrekam_medis" value="<?= esc($idrekam); ?>">

                                        <!-- Pilihan tindakan -->
                                        <select name="idkode_tindakan_terapi"
                                            class="w-full px-3 py-1 border border-gray-300 rounded mb-2">
                                            <?php foreach ($tindakanList as $t): ?>
                                                <option value="<?= esc($t['idkode_tindakan_terapi']); ?>" <?= $t['kode'] === $d['kode'] ? 'selected' : ''; ?>>
                                                    <?= esc($t['kode']); ?> - <?= esc($t['deskripsi_tindakan_terapi']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <!-- Kolom detail -->
                                        <input type="text" name="detail" value="<?= esc($d['detail']); ?>"
                                            class="w-full px-3 py-1 border border-gray-300 rounded mb-2"
                                            placeholder="Edit detail tindakan..." required>

                                        <div class="flex justify-end gap-2">
                                            <button type="button" onclick="toggleEditForm(<?= $d['iddetail_rekam_medis']; ?>)"
                                                class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">Batal</button>
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Simpan</button>
                                        </div>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-3">Belum ada tindakan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <script>
                function toggleEditForm(id) {
                    const form = document.getElementById('editForm-' + id);
                    form.classList.toggle('hidden');
                }
            </script>

        </div>
        <div class="mt-6">
            <a href="Rekam_Medis.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Rekam Medis
            </a>
        </div>
    </main>
    <footer class="bg-blue-900 text-white py-6 px-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>