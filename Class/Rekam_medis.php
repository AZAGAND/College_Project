<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class RekamMedis
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    public function create($idreservasi, $diagnosa, $anamnesa)
    {
        // ambil dokter pemeriksa dari temu_dokter (FK)
        $query = "SELECT idrole_user FROM temu_dokter WHERE idreservasi_dokter = :idreservasi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['idreservasi' => $idreservasi]);
        $dokter = $stmt->fetchColumn();

        // insert rekam medis
        $sql = "INSERT INTO rekam_medis 
            (idreservasi_dokter, diagnosa, anamnesa, created_at, dokter_pemeriksa)
            VALUES (:idreservasi, :diagnosa, :anamnesa, NOW(), :dokter)";
        $stmt2 = $this->conn->prepare($sql);
        $stmt2->execute([
            'idreservasi' => $idreservasi,
            'diagnosa' => $diagnosa,
            'anamnesa' => $anamnesa,
            'dokter' => $dokter
        ]);
    }



    public function getAll()
    {
        $sql = "SELECT 
                rm.idrekam_medis,
                rm.idreservasi_dokter AS idreservasi,
                rm.diagnosa,
                rm.anamnesa AS catatan,
                rm.created_at AS tanggal,
                td.no_temu,
                u.nama AS nama_pemilik,
                hewan.nama AS nama_pet
            FROM rekam_medis rm
            INNER JOIN temu_dokter td ON rm.idreservasi_dokter = td.idreservasi_dokter
            INNER JOIN pet hewan ON td.idpet = hewan.idpet
            INNER JOIN pemilik pm ON hewan.idpemilik = pm.idpemilik
            INNER JOIN user u ON pm.iduser = u.iduser
            ORDER BY rm.idrekam_medis ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getById($idrekam_medis)
    {
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

    public function getAllReservasi()
    {
        $sql = "SELECT idreservasi_dokter, no_temu 
            FROM temu_dokter 
            ORDER BY idreservasi_dokter DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
