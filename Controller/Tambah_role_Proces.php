<?php
session_start();

require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/Role.php';

$db = new DBConnection();
$roleObj = new Role($db);
$conn = $db->getConnection();

// Ambil data user dan role untuk dropdown
$users = $conn->query("SELECT iduser, nama FROM user ORDER BY nama")->fetchAll(PDO::FETCH_ASSOC);
$roles = $roleObj->getallroles();

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iduser = $_POST['iduser'] ?? '';
    $idrole = $_POST['idrole'] ?? '';

    if ($iduser && $idrole) {
        try {
            // Cek apakah role sudah ada untuk user
            $stmtCheck = $conn->prepare("SELECT * FROM role_user WHERE iduser = ? AND idrole = ?");
            $stmtCheck->execute([$iduser, $idrole]);
            $exists = $stmtCheck->fetch();

            if ($exists) {
                $_SESSION['message'] = "❌ Role ini sudah ada untuk user tersebut.";
            } else {
                $stmtInsert = $conn->prepare("INSERT INTO role_user (iduser,idrole,status) VALUES (?, ?, 1)");
                $stmtInsert->execute([$iduser, $idrole]);
                $_SESSION['message'] = "✅ Role berhasil ditambahkan!";
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "❌ Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "❌ Pilih user dan role terlebih dahulu.";
    }

    // Redirect ke view supaya reload tidak double submit
    header("Location: ../Data_Master/Role_Management/Acces_Control/Tambah_Role.php");
    exit;
}
?>