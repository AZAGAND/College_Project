<?php
class Reservasi {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT td.*, p.nama AS nama_pet, u.nama AS nama_dokter
                    FROM temu_dokter td
                    JOIN pet p ON td.idpet = p.idpet
                    JOIN role_user ru ON td.idrole_user = ru.idrole_user
                    JOIN user u ON ru.iduser = u.iduser
                    ORDER BY td.tanggal DESC";
        return $this->conn->query($query);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM temu_dokter WHERE idreservasi_dokter=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($idpet, $idrole_user) {
        $stmt = $this->conn->prepare(
            "INSERT INTO temu_dokter (no_temu, idpet, idrole_user, status)
             VALUES (CONCAT('TM', LPAD(FLOOR(RAND()*9999),4,'0')), ?, ?, 'P')"
        );
        $stmt->bind_param("ii", $idpet, $idrole_user);
        return $stmt->execute();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE temu_dokter SET status=? WHERE idreservasi_dokter=?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM temu_dokter WHERE idreservasi_dokter=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
