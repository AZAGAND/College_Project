<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class Pet
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    // Simpan pet sesuai kolom tabel 'pet'
    public function create($idpemilik, $nama, $idras_hewan, $tanggal_lahir = null, $warna_tanda = null, $jenis_kelamin = null)
    {
        $sql = "INSERT INTO pet (idpemilik, nama, idras_hewan, tanggal_lahir, warna_tanda, jenis_kelamin)
                VALUES (:idpemilik, :nama, :idras_hewan, :tanggal_lahir, :warna_tanda, :jenis_kelamin)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':idpemilik' => $idpemilik,
            ':nama' => $nama,
            ':idras_hewan' => $idras_hewan,
            ':tanggal_lahir' => $tanggal_lahir ?: null,
            ':warna_tanda' => $warna_tanda ?: null,
            ':jenis_kelamin' => $jenis_kelamin ?: null,
        ]);
    }

    public function getAllByPemilik($idpemilik)
    {
        $sql = "SELECT p.*, r.nama_ras, j.nama_jenis_hewan
                FROM pet p
                JOIN ras_hewan r ON p.idras_hewan = r.idras_hewan
                JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
                WHERE p.idpemilik = :idpemilik";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idpemilik' => $idpemilik]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPets()
    {
        $sql = "SELECT p.idpet, p.nama AS nama_pet, p.tanggal_lahir, p.warna_tanda, p.jenis_kelamin,
                    pem.nama AS nama_pemilik, pem.email, r.nama_ras, j.nama_jenis_hewan
            FROM pet p
            JOIN pemilik pmk ON p.idpemilik = pmk.idpemilik
            JOIN user pem ON pmk.iduser = pem.iduser
            JOIN ras_hewan r ON p.idras_hewan = r.idras_hewan
            JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

