<?php
include __DIR__ . '/../DB/dbconnection.php';
session_start();

$notif = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $retype = $_POST['retype'];

    if ($password !== $retype) {
        $notif = "❌ Password dan Retype Password tidak sama!";
    } else {
        // hash password
        $hashPass = password_hash($password, PASSWORD_BCRYPT);

        // simpan ke tabel user
        $stmt = $conn->prepare("INSERT INTO user (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $hashPass);

        if ($stmt->execute()) {
            $notif = "✅ User baru berhasil ditambahkan!";
        } else {
            $notif = "❌ Gagal menambah user: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="../CSS/tambah_user.css">
</head>

<body>
    <div class="container">
        <h2>Tambah User Baru</h2>
        <?php if (!empty($notif)): ?>
            <p class="notif"><?= $notif; ?></p>
        <?php endif; ?>
        <form method="post">
            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Retype Password</label>
            <input type="password" name="retype" required>

            <button type="submit">Simpan User</button>
        </form>
        <a href="data_user.php">← Kembali ke Data User</a>
    </div>
</body>

</html>