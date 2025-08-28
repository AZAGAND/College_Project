<?php
$host = "localhost";   // biasanya localhost
$user = "root";        // user default XAMPP/Laragon biasanya root
$pass = "";            // password default kosong (kalau ada isi)
$db   = "kuliah_wf_2025"; // ganti dengan nama database kamu

// Buat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
