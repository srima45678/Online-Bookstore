<?php
session_start();
include_once("header.php");
include_once("config.php");


// Initialize error variable
$error = "";

// Check if already logged in
if (isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['url'])) {
        header("Location: " . $_SESSION['url']);
    } else {
        header("Location: user_dashboard.php");
    }
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    // Get and sanitize inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['pswd']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if the user exists in the database
        $sql = "SELECT * FROM registration WHERE email = ? LIMIT 1";
        
        // Use prepared statements with MySQLi
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
require_once 'mailer.php';

// Verify password
if (password_verify($password, $user["password"])) {
    // Send login notification email
    $subject = "Login Notification - Student Demo Website";
    $body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #007bff;'>Login Notification</h2>
        <p>Dear " . htmlspecialchars($user['fullname']) . ",</p>
        <p>This is a notification that your account was successfully logged in on " . date('Y-m-d H:i:s') . ".</p>
        <p>If this was not you, please reset your password immediately or contact support.</p>
        <p>Thank you,<br>Student Demo Website Team</p>
    </div>";

    sendEmail($email, $subject, $body);

    // Set session variables
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["fullname"] = $user["fullname"];
    $_SESSION["email"] = $user["email"];
    
    // Check user role
    if ($user['role'] == "Admin") {
        $_SESSION['admin'] = $email;
        header("Location: admin_dashboard.php");
    } else {
        $_SESSION['user'] = $email;
        if (isset($_GET['redirect'])) {
            header("Location: " . urldecode($_GET['redirect']));
        } else {
            header("Location: user_dashboard.php");
        }
    }
    exit();
} else {
    $error = "Invalid password.";
}
            } else {
                $error = "User not found.";
            }
            $stmt->close();
        } else {
            $error = "Database error. Please try again later.";
        }
    }
}
?>

<br>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6 p-4" style="background-color: white;">
        <h3 style="text-align: center;">Login</h3>

        <?php 
        // Display error from cookie if set
        if (isset($_COOKIE['error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_COOKIE['error']) . '</div>';
            setcookie("error", "", time() - 3600, "/"); // Clear the cookie
        }
        
        // Display current error
        if (!empty($error)) { 
            echo "<div class='alert alert-danger'>$error</div>"; 
        } 
        ?>

        <form action="login.php<?php echo isset($_GET['redirect']) ? '?redirect=' . urlencode($_GET['redirect']) : ''; ?>" method="post" onsubmit="return validateLogin();">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <small id="emailError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                <small id="passwordError" class="text-danger"></small>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn form-control text-white" style="background-color:rgb(244, 216, 168)">Submit</button>
        </form>

        <div class="text-center mb-3">
            <a href="forgot_password.php" class="text-danger text-decoration-none">Forgot password?</a>
        </div>
        <div class="text-center">
            <p class="mb-0">Don't have an account?
                <a href="register.php" class="text-danger text-decoration-none">Sign up</a>
            </p>
        </div>
    </div>
</div>

<script>
function validateLogin() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("pwd").value.trim();

    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");

    // Clear previous errors
    emailError.innerHTML = "";
    passwordError.innerHTML = "";

    let isValid = true;

    if (email === "") {
        emailError.innerHTML = "Email is required.";
        isValid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        emailError.innerHTML = "Invalid email format.";
        isValid = false;
    }

    if (password === "") {
        passwordError.innerHTML = "Password is required.";
        isValid = false;
    } else if (password.length < 6) {
        passwordError.innerHTML = "Password must be at least 6 characters.";
        isValid = false;
    }

    return isValid;
}
</script>

<?php
include_once("footer.php");
?>