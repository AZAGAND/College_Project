<?php
class Login {
    private $userObj;
    private $roleObj;

    public function __construct($db) {
        $this->userObj = new User($db);
        $this->roleObj = new Role($db);
    }

    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            return "Email dan password harus diisi!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Format email tidak valid!";
        }

        $user = $this->userObj->getUserByEmail($email);

        if (!$user) {
            return "Email tidak ditemukan!";
        }

        if (!password_verify($password, $user['password'])) {
            return "Password salah!";
        }

        // Ambil role user
        $roles = $this->roleObj->getRolesByUser($user['iduser']);

        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = [
            'id'    => $user['iduser'],
            'nama'  => $user['nama'],
            'email' => $user['email'],
            'roles' => $roles
        ];

        // Kalau cuma 1 role → redirect langsung
        if (count($roles) == 1) {
            $role = $roles[0]['nama_role'];
            switch ($role) {
                case 'Administrator':
                    header("Location: ../../Roles/Admin/admin.php");
                    break;
                case 'Dokter':
                    header("Location: ../../Roles/Dokter/dokter_dashboard.php");
                    break;
                case 'Perawat':
                    header("Location: ../../Roles/Perawat/perawat_dashboard.php");
                    break;
                case 'Resepsionis':
                    header("Location: ../../Roles/Resepsionis/resepsionis_dashboard.php");
                    break;
                default:
                    return "Role tidak dikenali!";
            }
            exit;
        }

        header("Location: ../role_management.php");
        exit;
    }
}
