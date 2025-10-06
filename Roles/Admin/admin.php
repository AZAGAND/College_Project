<?php
session_start();

// Cegah akses jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
    exit();
}

// Tambahkan header anti-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard</title>
</head>

<body class="bg-gray-50">
    <?php
    include("../../Navigation/menu.php");
    ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-4xl font-bold mb-3">Hello Admin 👋</h1>
            <p class="text-blue-100 text-lg">Welcome to the admin dashboard. Manage your veterinary hospital system here.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">👥</div>
                    <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold">Users</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">247</h3>
                <p class="text-gray-600 text-sm">Total Users</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">🐾</div>
                    <div class="bg-green-100 text-green-900 px-3 py-1 rounded-full text-sm font-semibold">Pets</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">1,523</h3>
                <p class="text-gray-600 text-sm">Registered Pets</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">👨‍⚕️</div>
                    <div class="bg-purple-100 text-purple-900 px-3 py-1 rounded-full text-sm font-semibold">Doctors</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">42</h3>
                <p class="text-gray-600 text-sm">Active Doctors</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-4xl">💉</div>
                    <div class="bg-red-100 text-red-900 px-3 py-1 rounded-full text-sm font-semibold">Treatments</div>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">3,891</h3>
                <p class="text-gray-600 text-sm">Total Treatments</p>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Quick Actions</h2>
                <div class="space-y-3">
                    <a href="#" class="flex items-center gap-4 p-4 rounded-lg border border-blue-200 hover:bg-blue-50 hover:border-blue-400 transition-all duration-200">
                        <div class="bg-blue-100 p-3 rounded-lg text-2xl">➕</div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Add New Pet</h3>
                            <p class="text-sm text-gray-600">Register a new pet to the system</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-4 rounded-lg border border-green-200 hover:bg-green-50 hover:border-green-400 transition-all duration-200">
                        <div class="bg-green-100 p-3 rounded-lg text-2xl">📅</div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Schedule Appointment</h3>
                            <p class="text-sm text-gray-600">Book a new appointment</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-4 rounded-lg border border-purple-200 hover:bg-purple-50 hover:border-purple-400 transition-all duration-200">
                        <div class="bg-purple-100 p-3 rounded-lg text-2xl">📊</div>
                        <div>
                            <h3 class="font-semibold text-gray-800">View Reports</h3>
                            <p class="text-sm text-gray-600">Check system reports and analytics</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-4 p-4 rounded-lg border border-orange-200 hover:bg-orange-50 hover:border-orange-400 transition-all duration-200">
                        <div class="bg-orange-100 p-3 rounded-lg text-2xl">⚙️</div>
                        <div>
                            <h3 class="font-semibold text-gray-800">System Settings</h3>
                            <p class="text-sm text-gray-600">Configure system preferences</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Recent Activity</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                        <div class="bg-blue-100 p-2 rounded-full text-xl">🐶</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">New pet registered</h3>
                            <p class="text-sm text-gray-600">Golden Retriever "Max" added by Dr. Sarah</p>
                            <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                        <div class="bg-green-100 p-2 rounded-full text-xl">✅</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Treatment completed</h3>
                            <p class="text-sm text-gray-600">Vaccination for Persian Cat "Luna"</p>
                            <p class="text-xs text-gray-400 mt-1">4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 pb-4 border-b border-gray-100">
                        <div class="bg-purple-100 p-2 rounded-full text-xl">👤</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">New user registered</h3>
                            <p class="text-sm text-gray-600">John Doe registered as pet owner</p>
                            <p class="text-xs text-gray-400 mt-1">6 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-orange-100 p-2 rounded-full text-xl">📋</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Report generated</h3>
                            <p class="text-sm text-gray-600">Monthly financial report created</p>
                            <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">System Status</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-3xl mb-2">✅</div>
                    <h3 class="font-semibold text-gray-800 mb-1">Database</h3>
                    <p class="text-sm text-green-600 font-medium">Online</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-3xl mb-2">🔒</div>
                    <h3 class="font-semibold text-gray-800 mb-1">Security</h3>
                    <p class="text-sm text-green-600 font-medium">Protected</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-3xl mb-2">⚡</div>
                    <h3 class="font-semibold text-gray-800 mb-1">Performance</h3>
                    <p class="text-sm text-green-600 font-medium">Optimal</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>