<?php

class LecturersView {

    public function render($data) {
        $num = 1;

        $header = "
        <th>ID</th>
        <th>Name</th>
        <th>NIDN</th>
        <th>Phone</th>
        <th>Join Date</th>
        <th>Actions</th>

        ";

        $rows = "";
        foreach ($data['lecturers'] as $row) {
            list($id, $name, $nidn, $phone, $join_date) = $row;
            $rows .= "
                <tr class='text-center align-middle'>
                    <td>$num</td>
                    <td>$name</td>
                    <td>$nidn</td>
                    <td>$phone</td>
                    <td>$join_date</td>
                    <td>
                      <a href='index.php?page=lecturers&form=$id' class='btn btn-warning btn-sm'>Edit</a>
                      <a href='index.php?page=lecturers&delete_id=$id' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>
            ";
            $num++;
        }

        $template = new Template("templates/table.html");
        $template->replace("XTITLE", "Lecturer List");
        $template->replace("XBUTTON", "Lecturer");
        $template->replace("XHEADER", $header);
        $template->replace("XTABLE", $rows);
        $template->replace("XLECTURER", ""); 
            $template->replace("XPAGE", "lecturers");
        $template->write();
    }

    public function fill($data) {
        if ($data['main']) {
            list($id, $name, $nidn, $phone, $join_date) = $data['main'];
        }

        $form = ($data['main'] ? "<input type='hidden' name='id' value='$id'>" : "") . "
            <div class='form-group mb-3'>
                <label>Name</label>
                <input type='text' name='name' class='form-control'
                value='" . ($data['main'] ? $name : "") . "' required>
            </div>

            <div class='form-group mb-3'>
                <label>NIDN</label>
                <input type='text' name='nidn' class='form-control'
                value='" . ($data['main'] ? $nidn : "") . "' required>
            </div>

            <div class='form-group mb-3'>
                <label>Phone</label>
                <input type='text' name='phone' class='form-control'
                value='" . ($data['main'] ? $phone : "") . "' required>
            </div>

            <div class='form-group mb-3'>
                <label>Join Date</label>
                <input type='date' name='join_date' class='form-control'
                value='" . ($data['main'] ? $join_date : "") . "' required>
            </div>
        ";

       $template = new Template("templates/form.html");
        $template->replace("XTITLE", $data['main'] ? "Edit Lecturer" : "Add Lecturer");
        $template->replace("XFORM", $form);
        $template->replace("XPAGE", "lecturers");
        $template->replace("XSEND", $data['main'] ? "update" : "create");
        $template->write();
    }
}
