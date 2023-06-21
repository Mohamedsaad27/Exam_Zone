<?php
 session_start(); 
 include("../conn.php");
 extract($_POST);

$exmne_id = $_SESSION['examineeSession']['exmne_id'];
// $exam_id = $_GET['id'];
$exam_id = $_POST['exam_id'];
$quest_id= $questionId;
$exans_answer= $answer;

$selExmneeData = $conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$exam_id' AND quest_id='$quest_id'");
if ($selExmneeData->rowCount() > 0) {
    $updLastAns = $conn->query("UPDATE exam_answers SET exans_answer='$exans_answer' WHERE axmne_id='$exmne_id' AND exam_id='$exam_id' AND quest_id='$quest_id'");
    if(!$updLastAns)
    {
        $res = array("res" => "failed");
    }
}else {
    $insAns = $conn->query("INSERT INTO exam_answers(axmne_id,exam_id,quest_id,exans_answer) VALUES('$exmne_id','$exam_id','$quest_id','$exans_answer')");
    
    if(!$insAns)
    {
        $res = array("res" => "failed");
    }

}
//AND exam_id='$exam_id'
echo json_encode($res);
?>


