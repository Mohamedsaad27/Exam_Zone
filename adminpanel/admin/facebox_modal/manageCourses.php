<?php
include("../../../conn.php");
$id = $_GET['id'];

$selExmne = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$id' ")->fetch(PDO::FETCH_ASSOC);
$selCourses = $conn->query("SELECT * FROM examinee_course_tbl WHERE examinee_id='$id'")->fetchAll(PDO::FETCH_ASSOC);
// if ($selCourses) {
//     $selectedcourse = $selCourses['cou_id'];
// } else {
//     $selectedcourse = "";
// }



if (isset($_GET['submit'])) {
    $delete = $conn->query("DELETE FROM examinee_course_tbl WHERE examinee_id='$id'");
    $selectedCourses = $_GET['courses'];
    // Insert new records for the selected courses
    if (!empty($selectedCourses)) {
        $values = array();
        foreach ($selectedCourses as $courseId => $value) {
            // Escape the values to prevent SQL injection
            $examineeId = $conn->quote($examineeId);
            $courseId = $conn->quote($courseId);

            // Prepare the values for the INSERT statement
            $values[] = "($examineeId, $courseId)";
        }

        // Insert the values into the database
        $insertQuery = "INSERT INTO examinee_course_tbl (examinee_id, cou_id) VALUES " . implode(',', $values);
        if ($conn->query($insertQuery)) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failedd");
        }
        

    }
} else {
    $res = array("res" => "failed");
}

?>

<fieldset style="width: 543px;">
    <legend>
        <i class="facebox-header">
            <i class="edit large icon"></i>&nbsp;Manage Courses <b>(
                <?php echo strtoupper($selExmne['exmne_fullname']); ?>)
            </b>
        </i>
    </legend>
    <style>
        .checkbox-label {
            display: block;
            margin-bottom: 10px;
        }

        .checkbox-label input[type="checkbox"] {
            margin-right: 5px;
        }

        .checkbox-separator {
            border-top: 1px solid #ccc;
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>
    <div class="col-md-12 mt-4">
        <form method="get" id="manageCoursesFrm" action="query/manageCoursesExe.php">
            <div class="form-group">
                <script>
                    alert(<?php echo $selCourses; ?>)
                </script>
                <legend>Courses</legend>
                <?php
                $selCourse = $conn->query("SELECT * FROM course_tbl");
                $count = 0;
                while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) {
                    $courseId = $selCourseRow['cou_id'];
                    $courseName = $selCourseRow['cou_name'];
                    $checked = '';
                    // if ($selectedcourse == $courseId) {
                    //     $checked = 'checked';
                    // }
                    foreach ($selCourses as $course) {
                        if ($course['cou_id'] == $courseId) {
                            $checked = 'checked';
                            break;
                        }
                    }
                    echo "<label class='checkbox-label'><input type='checkbox' name='courses[]' value='$courseId' $checked> $courseName</label>";
                    $count++;
                    if ($count < $selCourse->rowCount()) {
                        echo "<div class='checkbox-separator'></div>";
                    }
                }
                ?>
            </div>
            <div class="form-group" align="right">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-sm btn-primary" id="saveBtn">Save Now</button>
            </div>
        </form>
    </div>
</fieldset>