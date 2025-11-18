<?php 

include_once "models/DB.php";

class LecturerCourse extends DB{

    function create($lecturer_id, $course_name, $course_code, $semester){
        $query= "INSERT INTO lecturer_courses(lecturer_id, course_name,course_code, semester)
                 VALUES ('$lecturer_id', '$course_name', '$course_code', '$semester')";
        $this->execute($query);
    }


      function read($id = null) {
        $query = "SELECT c.id, c.lecturer_id, c.course_name, c.course_code, c.semester
                  FROM lecturer_courses c"
                  . ($id ? " WHERE c.id = $id" : "");
        return $this->execute($query);
    }

      function update($id, $lecturer_id, $course_name, $course_code, $semester) {
        $query = "UPDATE lecturer_courses
                  SET lecturer_id=$lecturer_id,
                      course_name='$course_name',
                      course_code='$course_code',
                      semester = '$semester'
                  WHERE id=$id";
        $this->execute($query);
    }

      function delete($id) {
        $query = "DELETE FROM lecturer_courses WHERE id=$id";
        $this->execute($query);
    }
}





