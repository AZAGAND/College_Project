<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pemilik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Registrasi Pemilik</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($notif)): ?>
                <div class="alert alert-info"><?= $notif ?></div>
            <?php endif; ?>

            <form method="post" action="../../Controller/Resepsionis/Resepsionis_register_process.php">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                    <input type="text" class="form-control" name="no_wa" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Daftar</button>
                <a href="home_resepsionis.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
