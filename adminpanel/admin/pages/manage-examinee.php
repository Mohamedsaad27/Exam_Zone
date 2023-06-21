<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>MANAGE STUDENTS</div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Students List
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Course</th>
                                <th>Year level</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>status</th>
                                <th>procedures</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selExmne = $conn->query("SELECT * FROM examinee_tbl ORDER BY exmne_id DESC ");
                            if ($selExmne->rowCount() > 0) {
                                while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) {
                                    $id = $selExmneRow['exmne_id'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $selExmneRow['exmne_fullname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $selExmneRow['exmne_gender']; ?>
                                        </td>
                                        <td>
                                            <?php echo $selExmneRow['exmne_birthdate']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $exmneCourses = $conn->query("SELECT * FROM examinee_course_tbl WHERE examinee_id='$id'")->fetchAll(PDO::FETCH_ASSOC);
                                            if (!empty($exmneCourses)) {
                                                $courseNames = array();
                                                foreach ($exmneCourses as $course) {
                                                    $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='" . $course['cou_id'] . "' ")->fetch(PDO::FETCH_ASSOC);

                                                    if (!empty($selCourse) && isset($selCourse['cou_name'])) {
                                                        $courseNames[] = $selCourse['cou_name'];
                                                    } else {
                                                        $courseNames[] = "This Course Has been Deleted";
                                                    }
                                                }
                                                echo implode(", ", $courseNames);
                                            } else {
                                                echo "No Courses have been registered yet";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $selExmneRow['exmne_year_level']; ?>
                                        </td>
                                        <td>
                                            <?php echo $selExmneRow['exmne_email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $selExmneRow['exmne_password']; ?>
                                        </td>
                                        <td>
                                            <?php echo $selExmneRow['exmne_status']; ?>
                                        </td>
                                        <td>
                                            <a rel="facebox"
                                                href="facebox_modal/updateExaminee.php?id=<?php echo $id; ?>"
                                                class="btn btn-sm btn-primary">Update</a>

                                            <a rel="facebox"
                                                href="facebox_modal/manageCourses.php?id=<?php echo $id; ?>"
                                                class="btn btn-sm btn-info">Manage Courses</a>

                                            <button type="button" id="deleteExaminee"
                                                data-id='<?php echo $id; ?>'
                                                class="btn btn-danger btn-sm">Delete</button>

                                            <?php if ($selExmneRow['blocked'] == 0) { ?>
                                                <button type="button" id="blockExaminee"
                                                    data-id='<?php echo $id; ?>'
                                                    class="btn btn-warning btn-sm">Block</button>
                                            <?php } else { ?>
                                                <button type="button" id="unblockExaminee"
                                                    data-id='<?php echo $id; ?>'
                                                    class="btn btn-success btn-sm">Unblock</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="9">
                                        <h3 class="p-3">No Students Found</h3>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>


    </div>