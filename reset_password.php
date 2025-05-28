<?php
session_start(); // start session on top

include 'header.php';
include 'config.php';

// DEBUG: Print current session email
if (isset($_SESSION['forgot_email'])) {
    echo "<!-- Session Email: " . $_SESSION['forgot_email'] . " -->";
}
?>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6 p-4" style="background-color: white;">
        <h3 style="text-align: center;">Reset Password</h3>
        <p class="text-muted text-center mb-4">Please enter your new password below.</p>
        
        <form id="passwordResetForm" action="" method="post">
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                        placeholder="Enter new password (min 8 characters)">
                </div>
            <div class="mb-4">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                       placeholder="Confirm new password">
            </div>
            <button type="submit" name="reset_pwd_btn" class="btn btn-primary w-100 mb-3" style="background-color:rgb(244, 216, 168)">Update Password</button>
            <div class="text-center pt-2">
                <a href="login.php" class="text-decoration-none text-danger">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_pwd_btn'])) {
    // Debugging: Check post and session
    echo "<!-- POST triggered -->";

    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        echo "<!-- DEBUG: Email=$email, NewPass=$newPassword -->";

        if ($newPassword !== $confirmPassword) {
            echo "<script>alert('Passwords do not match!');</script>";
        } else if (strlen($newPassword) < 8) {
            echo "<script>alert('Password must be at least 8 characters.');</script>";
        } else {
            // UPDATE password (plain text)
            $query = "UPDATE registration SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("ss", $newPassword, $email);
                if ($stmt->execute()) {
                    // Remove OTP from password_token
                    $del = $conn->prepare("DELETE FROM password_token WHERE email = ?");
                    $del->bind_param("s", $email);
                    $del->execute();

                    unset($_SESSION['forgot_email']);
                    echo "<div class='alert alert-success text-center mt-4' role='alert'>
                            ✅ Password updated successfully! Redirecting to login...
                          </div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'login.php';
                            }, 3000); // 3 seconds
                          </script>";
                    exit();
                } else {
                    echo "<script>alert('Execute failed: " . $stmt->error . "');</script>";
                }
            } else {
                echo "<script>alert('Prepare failed: " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Session expired. Please try again.'); window.location.href = 'forgot_password.php';</script>";
    }
}
?>

<style>
    body { background-color: #f8f9fa; }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
</style>

<?php include 'footer.php'; ?>
