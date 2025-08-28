<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../Interface/login_RSHP.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Dokter Dashboard</title>
</head>

<body>
        <?php
        include("../../Data_Master/menu.php");
        ?>
    <h1>Hello Dokter</h1>
    <p>Welcome to the Dokter dashboard.</p>
</body>
</html>