<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';

if (!$conn) {
    die('<div class="alert alert-danger">Koneksi database gagal!</div>');
}

// Method login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input email
    if (empty($email) || empty($password)) {
        $error = 'Email dan password harus diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        // Query untuk mengambil user dan role aktif
        $query = "SELECT u.*, r.nama_role
            FROM user u
            JOIN role_user ru ON u.iduser = ru.iduser AND ru.status = 1
            JOIN role r ON ru.idrole = r.idrole
            WHERE u.email = ?";

        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // password_verify untuk bcrypt password encription
                if (password_verify($password, $row['password'])) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user'] = [
                        'id' => $row['iduser'],
                        'nama' => $row['nama'],
                        'email' => $row['email'],
                        'role' => $row['nama_role']
                    ];

                    // Redirect sesuai role
                    switch ($row['nama_role']) {
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
                            header('Location: ../Resepsionis/resepsionis_dashboard.php');
                            break;
                        default:
                            $error = 'Role tidak dikenali!';
                            break;
                    }

                    // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
                    exit();

                } else {
                    $error = 'Password salah!';
                }
            } else {
                $error = 'Email tidak ditemukan!';
            }
            $stmt->close();
        } else {
            $error = 'Query error: ' . $conn->error;
        }
    }
}
// End PHP block before HTML
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
        <form action="" method="post">
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