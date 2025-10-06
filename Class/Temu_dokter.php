<?php
require_once __DIR__ . '/../DB/dbconnection.php';

class TemuDokter
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    // 🔹 Generate nomor temu dokter (format: DMY-urutan harian)
    private function generateNoTemu()
    {
        $tanggalKode = date('dmy'); // contoh: 180925
        $sql = "SELECT no_temu 
                FROM temu_dokter 
                WHERE no_temu LIKE :kode 
                ORDER BY no_temu DESC 
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':kode' => $tanggalKode . '%']);
        $lastRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $nextUrut = 1;
        if ($lastRow) {
            $parts = explode('-', $lastRow['no_temu']);
            if (isset($parts[1])) {
                $nextUrut = intval($parts[1]) + 1;
            }
        }

        return $tanggalKode . '-' . $nextUrut;
    }

    // 🔹 CREATE
    public function create($idpet, $iddokter)
    {
        $no_temu = $this->generateNoTemu();

        $sql = "INSERT INTO temu_dokter (no_temu, idpet, idrole_user, tanggal) 
            VALUES (:no_temu, :idpet, :idrole_user, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':no_temu' => $no_temu,
            ':idpet' => $idpet,
            ':idrole_user' => $iddokter
        ]);
    }



    // 🔹 READ ALL
    // READ ALL
    public function getAll()
    {
        $sql = "SELECT td.no_temu,
                    td.tanggal,
                    p.nama AS nama_pet,
                    jh.nama_jenis_hewan AS jenis_hewan,
                    u.nama AS nama_pemilik,
                    d.nama AS nama_dokter,
                    td.idrole_user AS iddokter
            FROM temu_dokter td
            JOIN pet p ON td.idpet = p.idpet
            JOIN pemilik pm ON p.idpemilik = pm.idpemilik
            JOIN user u ON pm.iduser = u.iduser
            JOIN role_user ru ON td.idrole_user = ru.idrole_user
            JOIN user d ON ru.iduser = d.iduser
            JOIN ras_hewan rh ON p.idras_hewan = rh.idras_hewan
            JOIN jenis_hewan jh ON rh.idjenis_hewan = jh.idjenis_hewan
            ORDER BY td.tanggal DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }




    // READ BY NO
    public function getByNo($no_temu)
    {
        $sql = "SELECT td.no_temu,
                    td.tanggal,
                    pt.nama AS nama_pet,
                    u.nama AS nama_pemilik,
                    d.nama AS nama_dokter
            FROM temu_dokter td
            JOIN pet pt ON td.idpet = pt.idpet
            JOIN pemilik p ON pt.idpemilik = p.idpemilik
            JOIN user u ON p.iduser = u.iduser
            JOIN user d ON td.iddokter = d.iduser
            WHERE td.no_temu = :no";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':no' => $no_temu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // 🔹 UPDATE
    public function update($no_temu, $keluhan, $iddokter)
    {
        $sql = "UPDATE temu_dokter 
                SET keluhan = :keluhan, iddokter = :iddokter 
                WHERE no_temu = :no";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':no' => $no_temu,
            ':iddokter' => $iddokter
        ]);
    }

    // 🔹 DELETE
    public function delete($no_temu)
    {
        $sql = "DELETE FROM temu_dokter WHERE no_temu = :no";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':no' => $no_temu]);
    }

    public function getAllPemilik()
    {
        $sql = "SELECT pm.idpemilik, u.nama AS nama_pemilik
            FROM pemilik pm
            JOIN user u ON pm.iduser = u.iduser
            ORDER BY u.nama ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPetByPemilik($idpemilik)
    {
        $sql = "SELECT 
                p.idpet,
                p.nama AS nama_pet,
                jh.nama_jenis_hewan AS jenis_hewan,
                u.nama AS nama_pemilik
            FROM pet p
            JOIN pemilik pm ON p.idpemilik = pm.idpemilik
            JOIN user u ON pm.iduser = u.iduser
            JOIN ras_hewan rh ON p.idras_hewan = rh.idras_hewan
            JOIN jenis_hewan jh ON rh.idjenis_hewan = jh.idjenis_hewan
            ORDER BY u.nama ASC, p.nama ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllDokter()
    {
        $sql = "SELECT ru.idrole_user, u.nama AS nama_dokter
            FROM role_user ru
            JOIN user u ON ru.iduser = u.iduser
            WHERE ru.idrole = 2 AND ru.status = 1
            ORDER BY u.nama ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

