<?php

require_once __DIR__ . '/../DB/dbconnection.php';

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    public function getAllUsers()
    {
        $sql = "SELECT u.iduser, u.nama, u.email, r.nama_role
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getUserById($id)
    {
        $sql = "SELECT u.iduser, u.nama, u.email, r.nama_role
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole
            WHERE u.iduser = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
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

