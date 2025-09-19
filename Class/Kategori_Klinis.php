<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class Kategori_Klinis {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    // CREATE
    public function create($nama) {
        $sql = "INSERT INTO kategori_klinis (nama_kategori_klinis) VALUES (:nama)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nama' => $nama]);
    }

    // READ
    public function getAll() {
        $sql = "SELECT * FROM kategori_klinis";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $nama) {
        $sql = "UPDATE kategori_klinis SET nama_kategori_klinis = :nama WHERE idkategori_klinis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nama' => $nama, ':id' => $id]);
    }

    // DELETE
    public function delete($id) {
        $sql = "DELETE FROM kategori_klinis WHERE idkategori_klinis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
