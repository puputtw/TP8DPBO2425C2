<?php

include_once "Config.php";
include_once "models/Lecturers.php";
include_once "views/Lecturers.view.php";

class LecturersController {

    private $lecturer;

    public function __construct() {
        $this->lecturer = new Lecturers(
            Config::$servername,
            Config::$username,
            Config::$password,
            Config::$db_name
        );
    }

    // HALAMAN INDEX (TABEL)
    public function index() {
        $this->lecturer->open();
        $this->lecturer->read();

        $data = ['lecturers' => []];

        while ($row = $this->lecturer->getResult()) {
            $data['lecturers'][] = $row;
        }

        $this->lecturer->close();

        $view = new LecturersView();
        $view->render($data);
    }

    // FORM TAMBAH / EDIT
    public function form($id = null) {

        $this->lecturer->open();
        $data = [];

        if (is_numeric($id)) {
            $this->lecturer->read($id);
            $data['main'] = $this->lecturer->getResult();
        } else {
            $data['main'] = null;
        }

        $this->lecturer->close();

        $view = new LecturersView();
        $view->fill($data);
    }

    // CREATE
    public function create($data) {

        $this->lecturer->open();
        $this->lecturer->create(
            $data['name'],
            $data['nidn'],
            $data['phone'],
            $data['join_date']
            
        );
        $this->lecturer->close();

        header("Location: index.php?page=lecturers");
        exit;
    }

    // UPDATE
    public function update($data) {

        $this->lecturer->open();
        $this->lecturer->update(
            $data['id'],
            $data['name'],
            $data['nidn'],
            $data['phone'],
            $data['join_date']
        );
        $this->lecturer->close();

        header("Location: index.php?page=lecturers");
        exit;
    }

    // DELETE
    public function delete($id) {
        $this->lecturer->open();
        $this->lecturer->delete($id);
        $this->lecturer->close();

        header("Location: index.php?page=lecturers");
        exit;
    }
}
