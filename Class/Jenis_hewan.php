<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class JenisHewan {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM jenis_hewan";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM jenis_hewan WHERE idjenis_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama) {
        $sql = "INSERT INTO jenis_hewan (nama_jenis_hewan) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nama]);
    }

    public function update($id, $nama) {
        $sql = "UPDATE jenis_hewan SET nama_jenis_hewan = ? WHERE idjenis_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nama, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM jenis_hewan WHERE idjenis_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
