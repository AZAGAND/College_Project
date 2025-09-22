<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class RekamMedis
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    public function create($idtemu_dokter, $diagnosa, $catatan)
    {
        $sql = "INSERT INTO rekam_medis (idtemu_dokter, diagnosa, catatan, tanggal) 
                VALUES (:idtemu_dokter, :diagnosa, :catatan, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':idtemu_dokter' => $idtemu_dokter,
            ':diagnosa' => $diagnosa,
            ':catatan' => $catatan
        ]);
    }

    public function getAll() {
    $sql = "SELECT rm.idrekam_medis,
                    rm.created_at,
                    rm.anamnesa,
                    rm.temuan_klinis,
                    rm.diagnosa,
                    pt.nama AS nama_pet,
                    u.nama AS nama_pemilik
            FROM rekam_medis rm
            JOIN temu_dokter td ON rm.idreservasi_dokter = td.idreservasi_dokter
            JOIN pet pt ON td.idpet = pt.idpet
            JOIN pemilik p ON pt.idpemilik = p.idpemilik
            JOIN user u ON p.iduser = u.iduser
            ORDER BY rm.created_at DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getById($idrekam_medis) {
    $sql = "SELECT rm.idrekam_medis,
                    rm.created_at,
                    rm.anamnesa,
                    rm.temuan_klinis,
                    rm.diagnosa,
                    pt.nama AS nama_pet,
                    u.nama AS nama_pemilik
            FROM rekam_medis rm
            JOIN temu_dokter td ON rm.idreservasi_dokter = td.idreservasi_dokter
            JOIN pet pt ON td.idpet = pt.idpet
            JOIN pemilik p ON pt.idpemilik = p.idpemilik
            JOIN user u ON p.iduser = u.iduser
            WHERE rm.idrekam_medis = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $idrekam_medis]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



    public function update($idrekam_medis, $diagnosa, $catatan)
    {
        $sql = "UPDATE rekam_medis 
                SET diagnosa = :diagnosa, catatan = :catatan 
                WHERE idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $idrekam_medis,
            ':diagnosa' => $diagnosa,
            ':catatan' => $catatan
        ]);
    }

    // DELETE
    public function delete($idrekam_medis)
    {
        $sql = "DELETE FROM rekam_medis WHERE idrekam_medis = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $idrekam_medis]);
    }
}
