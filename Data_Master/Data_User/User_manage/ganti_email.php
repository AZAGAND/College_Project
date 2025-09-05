<?php
session_start();
require_once __DIR__ . "/../DB/dbconnection.php";

$error = '';
$success = '';

// pastikan user login
if (!isset($_SESSION['user'])) {
    header("Location: ../Interface/login_RSHP.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_baru = $_POST['email_baru'] ?? '';
    $iduser = $_SESSION['user']['id']; // ambil dari session

    // validasi email
    if (filter_var($email_baru, FILTER_VALIDATE_EMAIL)) {
        // cek apakah email sudah dipakai user lain
        $cek = $conn->prepare("SELECT iduser FROM user WHERE email = ? AND iduser != ?");
        $cek->bind_param("si", $email_baru, $iduser);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $error = "Email sudah digunakan oleh user lain!";
        } else {
            // update email
            $stmt = $conn->prepare("UPDATE user SET email = ? WHERE iduser = ?");
            $stmt->bind_param("si", $email_baru, $iduser);

            if ($stmt->execute()) {
                $success = "Email berhasil diubah!";
                $_SESSION['user']['email'] = $email_baru; // update session juga
            } else {
                $error = "Gagal mengubah email: " . $conn->error;
            }
            $stmt->close();
        }
        $cek->close();
    } else {
        $error = "Format email tidak valid!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Email</title>
    <link rel="stylesheet" href="../CSS/ganti_email.css">
</head>
<body>
<div class="container">
    <h2>Ganti Email</h2>
    <?php if ($success): ?><p class="msg"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p class="err"><?= $error ?></p><?php endif; ?>

    <form method="post">
        <label>Email Baru</label>
        <input type="email" name="email_baru" required>
        <button type="submit">Ubah Email</button>
    </form>

    <a href="../Data_Master/Data_User.php" class="back">← Kembali ke Data User</a>
</div>
</body>
</html>
