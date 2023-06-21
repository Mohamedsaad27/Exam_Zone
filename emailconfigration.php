<?php
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
// Include PHPMailer library files 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
// Create an instance of PHPMailer class 
$mail = new PHPMailer;


// SMTP configuration
$mail->isSMTP();
$mail->Host= 'smtp-relay.sendinblue.com';
$mail->Username="examzoneservice@gmail.com";
$mail->Password = 'XDvA972TFOcM86sz';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Sender info 
$mail->setFrom('examzoneservice@gmail.com', 'ExamZone'); 
// $mail->addReplyTo('examzoneservice@gmail.com', 'ExamZone'); 
?>