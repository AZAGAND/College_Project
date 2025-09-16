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
        // Insert ke user, dapatkan id user
        $this->iduser = parent::tambahuser($this->nama, $this->email, $this->password);

        if (!$this->iduser) {
            throw new Exception("Gagal menambahkan user.");
        }

        // Insert ke pemilik
        $sql = "INSERT INTO pemilik (no_wa, alamat, iduser) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->no_wa, $this->alamat, $this->iduser]);
        $this->idpemilik = $this->conn->lastInsertId();

        // Auto-assign role "User" (misalnya idrole = 5)
        $sqlRole = "INSERT INTO role_user (iduser, idrole, status) VALUES (?, 5, 1)";
        $stmtRole = $this->conn->prepare($sqlRole);
        $stmtRole->execute([$this->iduser]);
    }


    // ✅ Override get_user_by_id: cari berdasarkan idpemilik
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

    // ✅ Getter tambahan
    public function getIdPemilik()
    {
        return $this->idpemilik;
    }

    public function getNoWa()
    {
        return $this->no_wa;
    }

    public function getAlamat()
    {
        return $this->alamat;
    }
}
