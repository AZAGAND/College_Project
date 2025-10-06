<?php
$base_url = "http://localhost/PHP_Native_Web_OOP-Modul4/";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Navigasi -->
    <nav class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center">
            <!-- Menu tengah -->
            <div class="flex-1 flex justify-center items-center gap-12">
                <a href="<?= $base_url ?>Roles/Admin/admin.php" class="relative font-medium pb-1 group inline-block">
                    Home
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="<?= $base_url ?>Data_Master/Data_Master.php" class="relative font-medium pb-1 group inline-block whitespace-nowrap">
                    Data Master
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
            <!-- Logout pojok kanan -->
            <a href="<?= $base_url ?>Views/Logout.php" class="relative font-medium pb-1 group inline-block ml-auto">
                Logout
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-300 transition-all duration-300 group-hover:w-full"></span>
            </a>
        </div>
    </nav>
</body>
</html>