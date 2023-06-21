<?php
include("../../../conn.php");

// $selectedCourses = isset($_POST['selectedCourses']) ? $_POST['selectedCourses'] : array();
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM examinee_course_tbl WHERE examinee_id='$id'");
if (isset($_GET['courses'])) {

  $selectedCourses = $_GET['courses'];

  //   header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);

  // Insert new records for the selected courses
  if (!empty($selectedCourses)) {
    $values = array();
    $counter = 0;
    foreach ($selectedCourses as $courseId => $value) {
      // Escape the values to prevent SQL injection
      $examineeId = $conn->quote($id);
      $courseId = $conn->quote($selectedCourses[$counter++]);

      // Prepare the values for the INSERT statement
      $values[] = "($examineeId, $courseId)";
    }

    // Insert the values into the database
    $insertQuery = "INSERT INTO examinee_course_tbl (examinee_id, cou_id) VALUES " . implode(',', $values);
    $conn->query($insertQuery);
    // header("location:../home.php?page=manage-examinee");
    header("location:../sendMailRegistration.php?id=$id");
  }
} else
  header("location:../sendMailRegistration.php?id=$id");
?>