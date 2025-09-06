<?php
require_once __DIR__ . '/../DB/dbconnection.php';
require_once __DIR__ . '/../Class/Jenis_Hewan.php';

class Jenis_Hewan {
    private $model;

    public function __construct($db) {
        $this->model = new JenisHewan($db);
    }

    public function index() {
        return $this->model->getAll();
    }

    public function store($nama) {
        return $this->model->create($nama);
    }

    public function update($id, $nama) {
        return $this->model->update($id, $nama);
    }

    public function destroy($id) {
        return $this->model->delete($id);
    }
}
