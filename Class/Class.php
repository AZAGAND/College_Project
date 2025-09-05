<?php

require_once __DIR__ . '/../DB/dbconnection.php';

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    public function getallusers()
    {
        $stmt = $this->conn->prepare("SELECT iduser,nama,email FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getuserbyid($id)
    {
        $stmt = $this->conn->prepare("SELECT iduser,nama,email FROM user WHERE iduser = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahuser($nama, $email, $password)
    {
        // Cek email sudah ada atau belum
        $check = $this->conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $check->bindParam(':email', $email);
        $check->execute();

        if ($check->fetchColumn() > 0) {
            throw new Exception("Email sudah terdaftar!");
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO user (nama, email, password) VALUES (:nama, :email, :password)");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        return $stmt->execute();
    }

    public function updateuser($id, $nama, $email)
    {
        $stmt = $this->conn->prepare("UPDATE user SET nama = :nama, email = :email WHERE iduser = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
    public function deleteuser($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM user where iduser = ?");
        $stmt->bindParam(1, $id);
        return $stmt->execute([$id]);
    }
}

class role
{
    private $conn;

    public function __construct(DBConnection $db)
    {
        $this->conn = $db->getConnection();
    }

    public function getallroles()
    {
        $stmt = $this->conn->prepare("Select * from role");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getrolesbyuser($iduser)
    {
        $sql = "SELECT r.idrole,r.nama_role
            FROM role_user ru
            JOIN role r ON ru.idrole = r.idrole
            WHERE ru.iduser = :iduser AND ru.status = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":iduser" => $iduser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addrole($nama_role)
    {
        $stmt = $this->conn->prepare("INSERT INTO role (nama_role) VALUES (?)");
        return $stmt->execute([$nama_role]);
    }
    public function updaterole($id, $nama_role)
    {
        $stmt = $this->conn->prepare("UPDATE role SET nama_role = ? WHERE idrole = ?");
        return $stmt->execute([$nama_role, $id]);
    }
    public function deleterole($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM role WHERE idrole = ?");
        return $stmt->execute([$id]);
    }
}
?>