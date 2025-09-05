<?php
session_start();

// hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

header("Location: /PHP_Native_Web_OOP-Modul4/Views/login_RSHP.php");
exit();
