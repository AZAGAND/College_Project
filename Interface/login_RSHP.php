<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Class.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';

$db = new DBConnection();
$userObj = new User($db);
$roleObj = new Role($db);

// Method login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input
    if (empty($email) || empty($password)) {
        $error = 'Email dan password harus diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        // Cari user by email
        $user = $userObj->getUserByEmail($email);

        if ($user) {
            // Verifikasi password hash (bcrypt)
            if (password_verify($password, $user['password'])) {
                // Ambil role aktif user
                $roles = $roleObj->getRolesByUser($user['iduser']);

                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = [
                    'id'    => $user['iduser'],
                    'nama'  => $user['nama'],
                    'email' => $user['email'],
                    'roles' => $roles
                ];

                // Redirect sesuai role
                if (count($roles) == 1) {
                    $role = $roles[0]['nama_role'];
                    switch ($role) {
                        case 'Administrator':
                            header('Location: ../Roles/Admin/admin.php');
                            break;
                        case 'Dokter':
                            header('Location: ../Roles/Dokter/dokter_dashboard.php');
                            break;
                        case 'Perawat':
                            header('Location: ../Roles/Perawat/perawat_dashboard.php');
                            break;
                        case 'Resepsionis':
                            header('Location: ../Roles/Resepsionis/resepsionis_dashboard.php');
                            break;
                        default:
                            $error = 'Role tidak dikenali!';
                            break;
                    }
                    exit;
                } else {
                    header('Location: ../role_management.php');
                    exit;
                }

            } else {
                $error = 'Password salah!';
            }
        } else {
            $error = 'Email tidak ditemukan!';
        }
    }
}
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
        <form action="" method="POST">
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
