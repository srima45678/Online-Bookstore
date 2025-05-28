<?php
session_start();
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

include 'config.php';
include 'mailer.php'; // PHPMailer setup

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forgot_btn'])) {
    $email = trim($_POST['email']);

    // Case 1: Empty email
    if (empty($email)) {
        $_SESSION['otp_error'] = "Please enter your email address.";
        header("Location: forgot_password.php");
        exit();
    }

    // Case 2: Invalid format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['otp_error'] = "Invalid email format.";
        header("Location: forgot_password.php");
        exit();
    }

    // Case 3: Check if registered
    $checkEmail = $conn->prepare("SELECT * FROM registration WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['otp_error'] = "This email is not registered.";
        header("Location: forgot_password.php");
        exit();
    }

    // Check OTP attempts in last 24 hours
    $stmt = $conn->prepare("SELECT otp_attempts, created_at FROM password_token WHERE email = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $otpResult = $stmt->get_result();

    if ($otpResult->num_rows > 0) {
        $row = $otpResult->fetch_assoc();
        $attempts = $row['otp_attempts'];
        $created_at = strtotime($row['created_at']);
        $now = time();

        // If 3 attempts and within 24 hours, block
        if ($attempts >= 3 && ($now - $created_at) < (24 * 60 * 60)) {
            $_SESSION['otp_error'] = "This email has been blocked for 24 hours due to too many OTP requests.";
            header("Location: forgot_password.php");
            exit();
        }

        // If 24 hours passed, reset attempts
        if (($now - $created_at) >= (24 * 60 * 60)) {
            $reset = $conn->prepare("UPDATE password_token SET otp_attempts = 0 WHERE email = ?");
            $reset->bind_param("s", $email);
            $reset->execute();
        }
    }

    // Proceed to send OTP
    $_SESSION['forgot_email'] = strtolower($email);
    $response = sendOTPEmail($email, $conn);

if ($response && $response['success']) {
    error_log("✅ sendOTPEmail returned TRUE: " . $response['message']);
    $_SESSION['otp_message'] = "OTP has been sent to your email.";
    header("Location: otp_form.php");
    exit();
} else {
    error_log("❌ sendOTPEmail returned FALSE: " . $response['message']);
    $_SESSION['otp_error'] = "Failed to send OTP. Please try again later.";
    header("Location: forgot_password.php");
    exit();
}

    // if (sendOTPEmail($email, $conn)) {
    //     header("Location: otp_form.php");
    //     exit();
    // } else {
    //     $_SESSION['otp_error'] = "Failed to send OTP. Please try again later.";
    //     header("Location: forgot_password.php");
    //     exit();
    // }
// } else {
//     header("Location: forgot_password.php");
//     exit();
}
?>