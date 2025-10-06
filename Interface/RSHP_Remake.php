<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP Universitas Airlangga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex flex-wrap justify-center gap-6 md:gap-8">
            <a href="#home" class="hover:text-blue-300 transition-colors duration-300 font-medium">Home</a>
            <a href="#struktur" class="hover:text-blue-300 transition-colors duration-300 font-medium">Struktur
                Organisasi</a>
            <a href="#layanan" class="hover:text-blue-300 transition-colors duration-300 font-medium">Layanan Umum</a>
            <a href="#visi" class="hover:text-blue-300 transition-colors duration-300 font-medium">Visi Misi dan
                Tujuan</a>
            <a href="http://localhost/PHP_Native_Web_OOP-Modul4/Views/Login_RSHP.php"
                class="bg-blue-600 hover:bg-blue-500 px-5 py-2 rounded-lg transition-colors duration-300 font-medium">Login</a>
        </div>
    </nav>

    <!-- Home -->
    <section id="home" class="pt-0">
        <div class="w-full">
            <div class="bg-white shadow-xl">
                <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp"
                    alt="Logo RSHP" class="w-full h-auto object-cover">
                <div class="py-12 px-4 md:px-8 max-w-5xl mx-auto">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 text-center">
                        Rumah Sakit Hewan Pendidikan Universitas Airlangga
                    </h1>
                    <p class="text-gray-700 text-lg mb-4 leading-relaxed">
                        Selamat datang di <b class="text-blue-900">RSHP Universitas Airlangga</b>, pusat layanan
                        kesehatan hewan yang menggabungkan <i class="text-blue-700">pelayanan medis</i> dengan <u
                            class="text-blue-700">pendidikan veteriner</u>.
                    </p>
                    <p class="text-gray-700 text-lg">
                        Kunjungi situs resmi kami di <a href="https://rshp.unair.ac.id" target="_blank"
                            class="text-blue-600 hover:text-blue-800 font-semibold underline">RSHP Unair</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section id="struktur" class="py-16 px-4 bg-gray-100">
        <div class="container mx-auto max-w-4xl">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-8 text-center">Struktur Organisasi</h2>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-blue-900 text-white">
                            <th class="py-4 px-6 text-left font-semibold">Jabatan</th>
                            <th class="py-4 px-6 text-left font-semibold">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-900">Direktur</td>
                            <td class="py-4 px-6 text-gray-700">Drh. Andi Setiawan, M.Vet</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-900">Wakil Direktur</td>
                            <td class="py-4 px-6 text-gray-700">Drh. Siti Rahmawati</td>
                        </tr>
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-900">Kepala Pelayanan Medis</td>
                            <td class="py-4 px-6 text-gray-700">Drh. Budi Santoso</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Layanan Umum -->
    <section id="layanan" class="py-16 px-4">
        <div class="container mx-auto max-w-4xl">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-8 text-center">Layanan Umum</h2>
            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                        <span class="text-gray-700 text-lg">Pelayanan rawat jalan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                        <span class="text-gray-700 text-lg">Pelayanan rawat inap</span>
                    </li>
                    <li class="flex items-start">
                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                        <span class="text-gray-700 text-lg">Laboratorium diagnostik</span>
                    </li>
                    <li class="flex items-start">
                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                        <span class="text-gray-700 text-lg">Bedah umum dan spesialis</span>
                    </li>
                    <li class="flex items-start">
                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                        <span class="text-gray-700 text-lg">Vaksinasi dan sterilisasi</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section id="visi" class="py-16 px-4 bg-gradient-to-b from-gray-100 to-blue-50">
        <div class="container mx-auto max-w-4xl">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-12 text-center">Visi, Misi, dan Tujuan</h2>

            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 mb-8">
                <h3 class="text-2xl font-bold text-blue-800 mb-4 border-l-4 border-blue-600 pl-4">Visi</h3>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Menjadi pusat layanan kesehatan hewan terdepan di Indonesia berbasis pendidikan, penelitian, dan
                    pengabdian masyarakat.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 mb-8">
                <h3 class="text-2xl font-bold text-blue-800 mb-6 border-l-4 border-blue-600 pl-4">Misi</h3>
                <ol class="space-y-4">
                    <li class="flex items-start">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full font-bold mr-4 flex-shrink-0">1</span>
                        <span class="text-gray-700 text-lg pt-1">Menyelenggarakan layanan kesehatan hewan yang
                            profesional dan ramah.</span>
                    </li>
                    <li class="flex items-start">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full font-bold mr-4 flex-shrink-0">2</span>
                        <span class="text-gray-700 text-lg pt-1">Mendukung pendidikan dan penelitian di bidang
                            kedokteran hewan.</span>
                    </li>
                    <li class="flex items-start">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full font-bold mr-4 flex-shrink-0">3</span>
                        <span class="text-gray-700 text-lg pt-1">Meningkatkan kesadaran masyarakat akan pentingnya
                            kesehatan hewan.</span>
                    </li>
                </ol>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
                <h3 class="text-2xl font-bold text-blue-800 mb-4 border-l-4 border-blue-600 pl-4">Tujuan</h3>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Memberikan pelayanan medis berkualitas tinggi sekaligus menjadi pusat pembelajaran mahasiswa
                    kedokteran hewan.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-8 px-4">
        <div class="container mx-auto text-center">
            <p class="text-blue-200">&copy; 2024 RSHP Universitas Airlangga. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>