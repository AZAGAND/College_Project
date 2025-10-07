<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'Pemilik') {
    header("Location: ../../Views/login_RSHP.php");
    exit;
}

$nama = $_SESSION['nama'] ?? 'Pemilik';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- 🔹 Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🐕</span>
            <h1 class="text-xl font-bold">Dashboard Pemilik</h1>
        </div>
        <div class="flex items-center gap-4">
            <span>Halo, <strong><?= htmlspecialchars($nama) ?></strong></span>
            <a href="../../Views/Logout.php"
                class="bg-red-600 hover:bg-red-700 px-4 py-1 rounded-lg transition">Logout</a>
        </div>
    </nav>

    <!-- 🔸 Konten Utama -->
    <main class="flex-grow container mx-auto p-8">
        <!-- Header -->
        <div class="mb-10 border-b-4 border-blue-900 pb-4">
            <h2 class="text-3xl font-bold text-blue-900 mb-2">Selamat Datang, <?= htmlspecialchars($nama) ?>!</h2>
            <p class="text-gray-600">Lihat dan kelola informasi hewan peliharaanmu dengan mudah 🐾</p>
        </div>

        <!-- 🔹 3 Menu Utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Hewan Saya -->
            <a href="Feature/List_Hewan.php"
                class="bg-white shadow-lg hover:shadow-xl p-6 rounded-xl border border-gray-200 transition transform hover:-translate-y-1">
                <div class="text-4xl mb-3">🐶</div>
                <h3 class="text-xl font-semibold text-blue-900 mb-2">Hewan Saya</h3>
                <p class="text-gray-600 text-sm">Lihat daftar hewan peliharaan yang kamu miliki.</p>
            </a>

            <!-- Reservasi Saya -->
            <a href="Feature/List_Reservasi.php"
                class="bg-white shadow-lg hover:shadow-xl p-6 rounded-xl border border-gray-200 transition transform hover:-translate-y-1">
                <div class="text-4xl mb-3">📅</div>
                <h3 class="text-xl font-semibold text-blue-900 mb-2">Reservasi Saya</h3>
                <p class="text-gray-600 text-sm">Lihat jadwal temu dokter untuk hewan peliharaanmu.</p>
            </a>

            <!-- Rekam Medis Saya -->
            <a href="Feature/Rekam_Medis_List.php"
                class="bg-white shadow-lg hover:shadow-xl p-6 rounded-xl border border-gray-200 transition transform hover:-translate-y-1">
                <div class="text-4xl mb-3">🩺</div>
                <h3 class="text-xl font-semibold text-blue-900 mb-2">Rekam Medis Saya</h3>
                <p class="text-gray-600 text-sm">Lihat hasil pemeriksaan dan tindakan dokter.</p>
            </a>
        </div>
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-blue-900 text-white py-6 text-center mt-auto">
        <p class="text-blue-200">&copy; 2025 RSHP Universitas Airlangga — Sistem Informasi Klinik Hewan</p>
    </footer>

</body>

</html>