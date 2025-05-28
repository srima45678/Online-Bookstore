<?php
include 'header.php';
require 'config.php';
require 'mailer.php';
session_start();

$error = "";
$success = "";

// Show error/success from cookie (set in previous request)
if (isset($_COOKIE['error'])) {
    $error = $_COOKIE['error'];
    setcookie('error', '', time() - 3600, "/");
}
if (isset($_COOKIE['success'])) {
    $success = $_COOKIE['success'];
    setcookie('success', '', time() - 3600, "/");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['forgot_btn'])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error = "Please enter your email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email format.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $error = "Email is not registered.";
        } else {
            // Email is registered
            $otp = rand(100000, 999999);
            $created_at = date("Y-m-d H:i:s");
            $expires_at = date("Y-m-d H:i:s", strtotime("+2 minutes"));

            $subject = "Password Reset - OTP";
            $body = "<html><body>
                        <h3>Your OTP is: <span style='color: red;'>$otp</span></h3>
                        <p>It will expire in 2 minutes.</p>
                    </body></html>";

            // Check existing entry
            $check = $conn->prepare("SELECT * FROM password_token WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $otp_result = $check->get_result();
            $row = $otp_result->fetch_assoc();

            if ($row) {
                if ($row['otp_attempts'] >= 3) {
                    setcookie('error', "Maximum OTP attempts reached. Try again after 24 hours.", time() + 5, "/");
                    header("Location: forgot_password.php");
                    exit();
                }

                $attempts = $row['otp_attempts'] + 1;
                $update = $conn->prepare("UPDATE password_token SET otp = ?, created_at = ?, expires_at = ?, otp_attempts = ?, last_resend = NOW() WHERE email = ?");
                $update->bind_param("issis", $otp, $created_at, $expires_at, $attempts, $email);
                $update->execute();
            } else {
                $insert = $conn->prepare("INSERT INTO password_token (email, otp, created_at, expires_at, otp_attempts, last_resend) VALUES (?, ?, ?, ?, 0, NOW())");
                $insert->bind_param("siss", $email, $otp, $created_at, $expires_at);
                $insert->execute();
            }

            if (sendEmail($email, $subject, $body, "")) {
                $_SESSION['forgot_email'] = $email;
                setcookie('success', 'OTP sent to your registered email address.', time() + 5, "/");
                header("Location: otp_form.php");
                exit();
            } else {
                $error = "Failed to send OTP. Try again later.";
            }
        }
    }
}
?>

<style>
    .error-message { color: red; margin-bottom: 10px; }
    .success-message { color: green; margin-bottom: 10px; }
</style>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6 p-4" style="background-color: white;">
        <h3 style="text-align: center;">Forgot Password</h3>
        <p class="text-muted text-center mb-4">Enter your email address and we'll send you an OTP to reset your password.</p>

        <?php if (!empty($error)): ?>
            <div class="error-message text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success-message text-center"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="forgot_password.php" id="forgotPasswordForm">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control <?php echo (!empty($error)) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Enter your email" required>
                <div id="emailError" class="error" style="color: #dc3545; display: none;">Email is not registered.</div>
            </div>

            <button type="submit" class="btn form-control text-white" name="forgot_btn" style="background-color:rgb(244, 216, 168)">Send OTP</button>
            <div class="text-center mt-2">
                <a href="login.php" class="text-danger text-decoration-none">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#email').on('blur', function () {
        let email = $(this).val().trim();
        if (!email) return;
        $.get('check_duplicate_Email.php', { email1: email }, function (response) {
            if (response === 'false') {
                $('#emailError').text('Email is not registered.').show();
                $('#email').addClass('is-invalid');
            } else {
                $('#emailError').hide();
                $('#email').removeClass('is-invalid');
            }
        });
    });
});
</script>

<?php include 'footer.php'; ?>
