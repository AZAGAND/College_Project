<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class RekamMedis
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    public function create($idreservasi, $diagnosa, $anamnesa, $temuan_klinis)
    {
        // 🔹 Ambil dokter pemeriksa dari temu_dokter
        $query = "SELECT idrole_user FROM temu_dokter WHERE idreservasi_dokter = :idreservasi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['idreservasi' => $idreservasi]);
        $dokter_pemeriksa = $stmt->fetchColumn();

        if (!$dokter_pemeriksa) {
            throw new Exception("Dokter pemeriksa tidak ditemukan untuk reservasi ini.");
        }

        // 🔹 Insert ke tabel rekam_medis
        $sql = "INSERT INTO rekam_medis
                (idreservasi_dokter, diagnosa, anamnesa, temuan_klinis, created_at, dokter_pemeriksa)
                VALUES (:idreservasi, :diagnosa, :anamnesa, :temuan_klinis, NOW(), :dokter)";
        $stmt2 = $this->conn->prepare($sql);
        $stmt2->execute([
            'idreservasi' => $idreservasi,
            'diagnosa' => $diagnosa,
            'anamnesa' => $anamnesa,
            'temuan_klinis' => $temuan_klinis,
            'dokter' => $dokter_pemeriksa
        ]);
    }

    // READ ALL
    public function getAll()
    {
        $sql = "SELECT 
                    rm.idrekam_medis,
                    rm.idreservasi_dokter AS idreservasi,
                    rm.diagnosa,
                    rm.anamnesa AS catatan,
                    rm.temuan_klinis,
                    rm.created_at AS tanggal,
                    td.no_temu,
                    u.nama AS nama_pemilik,
                    hewan.nama AS nama_pet,
                    du.nama AS nama_dokter
                FROM rekam_medis rm
                INNER JOIN temu_dokter td ON rm.idreservasi_dokter = td.idreservasi_dokter
                INNER JOIN pet hewan ON td.idpet = hewan.idpet
                INNER JOIN pemilik pm ON hewan.idpemilik = pm.idpemilik
                INNER JOIN user u ON pm.iduser = u.iduser
                INNER JOIN role_user ru ON td.idrole_user = ru.idrole_user
                INNER JOIN user du ON ru.iduser = du.iduser
                ORDER BY rm.idrekam_medis ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($idrekam_medis)
    {
        $sql = "SELECT 
                rm.idrekam_medis,
                rm.idreservasi_dokter,
                rm.diagnosa,
                rm.anamnesa,
                rm.temuan_klinis,
                rm.created_at,
                td.no_temu,
                p.nama AS nama_pemilik,
                pt.nama AS nama_pet
            FROM rekam_medis rm
            JOIN temu_dokter td ON rm.idreservasi_dokter = td.idreservasi_dokter
            JOIN pet pt ON td.idpet = pt.idpet
            JOIN pemilik pm ON pt.idpemilik = pm.idpemilik
            JOIN user p ON pm.iduser = p.iduser
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

    public function update($idrekam_medis, $diagnosa, $anamnesa, $temuan_klinis)
    {
        $sql = "UPDATE rekam_medis 
            SET diagnosa = :diagnosa, 
                anamnesa = :anamnesa, 
                temuan_klinis = :temuan_klinis
            WHERE idrekam_medis = :idrekam_medis";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':diagnosa', $diagnosa, PDO::PARAM_STR);
        $stmt->bindParam(':anamnesa', $anamnesa, PDO::PARAM_STR);
        $stmt->bindParam(':temuan_klinis', $temuan_klinis, PDO::PARAM_STR);
        $stmt->bindParam(':idrekam_medis', $idrekam_medis, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}