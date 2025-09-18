<?php
session_start();
require_once __DIR__ . '/../../DB/dbconnection.php';
require_once __DIR__ . '/../../Class/User.php';
require_once __DIR__ . '/../../Class/Role.php';
require_once __DIR__ . '/../../Class/Login.php';

$db = new DBConnection();
$controller = new Login($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $error = $controller->login($email, $password);

    if ($error) {
        $_SESSION['login_error'] = $error;
        header("Location: ../login_RSHP.php");
        exit;
    }
}
