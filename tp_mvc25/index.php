<?php
include_once "controllers/Lecturers.controller.php";
include_once "controllers/LecturersCourse.controller.php";
include_once "controllers/LecturersEducation.controller.php";
include_once "views/Template.class.php";

// Tentukan page yang aktif
$page = isset($_GET['page']) ? $_GET['page'] : 'lecturers';

// Tentukan controller berdasarkan page
if ($page == "lecturers") {
    $controller = new LecturersController();
}
else if ($page == "courses") {
    $controller = new CoursesController();
}
else if ($page == "education") {
    $controller = new EducationController();
}
else {
    die("Invalid page");
}

// ======= ROUTING CRUD =======

// CREATE
if (isset($_POST['create'])) {
    $controller->create($_POST);
}

// UPDATE
else if (isset($_POST['update'])) {
    $controller->update($_POST);
}

// DELETE
else if (!empty($_GET['delete_id'])) {
    $controller->delete($_GET['delete_id']);
}

// FORM (add/edit)
else if (!empty($_GET['form'])) {
    $id = ($_GET['form'] == 'X') ? null : $_GET['form'];
    $controller->form($id);
}

// DEFAULT → TAMPILAN TABEL
else {
    $controller->index();
}