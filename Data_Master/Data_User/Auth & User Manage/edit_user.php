<?php
include __DIR__ . '/../DB/dbconnection.php';
session_start();

$id = $_GET['id'] ?? 0;
$notif = "";

// ambil data user
$stmt = $conn->prepare("SELECT * FROM user WHERE iduser = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// kalau form disubmit → update nama
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $update = $conn->prepare("UPDATE user SET nama=? WHERE iduser=?");
    $update->bind_param("si", $nama, $id);
    if ($update->execute()) {
        $notif = "✅ Data berhasil disimpan!";
        // refresh data biar nama terbaru tampil
        $user['nama'] = $nama;
    } else {
        $notif = "❌ Gagal menyimpan data!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../CSS/edit_user.css">
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
        <form method="post">
            <label>Nama User</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="data_user.php">← Kembali ke Data User</a>
    </div>
</body>

</html>