<?php
require_once __DIR__ . '/User.php';

class Dokter extends User
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function getAll()
    {
        $sql = "SELECT ru.idrole_user,
                        u.iduser,
                        u.nama,
                        u.email,
                        ru.status
                FROM role_user ru
                JOIN user u ON ru.iduser = u.iduser
                WHERE ru.idrole = 2";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // tambah dokter: buat user baru dan role_user
    public function create($nama, $email, $password)
    {
        // simpan ke user
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare(
            "INSERT INTO user (nama, email, password) VALUES (?, ?, ?)"
        );
        $stmt->execute([$nama, $email, $hash]);
        $iduser = $this->conn->lastInsertId();

        // simpan ke role_user dengan idrole=2
        $stmt2 = $this->conn->prepare(
            "INSERT INTO role_user (iduser, idrole, status) VALUES (?, 2, 1)"
        );
        $stmt2->execute([$iduser]);
        return $iduser;
    }

    public function delete($idrole_user) {

    $stmt = $this->conn->prepare("SELECT iduser FROM role_user WHERE idrole_user = ? AND idrole = 2");
    $stmt->execute([$idrole_user]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {

        $stmt2 = $this->conn->prepare("DELETE FROM role_user WHERE idrole_user = ?");
        $stmt2->execute([$idrole_user]);
        
        $stmt3 = $this->conn->prepare("DELETE FROM user WHERE iduser = ?");
        $stmt3->execute([$user['iduser']]);
    }
}

}