<?php
require_once "../Class/dbconnection.php";
require_once "../Class/Reservasi.php";

$db = (new DBconnection())->init_connect();
$reservasi = new Reservasi($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $reservasi->create($_POST['idpet'], $_POST['idrole_user']);
    } elseif (isset($_POST['update'])) {
        $reservasi->updateStatus($_POST['idreservasi_dokter'], $_POST['status']);
    } elseif (isset($_POST['delete'])) {
        $reservasi->delete($_POST['idreservasi_dokter']);
    }
}

$data = $reservasi->getAll();
include "../../Views/Reservasi.php";
?>
