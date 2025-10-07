<?php
require_once 'User.php';

class Pemilik extends User
{
    protected $idpemilik;
    protected $no_wa;
    protected $alamat;

    public function set_data_user($nama, $email, $password, $no_wa = null, $alamat = null)
    {
        parent::set_data_user($nama, $email, $password);
        $this->no_wa = $no_wa;
        $this->alamat = $alamat;
    }

    public function create()
    {
        // 1️⃣ Insert ke tabel user
        $this->iduser = parent::tambahuser($this->nama, $this->email, $this->password);
        if (!$this->iduser) {
            throw new Exception("Gagal menambahkan user.");
        }

        // 2️⃣ Insert ke tabel pemilik
        $sql = "INSERT INTO pemilik (no_wa, alamat, iduser) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->no_wa, $this->alamat, $this->iduser]);
        $this->idpemilik = $this->conn->lastInsertId();

        // 3️⃣ Auto assign role “Pemilik” (pastikan idrole = 5 di tabel role)
        $sqlRole = "INSERT INTO role_user (iduser, idrole, status) VALUES (?, 5, 1)";
        $stmtRole = $this->conn->prepare($sqlRole);
        $stmtRole->execute([$this->iduser]);
    }

    public function get_user_by_id($idpemilik)
    {
        $sql = "SELECT u.iduser, u.nama, u.email, u.password,
                        p.idpemilik, p.no_wa, p.alamat
                FROM pemilik p
                JOIN user u ON p.iduser = u.iduser
                WHERE p.idpemilik = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idpemilik]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->idpemilik = $data['idpemilik'];
            $this->iduser = $data['iduser'];
            $this->nama = $data['nama'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->no_wa = $data['no_wa'];
            $this->alamat = $data['alamat'];
        }
        return $data;
    }

    public function getAllPemilik()
    {
        $sql = "SELECT p.idpemilik, u.nama, u.email, p.no_wa, p.alamat
                FROM pemilik p
                JOIN user u ON p.iduser = u.iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Ambil ID Pemilik berdasarkan user login
    public function getIdPemilikByUser($iduser)
    {
        $sql = "SELECT idpemilik FROM pemilik WHERE iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':iduser' => $iduser]);
        return $stmt->fetchColumn();
    }

    // 🔹 Ambil semua pet milik pemilik login
    public function getMyPets($iduser)
    {
        $idpemilik = $this->getIdPemilikByUser($iduser);
        if (!$idpemilik)
            return [];

        $sql = "SELECT 
                p.idpet,
                p.nama,
                p.tanggal_lahir,
                p.warna_tanda,
                p.jenis_kelamin,
                r.nama_ras AS ras,
                j.nama_jenis_hewan AS jenis_hewan
            FROM pet p
            JOIN ras_hewan r ON p.idras_hewan = r.idras_hewan
            JOIN jenis_hewan j ON r.idjenis_hewan = j.idjenis_hewan
            WHERE p.idpemilik = :idpemilik
            ORDER BY p.nama ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idpemilik' => $idpemilik]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // 🔹 Ambil semua rekam medis berdasarkan pemilik login
    public function getRekamMedisByPemilik($iduser)
    {
        $idpemilik = $this->getIdPemilikByUser($iduser);
        if (!$idpemilik)
            return [];

        $sql = "SELECT rm.idrekam_medis, p.nama AS nama_pet, d.nama_dokter, 
                        rm.diagnosa, rm.created_at
                FROM rekam_medis rm
                JOIN pet p ON rm.idpet = p.idpet
                JOIN dokter d ON rm.iddokter = d.iddokter
                WHERE p.idpemilik = :idpemilik
                ORDER BY rm.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idpemilik' => $idpemilik]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
