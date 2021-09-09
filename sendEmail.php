<?php
session_start();
require 'PHPMailer/PHPMailerAutoload.php';
include_once 'connection.php';

$userEmail = $_SESSION['EmailUser'];

$query = "select * from user_emails where user_email='$userEmail'";
$data = mysqli_query($conn, $query);

$mail = new PHPMailer;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'everytest0123@gmail.com';
$mail->Password = 'TestPassword123';
$mail->setFrom('everytest0123@gmail.com', 'Notification');

while ($row = mysqli_fetch_assoc($data)) {
    $mail->addAddress($row['contact_email']);
}

$mail->isHTML(true);
$mail->Subject = 'Security Alert';
$mail->Body = '<h1>Security Alert</h1>.<br><h3 style="color:red;">Need urgent help. Please contact as soon as possible.</h3>';

if (!$mail->send()) {
    echo "Something went wrong";
    echo $mail->ErrorInfo;
} else {
    echo "Email sent successfully";
}
