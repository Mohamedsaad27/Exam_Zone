<?php
session_start();
include("conn.php");
include("emailconfigration.php");
$exmne_id = $_GET['exmne_id'];
$exam_id = $_GET['exam_id'];

$selExaminee = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$exmne_id'")->fetch(PDO::FETCH_ASSOC);
$selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer
  WHERE ea.axmne_id='$exmne_id' AND ea.exam_id='$exam_id' AND ea.exans_status='new' ");

$selcourse = $conn->query("SELECT * FROM examinee_course_tbl WHERE examinee_id='$exmne_id'")->fetch(PDO::FETCH_ASSOC);
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exam_id'")->fetch(PDO::FETCH_ASSOC);
$course_id = $selcourse['cou_id'];
$selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$course_id'")->fetch(PDO::FETCH_ASSOC);

$over = $selExam['ex_questlimit_display'];

$score = $selScore->rowCount();
$ans = $score / $over * 100;

$mail->Subject = 'Exam Results';

$mail->addAddress($selExaminee['exmne_email']);

$mail->isHTML(true);

if ($ans >= 85) {
  $Appreciation = "A";
} else if ($ans >= 75) {
  $Appreciation = "B";
} else if ($ans >= 65) {
  $Appreciation = "C";
} else if ($ans > 50) {
  $Appreciation = "D";
} else {
  $Appreciation = "F";
}
$mailContent = '
<div style="max-width: 600px; margin: 0 auto;">

    <h1 style="text-align: center;margin-bottom:0;color:#333333">Exam Zone</h1>
    <h2 style="text-align: center;margin:0;color:#888888">Exam Results</h2>
    <h4 style="text-align: left;">Student Name : ' . $selExaminee['exmne_fullname'] . ' </h4>
    <h4 style="text-align: left">Course : ' . $selCourse['cou_name'] . ' </h4>
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th style="padding: 10px; background-color: #f2f2f2; border: 1px solid #ddd;">Subject</th>
        <th style="padding: 10px; background-color: #f2f2f2; border: 1px solid #ddd;">Score</th>
        <th style="padding: 10px; background-color: #f2f2f2; border: 1px solid #ddd;">Appreciation</th>
      </tr>
      <tr>
        <td style="text-align: center;padding: 10px; border: 1px solid #ddd;">' . $selCourse['cou_name'] . '</td>
        <td style="text-align: center;padding: 10px; border: 1px solid #ddd;">' . number_format($ans, 2) . '%</td>
        <td style="text-align: center;padding: 10px; border: 1px solid #ddd;">' . $Appreciation . '</td>
      </tr>

    </table>
  </div>
 ';
$mail->Body = $mailContent;
if (isset($_POST['send_email'])) {
  if ($mail->send()) {
    header("location: home.php?page=result&id=$exam_id");
    exit();
  } else {
    $logMessage = $mail->ErrorInfo; // The log message you want to store
    
    $logFile = 'emailLogFile.txt'; // The path and filename of the log file
    
    $logTime = date("Y-m-d H:i:s"); // Current date and time
    
    $logContent = $logTime . " >> " . $logMessage . "\n"; // Format the log entry
    
    // Append the log entry to the log file
    file_put_contents($logFile, $logContent, FILE_APPEND | LOCK_EX);
    header("location: indexxx.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Sending Email</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    #loader {
      border: 8px solid #f3f3f3;
      /* Light gray */
      border-top: 8px solid #3498db;
      /* Blue */
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 2s linear infinite;
      margin-bottom: 16px;
    }

    h1 {
      font-size: 24px;
      text-align: center;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
  <div id="loader"></div>
  <h1>Sending Email... Please wait.</h1>

  <!-- Add a form to trigger the email sending -->
  <form method="post">
    <input type="hidden" name="send_email" value="1">
    <input type="submit" value="Send Email" style="display: none;">
  </form>

  <!-- Add JavaScript to automatically submit the form once the HTML content is loaded -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelector("form").submit();
    });
  </script>
</body>

</html>