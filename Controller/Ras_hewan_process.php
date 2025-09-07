<?php
require_once __DIR__ . '/../Class/Ras_hewan.php';

class Ras_Hewan {
    private $model;

    public function __construct($db) {
        $this->model = new RasHewan($db);
    }

    public function index() {
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
}
