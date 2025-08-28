<?php
session_start();

// hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

// redirect ke login
header("Location: ../../Interface/login_RSHP.php");
exit();
