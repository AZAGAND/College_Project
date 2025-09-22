<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class RekamMedis {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // CREATE
    public function create($idreservasi, $diagnosa, $catatan) {
        $sql = "INSERT INTO rekam_medis (idreservasi, diagnosa, catatan, tanggal) 
                VALUES (:idreservasi, :diagnosa, :catatan, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':idreservasi' => $idreservasi,
            ':diagnosa' => $diagnosa,
            ':catatan' => $catatan
        ]);
    }

    // READ all
    public function getAll() {
        $sql = "SELECT rm.*, r.idreservasi, p.nama AS nama_pemilik, pt.nama AS nama_pet
                FROM rekam_medis rm
                JOIN reservasi r ON rm.idreservasi = r.idreservasi
                JOIN pemilik p ON r.idpemilik = p.idpemilik
                JOIN pet pt ON r.idpet = pt.idpet
                ORDER BY rm.tanggal DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ by id
    public function getById($idrekam_medis) {
        $sql = "SELECT * FROM rekam_medis WHERE idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idrekam_medis]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($idrekam_medis, $diagnosa, $catatan) {
        $sql = "UPDATE rekam_medis SET diagnosa = :diagnosa, catatan = :catatan 
                WHERE idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $idrekam_medis,
            ':diagnosa' => $diagnosa,
            ':catatan' => $catatan
        ]);
    }

    // DELETE
    public function delete($idrekam_medis) {
        $sql = "DELETE FROM rekam_medis WHERE idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $idrekam_medis]);
    }
}
