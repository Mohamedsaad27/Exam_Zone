<?php
include("../../../conn.php");
include("../../../emailconfigration.php");
if (isset($_POST['send_email'])) {
    $id = $_GET['id'];
    $exam_id = $id;

    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exam_id'")->fetch(PDO::FETCH_ASSOC);
    $course_id = $selExam['cou_id'];

    $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$course_id'")->fetch(PDO::FETCH_ASSOC);
    $selExaminee = $conn->query("SELECT * FROM examinee_course_tbl WHERE cou_id='$course_id'");

    $courseName = $selCourse['cou_name'];
    $examTitle = $selExam['ex_title'];
    $examTime = $selExam['ex_time_limit'];
    $examDescription = $selExam['ex_description'];

    $mail->Subject = 'New Exam Available';
    $mail->isHTML(true);
    $flag = 0;
    while ($Examinee = $selExaminee->fetch(PDO::FETCH_ASSOC)) {
        if (isset($Examinee['examinee_id'])) {

            $exmne_id = $Examinee['examinee_id'];
            $selOneExaminee = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$exmne_id'")->fetch(PDO::FETCH_ASSOC);
            $mail->addAddress($selOneExaminee['exmne_email']);

            $mailContent = '
        <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="text-align: center;margin-bottom:0;color:#333333">Exam Zone</h1>
        <h2 style="text-align: center;margin:0;color:#888888">New Exam Available</h2>
        <h4 style="text-align: left;">Course Name: ' . $courseName . '</h4>
        <h4 style="text-align: left;margin-top: 10px;margin-bottom: 0px">Exam Title: ' . $examTitle . '</h4>
        <h4 style="text-align: left;margin-top: 5px;margin-bottom: 0px">Exam Time(min): ' . $examTime . '</h4>
        <h4 style="text-align: left;margin-top: 5px">Exam Description: ' . $examDescription . '</h4>
        <p style="text-align: left;">Dear Student, a new exam is now available for you to take. Please log in to the ExamZone platform to access the exam details and complete it within the given timeframe</p>
        <p style="text-align: left;">Thank you</p>
        </div>
        ';
            $mail->Body = $mailContent;
            if (!$mail->send()) {
                $flag = 1;
                $logMessage = $mail->ErrorInfo; // The log message you want to store

                $logFile = '../../emailLogFile.txt'; // The path and filename of the log file

                $logTime = date("Y-m-d H:i:s"); // Current date and time

                $logContent = $logTime . " >> " . $logMessage . "\n"; // Format the log entry

                // Append the log entry to the log file
                file_put_contents($logFile, $logContent, FILE_APPEND | LOCK_EX);
            }
            $mail->ClearAllRecipients();
        } else
            continue;
    }
    header('Location: ../home.php?page=manage-exam');
    exit;
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