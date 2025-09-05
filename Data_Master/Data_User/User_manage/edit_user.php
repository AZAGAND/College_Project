<?php
session_start();
require_once __DIR__ . '/../../../Class/User.php';
require_once __DIR__ . '/../../../DB/dbconnection.php';

$db = new DBConnection();
$userObj = new User($db);

$id = $_GET['id'] ?? null;
if (!$id) die("ID user tidak ditemukan");

$user = $userObj->getUserById($id);
if (!$user) die("User tidak ditemukan");

$notif = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../../CSS/edit_user.css">
    <style>
        .notification {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit User</h2>
        <?php if (!empty($notif)): ?>
            <div class="notification <?php echo (strpos($notif, '✅') !== false) ? 'success' : 'error'; ?>">
                <?php echo $notif; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/PHP_Native_Web_OOP-Modul4/Controller/edit_user_process.php">
            <input type="hidden" name="iduser" value="<?= htmlspecialchars($user['iduser']); ?>">
            <label>Nama User</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required>
            <button type="submit">Simpan Perubahan</button>
        </form>

        <a href="../data_user.php">← Kembali ke Data User</a>
    </div>
</body>

</html>