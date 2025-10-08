<?php
class RasHewan
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $sql = "SELECT r.idras_hewan, r.nama_ras, j.nama_jenis_hewan
                FROM ras_hewan r
                JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
                ORDER BY r.nama_ras ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM ras_hewan WHERE idras_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama_ras, $idjenis)
    {
        $sql = "INSERT INTO ras_hewan (nama_ras, idjenis_hewan) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nama_ras, $idjenis]);
    }

    public function update($id, $nama_ras, $idjenis)
    {
        $sql = "UPDATE ras_hewan SET nama_ras = ?, idjenis_hewan = ? WHERE idras_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nama_ras, $idjenis, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ras_hewan WHERE idras_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getJenis()
    {
        $sql = "SELECT * FROM jenis_hewan";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRasByJenis($idjenis)
    {
        $sql = "SELECT r.idras_hewan, r.nama_ras, j.nama_jenis_hewan
            FROM ras_hewan r
            JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
            WHERE r.idjenis_hewan = ?
            ORDER BY r.nama_ras ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idjenis]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJenisByRasId($idras)
    {
        $sql = "SELECT j.idjenis_hewan, j.nama_jenis_hewan
            FROM ras_hewan r
            JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
            WHERE r.idras_hewan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idras]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
