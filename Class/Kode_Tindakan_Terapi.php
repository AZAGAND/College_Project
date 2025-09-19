<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class Kode_Tindakan_Terapi {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // CREATE
    public function create($kode, $deskripsi, $idkategori) {
        $sql = "INSERT INTO kode_tindakan_terapi (kode, deskripsi_tindakan_terapi, idkategori_klinis) 
                VALUES (:kode, :deskripsi, :idkategori)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':kode' => $kode,
            ':deskripsi' => $deskripsi,
            ':idkategori' => $idkategori
        ]);
    }

    // READ
    public function getAll() {
        $sql = "SELECT kt.idkode_tindakan_terapi, kt.kode, kt.deskripsi_tindakan_terapi, 
                        k.nama_kategori_klinis
                FROM kode_tindakan_terapi kt
                JOIN kategori_klinis k ON kt.idkategori_klinis = k.idkategori_klinis";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $kode, $deskripsi, $idkategori) {
        $sql = "UPDATE kode_tindakan_terapi 
                SET kode = :kode, deskripsi_tindakan_terapi = :deskripsi, idkategori_klinis = :idkategori
                WHERE idkode_tindakan_terapi = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':kode' => $kode,
            ':deskripsi' => $deskripsi,
            ':idkategori' => $idkategori
        ]);
    }

    // DELETE
    public function delete($id) {
        $sql = "DELETE FROM kode_tindakan_terapi WHERE idkode_tindakan_terapi = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
