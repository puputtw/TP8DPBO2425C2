<?php
include_once "models/DB.php";

class LecturerEducation extends DB {

    function create($lecturer_id, $degree, $field, $university, $year) {
        $query = "INSERT INTO lecturer_education (lecturer_id, degree, field_of_study, university, graduation_year)
                  VALUES ('$lecturer_id', '$degree', '$field', '$university', '$year')";
        $this->execute($query);
    }

    function read($id = null) {
        $query = "SELECT e.id, e.lecturer_id, l.name AS lecturer_name, e.degree, e.field_of_study, e.university, e.graduation_year
                  FROM lecturer_education e
                  JOIN lecturers l ON e.lecturer_id = l.id"
                  . ($id ? " WHERE e.id = $id" : "")
                  . " ORDER BY e.id ASC";
        return $this->execute($query);
    }

    function update($id, $lecturer_id, $degree, $field, $university, $year) {
        $query = "UPDATE lecturer_education
                  SET lecturer_id=$lecturer_id,
                      degree='$degree',
                      field_of_study='$field',
                      university='$university',
                      graduation_year='$year'
                  WHERE id=$id";
        $this->execute($query);
    }

    function delete($id) {
        $query = "DELETE FROM lecturer_education WHERE id=$id";
        $this->execute($query);
    }
}
