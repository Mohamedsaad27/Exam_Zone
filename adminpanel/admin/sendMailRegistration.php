<?php
session_start();
include("../../conn.php");
include("../../emailconfigration.php");
$exmne_id = $_GET['id'];
$records = '';
$to_email = '';
$selcourse = $conn->query("SELECT * FROM examinee_course_tbl WHERE examinee_id='$exmne_id'");
while ($course_id = $selcourse->fetch(PDO::FETCH_ASSOC)) {
    $cou_id = $course_id['cou_id'];
    $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$cou_id'")->fetch(PDO::FETCH_ASSOC);
    $records .= '
    <tr><td style="text-align: center;padding: 10px; border: 1px solid #ddd;">' . $selCourse['cou_name'] . '</td>
    <td style="text-align: center;padding: 10px; border: 1px solid #ddd;">Registered</td></tr>';
}
$selExaminee = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$exmne_id'")->fetch(PDO::FETCH_ASSOC);

$mail->Subject = 'Registration Confirmation';

$mail->addAddress($selExaminee['exmne_email']);
// $mail->addAddress('mohamed.drive185@gmail.com');

$mail->isHTML(true);


$mailContent = '
<div style="max-width: 600px; margin: 0 auto;">

    <h1 style="text-align: center;margin-bottom:0;color:#333333">Exam Zone</h1>
    <h2 style="text-align: center;margin:0;color:#888888">Registration Confirmation</h2>
    <h4 style="text-align: left;">Student Name: ' . $selExaminee['exmne_fullname'] . '</h4>
    <h4 style="text-align: left;">Level: third year</h4>
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th style="padding: 10px; background-color: #f2f2f2; border: 1px solid #ddd;">Subject</th>
        <th style="padding: 10px; background-color: #f2f2f2; border: 1px solid #ddd;">Status</th>
      </tr>
      
        ' . $records . '
      

    </table>
</div>
';
$mail->Body = $mailContent;
if (isset($_POST['send_email'])) {
    if ($mail->send()) {
        // Email sent successfully
        header('Location: home.php?page=manage-examinee');
        exit;
    } else {
        $logMessage = $mail->ErrorInfo; // The log message you want to store

        $logFile = '../../emailLogFile.txt'; // The path and filename of the log file

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