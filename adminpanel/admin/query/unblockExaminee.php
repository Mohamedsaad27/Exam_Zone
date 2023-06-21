<?php
 include("../../../conn.php");
 extract($_POST);


$updCourse = $conn->query("UPDATE examinee_tbl SET blocked=0 WHERE  exmne_id='$id'");
if($updCourse)
{
	   $res = array("res" => "success");
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>