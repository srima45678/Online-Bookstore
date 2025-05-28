<?php
session_start(); // Always start session first
include_once("header.php"); // Then include header
include 'config.php';
include 'mailer.php';

if (!isset($_SESSION['forgot_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['forgot_email'];

// Fetch OTP attempts and last resend time
$query = "SELECT otp_attempts, last_resend FROM password_token WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $attempts = $row['otp_attempts'];
    $lastResend = strtotime($row['last_resend']);
    $currentTime = time();

    // Block if within 24 hours and attempts >= 3
    if ($attempts >= 3 && ($currentTime - $lastResend) < 86400) {
        setcookie('error', "OTP resend limit reached. You can generate a new OTP after 24 hours.", time() + 5, "/");
        header("Location: forgot_password.php");
        exit();
    }

    // Reset attempts if 24 hours passed
    if ($attempts >= 3 && ($currentTime - $lastResend) >= 86400) {
        $attempts = 0;
    }

    // Generate and send new OTP
    $new_otp = rand(100000, 999999);
    $created_at = date("Y-m-d H:i:s");
    $expires_at = date("Y-m-d H:i:s", strtotime('+2 minutes'));

    $update = "UPDATE password_token SET otp = ?, otp_attempts = ?, last_resend = NOW(), created_at = ?, expires_at = ? WHERE email = ?";
    $stmt = $conn->prepare($update);
    $new_attempts = $attempts + 1;
    $stmt->bind_param("iisss", $new_otp, $new_attempts, $created_at, $expires_at, $email);
    $stmt->execute();

    // Email content
    $subject = "Reset Password OTP";
    $body = "<html>
    <head><style>body{font-family:Arial;} .otp{color:#dc3545;font-weight:bold;}</style></head>
    <body>
        <p>Hello,</p>
        <p>Your OTP for password reset is: <span class='otp'>{$new_otp}</span></p>
        <p>This OTP will expire in 2 minutes.</p>
        <p>If you didn't request this, please ignore it.</p>
    </body>
    </html>";

    if (sendEmail($email, $subject, $body, "")) {
        setcookie("success", "OTP for reset password is sent successfully.", time() + 5, "/");
        header("Location: otp_form.php");
        exit();
    } else {
        setcookie("error", "Error sending OTP email.", time() + 5, "/");
        header("Location: forgot_password.php");
        exit();
    }
} else {
    setcookie("error", "No OTP request found for this email.", time() + 5, "/");
    header("Location: forgot_password.php");
    exit();
}
?>
