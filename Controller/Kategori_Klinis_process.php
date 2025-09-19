<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Kategori_Klinis.php';

$db = new DBConnection();
$katObj = new Kategori_Klinis($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'create') {
            $nama = trim($_POST['nama_kategori_klinis']);
            $katObj->create($nama);
            $_SESSION['msg'] = "✅ Kategori Klinis berhasil ditambahkan.";
        } elseif ($action === 'update') {
            $id = $_POST['idkategori_klinis'];
            $nama = trim($_POST['nama_kategori_klinis']);
            $katObj->update($id, $nama);
            $_SESSION['msg'] = "✅ Kategori Klinis berhasil diperbarui.";
        } elseif ($action === 'delete') {
            $id = $_POST['idkategori_klinis'];
            $katObj->delete($id);
            $_SESSION['msg'] = "✅ Kategori Klinis berhasil dihapus.";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Error: " . $e->getMessage();
    }

    header("Location: ../Roles/Admin/Views/Data_KategoriKlinis.php");
    exit;
}
