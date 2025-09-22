<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class RekamMedisDetail {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // CREATE
    public function create($idrekam_medis, $idtindakan, $hasil) {
        $sql = "INSERT INTO rekam_medis_detail (idrekam_medis, idtindakan, hasil) 
                VALUES (:idrekam_medis, :idtindakan, :hasil)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':idrekam_medis' => $idrekam_medis,
            ':idtindakan' => $idtindakan,
            ':hasil' => $hasil
        ]);
    }

    // READ
    public function getByRekamMedis($idrekam_medis) {
        $sql = "SELECT d.*, t.kode, t.deskripsi_tindakan_terapi
                FROM rekam_medis_detail d
                JOIN kode_tindakan_terapi t ON d.idtindakan = t.idkode_tindakan_terapi
                WHERE d.idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idrekam_medis]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($iddetail, $idtindakan, $hasil) {
        $sql = "UPDATE rekam_medis_detail 
                SET idtindakan = :idtindakan, hasil = :hasil
                WHERE iddetail = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $iddetail,
            ':idtindakan' => $idtindakan,
            ':hasil' => $hasil
        ]);
    }

    // DELETE
    public function delete($iddetail) {
        $sql = "DELETE FROM rekam_medis_detail WHERE iddetail = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $iddetail]);
    }
}
