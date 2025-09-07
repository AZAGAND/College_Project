<?php
require_once __DIR__ . '/../Class/Ras_hewan.php';

class Ras_Hewan {
    private $model;

    public function __construct($db) {
        $this->model = new RasHewan($db);
    }

    public function getall() {
        return $this->model->getAll();
    }

    public function store($nama, $idjenis) {
        return $this->model->create($nama, $idjenis);
    }

    public function destroy($id) {
        return $this->model->delete($id);
    }

    public function getJenis() {
        return $this->model->getJenis();
    }
    public function getGroupedData() {
        $dataRas = $this->model->getAll();
        $groupedData = [];
        
        foreach ($dataRas as $ras) {
            $jenisNama = $ras['nama_jenis_hewan'];
            
            if (!isset($groupedData[$jenisNama])) {
                $groupedData[$jenisNama] = [
                    'jenis_nama' => $jenisNama,
                    'ras_list' => []
                ];
            }
            
            $groupedData[$jenisNama]['ras_list'][] = [
                'id' => $ras['idras_hewan'],
                'nama' => $ras['nama_ras']
            ];
        }
        
        return $groupedData;
    }
}

