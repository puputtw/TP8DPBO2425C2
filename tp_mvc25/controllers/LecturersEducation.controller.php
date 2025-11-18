<?php

include_once "Config.php";
include_once "models/LecturerEducation.php";
include_once "models/Lecturers.php";
include_once "views/Education.php";

class EducationController {

    private $education;
    private $lecturer;

    public function __construct() {

        $this->education = new LecturerEducation(
            Config::$servername,
            Config::$username,
            Config::$password,
            Config::$db_name
        );

        $this->lecturer = new Lecturers(
            Config::$servername,
            Config::$username,
            Config::$password,
            Config::$db_name
        );
    }

    // ==============================
    // INDEX (LIST)
    // ==============================
    public function index() {
        $this->education->open();
        $this->education->read();

        $data = ['education' => []];

        while ($row = $this->education->getResult()) {
            $data['education'][] = $row;
        }

        $this->education->close();

        $view = new EducationView();
        $view->render($data);
    }

    // FORM CREATE / EDIT
    public function form($id = null) {
        $this->education->open();
        $this->lecturer->open();

        // ambil semua dosen untuk dropdown
        $this->lecturer->read();
        $data['lecturers'] = [];

        while ($row = $this->lecturer->getResult()) {
            $data['lecturers'][] = $row;
        }

        // ambil data untuk edit
        if ($id !== null) {
            $this->education->read($id);
            $data['main'] = $this->education->getResult();
        } else {
            $data['main'] = null;
        }

        $view = new EducationView();
        $view->fill($data);

        $this->education->close();
        $this->lecturer->close();
    }
  
    // CREATE
  
    public function create($data) {
    $this->education->open();
    $this->education->create(
        $data['lecturer_id'],
        $data['degree'],
        $data['field_of_study'], 
        $data['university'],
        $data['graduation_year']
    );
    $this->education->close();

        header("Location: index.php?page=education");
    }

    // UPDATE
   public function update($data) {  // TERIMA ARRAY $data, BUKAN PARAMETER TERPISAH
    $this->education->open();
    $this->education->update(
        $data['id'],
        $data['lecturer_id'],
        $data['degree'], 
        $data['field_of_study'],
        $data['university'],
        $data['graduation_year']
    );
    $this->education->close();

        header("Location: index.php?page=education");
    }

    // DELETE
    public function delete($id) {

        $this->education->open();
        $this->education->delete($id);
        $this->education->close();

        header("Location: index.php?page=education");
    }
}
