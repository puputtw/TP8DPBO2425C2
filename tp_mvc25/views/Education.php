<?php
class EducationView {

    // ===========================
    // TABEL UTAMA
    // ===========================
    public function render($data) {
        $header = "
        <th>Lecturer</th>
        <th>Degree</th>
        <th>Field of Study</th>
        <th>University</th>
        <th>Graduation Year</th>
        <th>Actions</th>
        ";

        $rows = "";
        foreach ($data['education'] as $row) {
            // row = [id, lecturer_id, degree, field, university, year]
            list($id, $lecturer_id, $degree, $field, $university, $year) = $row;

            $rows .= "
            <tr class='text-center align-middle'>
                <td>$lecturer_id</td>  <!-- tampil ID dosen -->
                <td>$degree</td>
                <td>$field</td>
                <td>$university</td>
                <td>$year</td>
                <td>
                    <a href='index.php?page=education&form=$id' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='index.php?page=education&delete_id=$id' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
        }

        $template = new Template("templates/table.html");
        $template->replace("XTITLE", "Lecturer Education");
        $template->replace("XBUTTON", "Education");
        $template->replace("XHEADER", $header);
        $template->replace("XTABLE", $rows);
        $template->replace("XPAGE", "education");
        $template->write();
    }

    // ===========================
    // FORM TAMBAH / EDIT
    // ===========================
    public function fill($data) {
        $lecturers = $data['lecturers'];

        if ($data['main']) {
            list($id, $lecturer_id, $degree, $field, $university, $year) = $data['main'];
        }

        $form = ($data['main'] ? "<input type='hidden' name='id' value='$id'>" : "");

        // Dropdown Lecturer (nama dosen tapi value = ID)
        $form .= "<div class='form-group mb-3'>
                    <label>Lecturer</label>
                    <select name='lecturer_id' class='form-control'>
                        <option value=''>-- Select Lecturer --</option>";
        foreach ($lecturers as $l) {
            list($l_id, $l_name) = $l;
            $selected = ($data['main'] && $l_id == $lecturer_id) ? "selected" : "";
            $form .= "<option value='$l_id' $selected>$l_name</option>";
        }
        $form .= "</select></div>";

        // Degree
        $form .= "<div class='form-group mb-3'>
                    <label>Degree</label>
                    <input type='text' name='degree' class='form-control' value='" . ($data['main'] ? $degree : "") . "' required>
                  </div>";

        // Field of Study
        $form .= "<div class='form-group mb-3'>
                    <label>Field of Study</label>
                    <input type='text' name='field_of_study' class='form-control' value='" . ($data['main'] ? $field : "") . "' required>
                  </div>";

        // University
        $form .= "<div class='form-group mb-3'>
                    <label>University</label>
                    <input type='text' name='university' class='form-control' value='" . ($data['main'] ? $university : "") . "' required>
                  </div>";

        // Graduation Year
        $form .= "<div class='form-group mb-3'>
                    <label>Graduation Year</label>
                    <input type='number' name='graduation_year' class='form-control' value='" . ($data['main'] ? $year : "") . "' required>
                  </div>";

        $template = new Template("templates/form.html");
        $template->replace("XTITLE", $data['main'] ? "Edit Education" : "Add Education");
        $template->replace("XFORM", $form);
        $template->replace("XPAGE", "education");
        $template->replace("XSEND", $data['main'] ? "update" : "create");
        $template->write();
    }
}
