<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/Rekam_Medis.php';

$db = new DBConnection();
$rekamObj = new RekamMedis($db);

// Ambil ID dari URL
$id = $_GET['idrekam_medis'] ?? null;
if (!$id) {
    header("Location: Rekam_Medis.php");
    exit;
}

// Ambil data berdasarkan ID
$data = $rekamObj->getById($id);
if (!$data) {
    $_SESSION['msg'] = "❌ Data tidak ditemukan.";
    header("Location: Rekam_Medis.php");
    exit;
}

function esc($val) {
    return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rekam Medis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-blue-800">✏️ Edit Rekam Medis</h2>

    <form method="POST" action="/PHP_Native_Web_OOP-Modul4/Controller/Rekam_Medis_Process.php">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="idrekam_medis" value="<?= esc($data['idrekam_medis']); ?>">

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Diagnosa</label>
            <input type="text" name="diagnosa" class="w-full border px-4 py-2 rounded-lg"
                value="<?= esc($data['diagnosa']); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Anamnesa</label>
            <textarea name="anamnesa" class="w-full border px-4 py-2 rounded-lg" rows="3"
                required><?= esc($data['anamnesa']); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Temuan Klinis</label>
            <textarea name="temuan_klinis" class="w-full border px-4 py-2 rounded-lg" rows="3"
                required><?= esc($data['temuan_klinis']); ?></textarea>
        </div>

        <div class="flex justify-between mt-6">
            <a href="Rekam_Medis.php" class="bg-gray-600 text-white px-5 py-2 rounded-lg hover:bg-gray-700">⬅ Kembali</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-semibold">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>

</body>
</html>
