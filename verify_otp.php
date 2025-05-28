<?php
session_start();
include 'config.php';
include 'header.php';

// Check if user has an email in session
if (!isset($_SESSION['forgot_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['forgot_email'];

// Check if there's an active OTP first
$query = "SELECT otp, expires_at FROM password_token WHERE email = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($db_otp, $expires_at);
$has_otp = $stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = $_POST["otp_code"];

    if (!$has_otp) {
        $_SESSION['otp_message'] = "No active OTP found. Please request a new one.";
        $_SESSION['otp_message_type'] = "danger";
    } 
    elseif ($entered_otp == $db_otp) {
        if (strtotime($expires_at) > time()) {
            $_SESSION['otp_verified'] = true;
            header("Location: reset_password.php");
            exit();
        } else {
            $_SESSION['otp_message'] = "OTP has expired. Please request a new one.";
            $_SESSION['otp_message_type'] = "danger";
        }
    } else {
        $_SESSION['otp_message'] = "Invalid OTP. Please try again.";
        $_SESSION['otp_message_type'] = "danger";
    }

    header("Location: verify_otp.php");
    exit();
}

// Set appropriate message if no active OTP exists
if (!$has_otp) {
    $_SESSION['otp_message'] = "No active OTP found. Please request a new one.";
    $_SESSION['otp_message_type'] = "danger";
} elseif (strtotime($expires_at) <= time()) {
    $_SESSION['otp_message'] = "OTP has expired. Please request a new one.";
    $_SESSION['otp_message_type'] = "danger";
}
?>

<style>
    .otp-input {
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 18px;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        text-align: center;
        display: none;
    }

    .otp-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .otp-card {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    
    .btn-verify {
        width: 150px;
        display: block;
        margin: 10px auto;
    }

    .otp-input {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        transition: all 0.3s;
        width: 50px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .otp-input:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        outline: none;
    }
</style>

<div class="otp-container">
    <div class="otp-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-3">Verify OTP</h2>
            <p class="text-muted text-center mb-3">OTP must be exactly 6 digits</p>
            <p class="text-muted text-center mb-4">Enter the 6-digit OTP sent to<br><?php echo htmlspecialchars($email); ?></p>

            <?php if (isset($_SESSION['otp_message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['otp_message_type']; ?>">
                    <?php echo $_SESSION['otp_message']; ?>
                </div>
                <?php unset($_SESSION['otp_message']); unset($_SESSION['otp_message_type']); ?>
            <?php endif; ?>

            <?php if ($has_otp && strtotime($expires_at) > time()): ?>
                <form id="otpForm" action="verify_otp.php" method="POST">
                    <div class="d-flex justify-content-center mb-4 gap-2">
                        <input type="text" class="form-control otp-input" maxlength="1" autofocus oninput="moveToNext(this, 0)" name="otp1">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 1)" name="otp2">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 2)" name="otp3">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 3)" name="otp4">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 4)" name="otp5">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 5)" name="otp6">
                    </div>
                    
                    <div class="error text-center text-danger mb-3" id="otpError" style="display: none;">
                        Please enter a valid 6-digit OTP.
                    </div>

                    <button type="submit" class="btn btn-danger py-2 mb-3 fw-bold" style="background-color:rgb(244, 216, 168);">
                        Verify OTP
                    </button>
                </form>
            <?php else: ?>
                <div class="text-center">
                    <a href="resend_otp_forgot_password.php" class="btn btn-primary">Request New OTP</a>
                </div>
            <?php endif; ?>

            <div class="text-center mb-2">
                <p class="text-muted mb-0">Didn't receive the code?</p>
                <a href="resend_otp_forgot_password.php" class="text-danger text-decoration-none" id="resendLink">Resend OTP</a>
            </div>

            <div class="text-center">
                <a href="login.php" class="text-danger text-decoration-none">Back to Login</a>
            </div>
        </div>
    </div>
</div>

<script>
    function moveToNext(input, index) {
        input.value = input.value.replace(/[^0-9]/g, ''); // Allow only numbers
        if (input.value.length === input.maxLength) {
            if (index < 5) {
                input.parentElement.children[index + 1].focus();
            }
        }
    }

    document.getElementById("otpForm").addEventListener("submit", function(event) {
        let otpInputs = document.querySelectorAll(".otp-input");
        let otpError = document.getElementById("otpError");
        let otp = "";

        otpInputs.forEach(input => otp += input.value);

        if (otp.length < 6) {
            otpError.style.display = "block";
            event.preventDefault();
        } else {
            otpError.style.display = "none";
            let hiddenOtpField = document.createElement("input");
            hiddenOtpField.type = "hidden";
            hiddenOtpField.name = "otp_code";
            hiddenOtpField.value = otp;
            this.appendChild(hiddenOtpField);
        }
    });

    document.getElementById('resendLink').addEventListener('click', function(e) {
        if (!confirm('Send new OTP to <?php echo $email; ?>?')) {
            e.preventDefault();
        }
    });
</script>

<?php include 'footer.php'; ?>