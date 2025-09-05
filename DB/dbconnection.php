<?php
// $host = "localhost";   // biasanya localhost
// $user = "root";        // user default XAMPP/Laragon biasanya root
// $pass = "";            // password default kosong (kalau ada isi)
// $db   = "kuliah_wf_2025"; // ganti dengan nama database kamu

// Buat koneksi
// $conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
// if (!$conn) {
//    die("Koneksi gagal: " . mysqli_connect_error());
//}

class DBConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "kuliah_wf_2025"; // sesuai database kamu
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}


?>