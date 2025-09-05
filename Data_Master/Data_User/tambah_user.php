<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="../../CSS/tambah_user.css">
</head>

<body>
    <div class="container">
        <h2>Tambah User Baru</h2>
        <?php if (!empty($notif)): ?>
            <p class="notif"><?= $notif; ?></p>
        <?php endif; ?>
        <form method="post" action="../../Controller/tambah_user_process.php">
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