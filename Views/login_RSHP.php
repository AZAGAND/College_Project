<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Login</title>
    <link rel="stylesheet" href="../CSS/login_RSHP.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="Auth/login_process.php">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">

            <?php if (!empty($error)): ?>
                <p style="color:red; text-align:center;"><?= $error; ?></p>
            <?php endif; ?>
        </form>
        <p>Belum punya akun? <a href="http://localhost/registrasi.php">Daftar di sini</a></p>
    </div>
</body>
</html>
