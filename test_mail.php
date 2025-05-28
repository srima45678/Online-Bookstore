<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

try {
    // SMTP config
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rsah819@rku.ac.in'; // Your Gmail
    $mail->Password = 'agol hoby nvyx akwe'; // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use ENCRYPTION_SMTPS for port 465
    $mail->Port = 465;

    // Debug
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // SHOW full debug output

    // Sender and recipient
    $mail->setFrom('rsah819@rku.ac.in', 'Demo Website');
    $mail->addAddress('your@gmail.com'); // <--- Use YOUR email here

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Testing PHPMailer';
    $mail->Body    = '<h1>Hello</h1><p>This is a test email</p>';

    $mail->send();
    echo '✅ Message has been sent';

} catch (Exception $e) {
    echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
