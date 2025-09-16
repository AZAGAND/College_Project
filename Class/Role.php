<?php
class role
{
    private $conn;

    public function __construct(DBConnection $db)
    {
        $this->conn = $db->getConnection();
    }

    public function getAllUsers()
    {
        $sql = "SELECT iduser, nama, email FROM user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRoles()
    {
        $sql = "SELECT idrole, nama_role FROM role";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getrolesbyuser($iduser)
    {
        $sql = "SELECT r.idrole, r.nama_role, ru.idrole_user, ru.status
                FROM role_user ru
                JOIN role r ON ru.idrole = r.idrole
                WHERE ru.iduser = :iduser";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":iduser" => $iduser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            echo "<pre>DEBUG: Tidak ada role ditemukan</pre>";
        }
        return $result;
    }

    public function addrole($iduser, $idrole)
    {
        $sql = "INSERT INTO role_user (iduser, idrole, status) VALUES (?, ?, 1)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$iduser, $idrole]);

        if (!$result) {
            echo "<pre>DEBUG: Tidak ada role ditemukan</pre>";
        }
        return $result;
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

    public function getAllUsersWithRoles()
    {
        $sql = "SELECT u.iduser, u.nama, u.email, r.nama_role, ru.idrole_user, ru.status
            FROM user u
            LEFT JOIN role_user ru ON u.iduser = ru.iduser
            LEFT JOIN role r ON ru.idrole = r.idrole";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $id = $row['iduser'];
            if (!isset($users[$id])) {
                $users[$id] = [
                    'iduser' => $row['iduser'],
                    'nama' => $row['nama'],
                    'email' => $row['email'],
                    'roles' => []
                ];
            }
            if ($row['nama_role']) {
                $users[$id]['roles'][] = [
                    'idrole_user' => $row['idrole_user'],
                    'nama_role' => $row['nama_role'],
                    'status' => $row['status']
                ];
            }
        }
        return $users;
    }


    public function toggleRoleStatus($idrole_user)
    {
        $sql = "UPDATE role_user SET status = IF(status=1,0,1) WHERE idrole_user = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$idrole_user]);
    }

    public function deleteRoleFromUser($idrole_user)
    {
        $sql = "DELETE FROM role_user WHERE idrole_user = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$idrole_user]);
    }
}
