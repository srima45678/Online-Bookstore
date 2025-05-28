<?php
include_once('header.php');
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    $sql = "SELECT * FROM registration WHERE email = '$email' AND token = '$token'";
    $count = $con->query($sql);
    $r = mysqli_fetch_assoc($count);
    if ($count->num_rows == 1) {
        if ($r['status'] == 'Inactive') {
            $update = "UPDATE registration SET status = 'Active' WHERE email = '$email'";
            if ($con->query($update)) {
                setcookie('success', 'Account Verification Successful', time() + 5);
            } else {
                setcookie('error', 'Error in verifying email', time() + 5);
            }
        } else {
            setcookie('success', 'Email already verified', time() + 5);
        }
    } else {
        setcookie('error', 'Email not registered', time() + 5);
    }
}
?>
<script>
    window.location.href = 'login.php';
</script>