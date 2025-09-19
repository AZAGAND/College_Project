<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class Kategori {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // CREATE
    public function create($nama_kategori) {
        $sql = "INSERT INTO kategori (nama_kategori) VALUES (:nama)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nama' => $nama_kategori]);
    }

    // READ
    public function getAll() {
        $sql = "SELECT * FROM kategori";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($idkategori, $nama_kategori) {
        $sql = "UPDATE kategori SET nama_kategori = :nama WHERE idkategori = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nama' => $nama_kategori, ':id' => $idkategori]);
    }

    // DELETE
    public function delete($idkategori) {
        $sql = "DELETE FROM kategori WHERE idkategori = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $idkategori]);
    }
}
