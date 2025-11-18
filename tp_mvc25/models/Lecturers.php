<?php 
include_once "models/DB.php";

class Lecturers extends DB {
    function create($name, $nidn, $phone, $join_date) {
        $query = "INSERT INTO lecturers(name, nidn,phone,join_date)
                   VALUES('$name', '$nidn', '$phone', '$join_date')";
        $this->execute($query);


    }

    function read($id = null) {
        $query = "SELECT * FROM lecturers "
               . ($id ? "WHERE id = $id" : "");
        $this->execute($query);
    }

    function update($id, $name, $nidn, $phone, $join_date) {
        $query = "UPDATE lecturers
                  SET name = '$name', nidn = '$nidn', phone = '$phone', join_date = '$join_date'
                  WHERE id = $id";
        $this->execute($query);
    }

    function delete($id){
        $query = "DELETE FROM lecturers  WHERE id = $id";
        $this  ->execute($query);  

    }


}