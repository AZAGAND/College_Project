<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class RekamMedisDetail {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // CREATE
    public function create($idrekam_medis, $idkode_tindakan_terapi, $detail) {
        $sql = "INSERT INTO detail_rekam_medis (idrekam_medis, idkode_tindakan_terapi, detail) 
                VALUES (:idrekam_medis, :idkode_tindakan_terapi, :detail)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':idrekam_medis' => $idrekam_medis,
            ':idkode_tindakan_terapi' => $idkode_tindakan_terapi,
            ':detail' => $detail
        ]);
    }

    // READ
    public function getByRekamMedis($idrekam_medis) {
        $sql = "SELECT d.iddetail_rekam_medis, d.detail, 
                       t.kode, t.deskripsi_tindakan_terapi
                FROM detail_rekam_medis d
                JOIN kode_tindakan_terapi t 
                    ON d.idkode_tindakan_terapi = t.idkode_tindakan_terapi
                WHERE d.idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idrekam_medis]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($iddetail_rekam_medis, $idkode_tindakan_terapi, $detail) {
        $sql = "UPDATE detail_rekam_medis 
                SET idkode_tindakan_terapi = :idkode_tindakan_terapi, detail = :detail
                WHERE iddetail_rekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $iddetail_rekam_medis,
            ':idkode_tindakan_terapi' => $idkode_tindakan_terapi,
            ':detail' => $detail
        ]);
    }

    // DELETE
    public function delete($iddetail_rekam_medis) {
        $sql = "DELETE FROM detail_rekam_medis WHERE iddetail_rekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $iddetail_rekam_medis]);
    }
}
