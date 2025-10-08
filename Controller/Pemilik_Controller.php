<?php
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Owner.php';
require_once __DIR__ . '/../Class/Rekam_Medis.php';
require_once __DIR__ . '/../Class/Detail_Rekam_Medis.php';
require_once __DIR__ . '/../Class/Reservasi.php';

class PemilikController
{
    private $db;
    private $pemilik;
    private $rekam;
    private $detail;
    private $reservasi;

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->pemilik = new Pemilik($this->db);
        $this->rekam = new RekamMedis($this->db);
        $this->detail = new RekamMedisDetail($this->db);
        $this->reservasi = new Reservasi($this->db);
    }

    /** 🐾 Hewan */
    public function listHewan($iduser)
    {
        return $this->pemilik->getMyPets($iduser);
    }

    /** 📅 Reservasi */
    public function listReservasi($iduser)
    {
        return $this->pemilik->getMyReservations($iduser);
    }

    /** 🩺 Rekam Medis */
    public function listRekamMedis($iduser)
    {
        return $this->pemilik->getMyRekamMedis($iduser);
    }

    /** 🔍 Detail Rekam Medis */
    public function detailRekamMedis($idrekam, $iduser)
    {
        $rekam = $this->rekam->getById($idrekam);
        $details = $this->detail->getByRekamMedis($idrekam);
        $idpemilik = $this->pemilik->getIdPemilikByUser($iduser);

        
        if (!$rekam || $rekam['idpemilik'] != $idpemilik) {
            throw new Exception("Akses ditolak! Rekam medis tidak milik Anda.");
        }

        return [
            'rekam' => $rekam,
            'details' => $details
        ];
    }

    /** 🧠 Process logic → langsung load view */
    public function process($page, $iduser, $params = [])
    {
        switch ($page) {
            case 'hewan':
                $data = $this->listHewan($iduser);
                include __DIR__ . '/../Roles/Pemilik/Feature/List_Hewan.php';
                break;

            case 'reservasi':
                $data = $this->listReservasi($iduser);
                include __DIR__ . '/../Roles/Pemilik/Feature/List_Reservasi.php';
                break;

            case 'rekam_medis':
                $data = $this->listRekamMedis($iduser);
                include __DIR__ . '/../Roles/Pemilik/Feature/List_Rekam_Medis.php';
                break;

            case 'rekam_detail':
                $idrekam = $params['idrekam_medis'] ?? null;
                if (!$idrekam)
                    throw new Exception("ID Rekam tidak valid.");
                $data = $this->detailRekamMedis($idrekam, $iduser);
                include __DIR__ . '/../Roles/Pemilik/Feature/List_Detail_Rekam_Medis.php';
                break;

            default:
                throw new Exception("Halaman tidak dikenali.");
        }
    }
}
