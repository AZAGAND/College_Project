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