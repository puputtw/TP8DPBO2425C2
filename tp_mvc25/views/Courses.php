<?php
class CoursesView {

    public function render($data) {
        $num = 1;

        $header = "
        
        <th>Lecturer ID</th>
        <th>Course Name</th>
        <th>Course Code</th>
        <th>Semester</th>
        <th>Actions</th>
        ";

        $rows = "";

        foreach ($data['courses'] as $row) {
            list($id, $lecturer_id, $course_name, $course_code, $semester) = $row;

            $rows .= "
                <tr class='text-center align-middle'>
                    <td>$lecturer_id</td>
                    <td>$course_name</td>
                    <td>$course_code</td>
                    <td>$semester</td>
                    <td>
                        <a href='index.php?page=courses&form=$id' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='index.php?page=courses&delete_id=$id' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>
            ";
            $num++;
        }

        $template = new Template("templates/table.html");
        $template->replace("XTITLE", "Lecturer Course");
        $template->replace("XBUTTON", "Course");
        $template->replace("XHEADER", $header);
        $template->replace("XTABLE", $rows);
        $template->replace("XCOURSE", "");
         $template->replace("XPAGE", "courses"); 

        $template->write();
    }

  public function fill($data) {
    $lecturers = $data['lecturers'];
    if ($data['main']) {
        list($id, $lecturer_id, $course_name, $course_code, $semester) = $data['main'];
    }

    $form = ($data['main'] ? "<input type='hidden' name='id' value='$id'>" : "");

    // DROPDOWN LECTURER - TAMPILKAN LECTURER ID
    $form .= "
    <div class='form-group mb-3'>
        <label>Lecturer ID</label>
        <select name='lecturer_id' class='form-control'>
            <option value=''>-- Select Lecturer ID --</option>";
            foreach ($lecturers as $l) {
                list($l_id, $l_name) = $l;
                $selected = ($data['main'] && $l_id == $lecturer_id) ? "selected" : "";
                $form .= "<option value='$l_id' $selected>$l_name</option>";

            }
    $form .= "</select></div>";

    // Course name & code input
    $form .= "
    <div class='form-group mb-3'>
        <label>Course Name</label>
        <input type='text' name='course_name' class='form-control'
        value='" . ($data['main'] ? $course_name : "") . "' required>
    </div>

    <div class='form-group mb-3'>
        <label>Course Code</label>
        <input type='text' name='course_code' class='form-control'
        value='" . ($data['main'] ? $course_code : "") . "' required>
    </div>

    <div class='form-group mb-3'>
        <label>Semester</label>
        <input type='text' name='semester' class='form-control'
        value='" . ($data['main'] ? $semester : "") . "' required>
    </div>

 
    ";

    $template = new Template("templates/form.html");
    $template->replace("XTITLE", $data['main'] ? "Edit Course" : "Add Course");
    $template->replace("XFORM", $form);
    $template->replace("XPAGE", "courses");
    $template->replace("XSEND", $data['main'] ? "update" : "create");
    $template->write();
   }
}