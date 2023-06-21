<?php
 include("../../../conn.php");
 extract($_POST);


$updExam = $conn->query("UPDATE exam_tbl SET published=1 WHERE  ex_id='$id'");
if($updExam)
{
	   $res = array("res" => "success");
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>