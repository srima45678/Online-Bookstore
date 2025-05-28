<!-- 
<div class="row">
    <div class="col-3"></div>
    <div class="col-6 p-4" style="background-color: white;">
        <h3 style="text-align: center;">Contact Us</h3>
        <form action="/action_page.php">
            <div class="mb-3 mt-3">
        <form action='contact.php' method='POST'> 
            <div class='mb-3'> 
        <label for='name' class='form-label'>Name</label> 
        <input type='text' name='name' id='name' class='form-control' required> 
    </div> 
    <div class='mb-3'> 
        <label for='email' class='form-label'>Email</label> 
        <input type='email' name='email' id='email' class='form-control' required> 
    </div> 
    <div class='mb-3'> 
        <label for='message' class='form-label'>Message</label> 
        <textarea name='message' id='message' class='form-control' rows=4 required></textarea> 
    </div> 
        Submit Button --> 
    <!-- <button type="submit" class="btn form-control text-white" style="background-color: rgb(244, 216, 168);">Send Message</button> -->
<!-- </form> 
</div> -->

<?php
ob_start();
include_once("header.php");
include 'config.php';
session_start();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_btn'])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($message) < 10) {
        $error = "Message must be at least 10 characters.";
    } else {
                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO contact_inquiry (name, email, message) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, $message);
        
                if ($stmt->execute()) {
                    // $success = "Your message has been sent successfully!";
                    header("Location: contact.php?success=1");
                } else {
                    $error = "Failed to send the message. Please try again.";
                }
            }
        }
        if (isset($_GET['success']) && $_GET['success'] == '1') {
            $success = "Your message has been sent successfully!";
        }
        
//         $success = "Your message has been sent successfully!";
//     }
// }
        // Here, you can add email sending or database insertion logic.

        // if (isset($_POST['contact_btn'])) {
        //     $name = $_POST['name'];
        //     $email = $_POST['email'];
        //     $message = $_POST['message'];
        
        //     $insert = "INSERT INTO `contact_inquiry`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
        
        //     if ($conn->query($insert)) {
        //         setcookie('success', "We have received your query. We will reach out to you very soon.", time() + 5, "/");
        //     } else {
        //         setcookie('error', "Failed to send the query. Please try again later.", time() + 5, "/");
        //     }
        // ?>
        <!-- //     <script> -->



<div class="row">
    <div class="col-3"></div>
    <div class="col-6 p-4" style="background-color: white;">
        <h3 style="text-align: center;">Contact Us</h3>

        <?php 
if (!empty($error)) {
    echo "<div class='alert alert-danger' id='alertMsg'>$error</div>";
} elseif (!empty($_GET['success']) && $_GET['success'] == 1) {
    echo "<div class='alert alert-success' id='alertMsg'>Your message has been sent successfully!</div>";
}
?>


        <form id="contactForm" method="POST" onsubmit="return validateContactForm()">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name</label> 
                <input type="text" name="name" id="name" class="form-control">
                <small id="nameError" class="text-danger"></small>
            </div> 
            <div class="mb-3"> 
                <label for="email" class="form-label">Email</label> 
                <input type="email" name="email" id="email" class="form-control">
                <small id="emailError" class="text-danger"></small>
            </div> 
            <div class="mb-3"> 
                <label for="message" class="form-label">Message</label> 
                <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                <small id="messageError" class="text-danger"></small>
            </div> 
            <button type="submit" name="contact_btn" class="btn form-control text-white" style="background-color: rgb(244, 216, 168);">Send Message</button>
        </form> 
    </div>
</div>

<script>
function validateContactForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let message = document.getElementById("message").value.trim();

    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let messageError = document.getElementById("messageError");

    nameError.innerHTML = emailError.innerHTML = messageError.innerHTML = "";

    let isValid = true;

    if (name === "") {
        nameError.innerHTML = "Name is required.";
        isValid = false;
    }
    if (email === "" || !/^\S+@\S+\.\S+$/.test(email)) {
        emailError.innerHTML = "Invalid email format.";
        isValid = false;
    }
    if (message.length < 10) {
        messageError.innerHTML = "Message must be at least 10 characters.";
        isValid = false;
    }

    return isValid;
}
</script>

<script>
// Hide success alert after 5 seconds
window.addEventListener("DOMContentLoaded", () => {
    const alertBox = document.getElementById('alertMsg');

    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = 0;

            setTimeout(() => {
                alertBox.style.display = "none";

                // Clean the URL from ?success=1 without reloading
                if (window.location.search.includes("success=1")) {
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            }, 500); // wait for fade-out
        }, 5000); // wait 5 seconds
    }
});
</script>

<?php
include_once("footer.php");
?>

