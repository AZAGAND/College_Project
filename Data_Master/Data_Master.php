<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Administrator') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <nav>
        <a href="">Data Master</a>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../CSS/Data_Master.css" rel="stylesheet">
    </nav>
</head>
<body>
    <div class="menu">
        <a href="data_user.php">👤 Data User</a>
        <a href="role_management.php">⚙️ Manajemen Role</a>
        <a href="../Roles/Admin/admin.php">⬅ Back to Admin Page</a>
    </div>
</body>
</html>
