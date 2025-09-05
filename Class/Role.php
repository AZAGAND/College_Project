<?php
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