<?php
class Reservasi
{
    private $conn;

    public function __construct($db)
    {
        // Karena $db sudah berupa objek PDO, langsung simpan saja
        $this->conn = $db;
    }

    // 🔹 Ambil semua reservasi dokter
    public function getAll()
    {
        $sql = "SELECT 
                    td.idreservasi_dokter, 
                    td.no_urut, 
                    td.tanggal, 
                    td.status,
                    p.nama AS nama_pet, 
                    u.nama AS nama_dokter
                FROM temu_dokter td
                JOIN pet p ON td.idpet = p.idpet
                JOIN role_user ru ON td.idrole_user = ru.idrole_user
                JOIN user u ON ru.iduser = u.iduser
                ORDER BY td.tanggal DESC";
        
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Ambil semua hewan (pet)
    public function getAllHewan()
    {
        $stmt = $this->conn->query("SELECT idpet, nama FROM pet ORDER BY nama ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Ambil semua dokter aktif
    public function getAllDokter()
    {
        $sql = "SELECT 
                    ru.idrole_user, 
                    u.nama 
                FROM role_user ru
                JOIN user u ON ru.iduser = u.iduser
                WHERE ru.idrole = 2 AND ru.status = 1
                ORDER BY u.nama ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Ambil reservasi by ID
    public function getById($id)
    {
        $sql = "SELECT * FROM temu_dokter WHERE idreservasi_dokter = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Tambah reservasi baru
    public function create($idpet, $idrole_user)
    {
        $sql = "INSERT INTO temu_dokter (no_urut, idpet, idrole_user, status, tanggal)
                VALUES (CONCAT('TM', LPAD(FLOOR(RAND()*9999),4,'0')), :idpet, :idrole_user, 'P', NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':idpet' => $idpet,
            ':idrole_user' => $idrole_user
        ]);
    }

    // 🔹 Update status reservasi
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE temu_dokter 
                SET status = :status 
                WHERE idreservasi_dokter = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    // 🔹 Hapus reservasi
    public function delete($id)
    {
        $sql = "DELETE FROM temu_dokter WHERE idreservasi_dokter = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
