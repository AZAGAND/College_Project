<?php
session_start();
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['iduser'] ?? null;

    if ($id) {
        try {
            $db = new DBConnection();
            $userObj = new User($db);

            // Hapus user
            $deleted = $userObj->deleteUser($id);

            if ($deleted) {
                $_SESSION['success'] = "✅ User berhasil dihapus.";
            } else {
                $_SESSION['error'] = "⚠️ Gagal menghapus user.";
            }

        } catch (Exception $e) {
            $_SESSION['error'] = "❌ Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "❌ ID user tidak ditemukan.";
    }

    header("Location: ../Data_Master/Data_User/Data_User.php");
    exit;
}
?>
