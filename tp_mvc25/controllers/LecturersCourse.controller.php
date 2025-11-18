<?php

include_once "Config.php";
include_once "models/LecturerCourse.php";
include_once "models/Lecturers.php";
include_once "views/Courses.php";

class CoursesController {

    private $course;
    private $lecturer;

    public function __construct() {
        // Object Course
        $this->course = new LecturerCourse(
            Config::$servername,
            Config::$username,
            Config::$password,
            Config::$db_name
        );

        // Object Lecturer untuk dropdown
        $this->lecturer = new Lecturers(
            Config::$servername,
            Config::$username,
            Config::$password,
            Config::$db_name
        );
    }

    // INDEX (TABEL)
    public function index() {
        $this->course->open();
        $this->course->read();

        $data = ['courses' => []];

        while ($row = $this->course->getResult()) {
            $data['courses'][] = $row;
        }

        $this->course->close();

        $view = new CoursesView();
        $view->render($data);
    }

    // FORM TAMBAH / EDIT
    public function form($id = null) {

        $this->course->open();
        $this->lecturer->open();

        $data = [];

        // Ambil semua lecturer untuk dropdown
        $this->lecturer->read();
        $data['lecturers'] = [];

        while ($row = $this->lecturer->getResult()) {
            $data['lecturers'][] = $row;
        }

        // Jika mode EDIT
        if (is_numeric($id)) {
            $this->course->read($id);
            $data['main'] = $this->course->getResult();
        } 
        else {
            $data['main'] = null;
        }

        $this->course->close();
        $this->lecturer->close();

        // Kirim ke view
        $view = new CoursesView();
        $view->fill($data);
    }

    // CREATE COURSE
    public function create($data) {

        $this->course->open();
        $this->course->create(
            $data['lecturer_id'],
            $data['course_name'],
            $data['course_code'],
            $data['semester'] 
        );
        $this->course->close();

        header("Location: index.php?page=courses");
        exit;
    }

    // UPDATE COURSE
    public function update($data) {

        $this->course->open();
        $this->course->update(
            $data['id'],
            $data['lecturer_id'],
            $data['course_name'],
            $data['course_code'],
            $data['semester']
        );
        $this->course->close();

        header("Location: index.php?page=courses");
        exit;
    }

    // DELETE COURSE
    public function delete($id) {

        $this->course->open();
        $this->course->delete($id);
        $this->course->close();

        header("Location: index.php?page=courses");
        exit;
    }
}
