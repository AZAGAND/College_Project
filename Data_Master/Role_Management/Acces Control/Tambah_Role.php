<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';

// Ambil semua user
$users = $conn->query("SELECT iduser, nama FROM user ORDER BY nama");

// Ambil semua role
$roles = $conn->query("SELECT idrole, nama_role FROM role ORDER BY nama_role");

$msg = "";

// Simpan role baru untuk user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iduser = $_POST['iduser'];
    $idrole = $_POST['idrole'];

    // Cek apakah role ini sudah ada untuk user tsb
    $check = $conn->prepare("SELECT * FROM role_user WHERE iduser = ? AND idrole = ?");
    $check->bind_param("ii", $iduser, $idrole);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $msg = "❌ Role ini sudah ada untuk user tersebut.";
    } else {
        $stmt = $conn->prepare("INSERT INTO role_user(iduser,idrole,status) VALUES(?,?,1)");
        $stmt->bind_param("ii", $iduser, $idrole);
        if ($stmt->execute()) {
            $msg = "✅ Role berhasil ditambahkan!";
        } else {
            $msg = "❌ Gagal menambahkan role.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Role ke User</title>
    <link rel="stylesheet" href="../CSS/tambah_role.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Role ke User</h2>
        <?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
        <form action="" method="post">
            <label for="iduser">Pilih User</label>
            <select name="iduser" id="iduser" required>
                <option value="">-- Pilih User --</option>
                <?php while($u = $users->fetch_assoc()): ?>
                    <option value="<?= $u['iduser'] ?>"><?= $u['nama'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="idrole">Pilih Role</label>
            <select name="idrole" id="idrole" required>
                <option value="">-- Pilih Role --</option>
                <?php while($r = $roles->fetch_assoc()): ?>
                    <option value="<?= $r['idrole'] ?>"><?= $r['nama_role'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Tambah Role">
        </form>
        <p><a href="role_management.php">⬅ Kembali ke Manajemen Role</a></p>
    </div>
</body>
</html>
