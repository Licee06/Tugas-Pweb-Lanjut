<?php
require_once 'models/Mahasiswa.php';

class MahasiswaController {
    private $model;

    public function __construct() {
        $this->model = new Mahasiswa();
    }

    public function index() {
        $data = $this->model->getAll();
        require 'views/mahasiswa_list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->add($_POST);
            header('Location: index.php');
        } else {
            require 'views/mahasiswa_add.php';
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($_POST);
            header('Location: index.php');
        } else {
            $id = $_GET['id'];
            $data = $this->model->getById($id);
            require 'views/mahasiswa_edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: index.php');
    }
}
?>
