<?php
include("../../../conn.php");


extract($_POST);

$selCourse = $conn->query("SELECT * FROM examinee_course_tbl WHERE examinee_id='$id' ");
if ($selCourse->rowCount() > 0) {
	$res = array("res" => "cannotDelete");
} else {
	$delCourse = $conn->query("DELETE  FROM examinee_tbl WHERE exmne_id='$id'  ");
	if ($delCourse) {
		$res = array("res" => "success");
	} else {
		$res = array("res" => "failed");
	}
}
echo json_encode($res);
?>