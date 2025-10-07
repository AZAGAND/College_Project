<?php
session_start();
require_once __DIR__ . '/../../../DB/dbconnection.php';
require_once __DIR__ . '/../../../Class/owner.php';

$db = new DBConnection();
$pemilikObj = new Pemilik($db);

// pastikan user login
$iduser = $_SESSION['iduser'] ?? null;
$namauser = $_SESSION['nama'] ?? 'Pemilik';

if (!$iduser) {
    header("Location: ../../../Views/login_RSHP.php");
    exit;
}

// ambil pet milik user yg login
$myPets = $pemilikObj->getMyPets($iduser);

function esc($v)
{
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hewan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">🐾 Daftar Hewan Peliharaan Saya</h1>
        <span>👋 Halo, <?= esc($namauser); ?></span>
    </nav>

    <main class="container mx-auto p-6 flex-grow">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">🐶 Hewan Terdaftar</h2>

            <?php if ($myPets): ?>
                <table class="w-full border-collapse shadow-sm">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Jenis Hewan</th>
                            <th class="px-4 py-2 text-left">Ras</th>
                            <th class="px-4 py-2 text-left">Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $no = 1;
                        foreach ($myPets as $row): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-2"><?= $no++; ?></td>
                                <td class="px-4 py-2 font-medium text-gray-800"><?= htmlspecialchars($row['nama']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($row['jenis_hewan']); ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($row['ras']); ?></td>
                                <td class="px-4 py-2">
                                    <?= $row['jenis_kelamin'] === 'B' ? 'Betina' : 'Jantan'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-500 italic">Belum ada hewan terdaftar di akun ini.</p>
            <?php endif; ?>

        </div>
        <div class="mt-6">
            <a href="../Pemilik_Dashboard.php"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-300">
                ⬅ Kembali ke Pemilik Dashboard
            </a>
        </div>
    </main>

    <footer class="bg-blue-900 text-white py-4 text-center">
        <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga</p>
    </footer>

</body>

</html>