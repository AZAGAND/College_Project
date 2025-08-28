<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != "Administrator") {
    header("Location: login.php");
    exit;
}
include "menu.php";
?>

<h2>Dashboard Administrator</h2>
<p>Hallo <?php echo $_SESSION['user']['nama']; ?>, 
anda login sebagai <?php echo $_SESSION['user']['role']; ?>.</p>
