<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Kategori.php';

$db = new DBConnection();
$kategoriObj = new Kategori($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $nama = trim($_POST['nama_kategori']);
            $kategoriObj->create($nama);
            $_SESSION['msg'] = "✅ Kategori berhasil ditambahkan.";
        } elseif ($action === 'update') {
            $id = $_POST['idkategori'];
            $nama = trim($_POST['nama_kategori']);
            $kategoriObj->update($id, $nama);
            $_SESSION['msg'] = "✅ Kategori berhasil diperbarui.";
        } elseif ($action === 'delete') {
            $id = $_POST['idkategori'];
            $kategoriObj->delete($id);
            $_SESSION['msg'] = "✅ Kategori berhasil dihapus.";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Admin/Views/Data_Kategori.php");
    exit;
}
