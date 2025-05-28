<?php
$host = "localhost";  // Change this if using a remote database
$user = "root";       // Your database username
$password = "";       // Your database password
$database = "project";    // Replace with your actual database name

try {
    // Create a database connection
    $con = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $con->connect_error);
    }

    // Create the database if it doesn't exist
    $dbQuery = "CREATE DATABASE IF NOT EXISTS `project`";
    if ($con->query($dbQuery) === TRUE) {
        echo "Database Created Successfully<br>";
    } else {
        throw new Exception("Error in Creating Database: " . $con->error);
    }

    // Switch to the newly created database
    $con->select_db("project");

    // Create Registration table
    $registrationQuery = "CREATE TABLE IF NOT EXISTS `registration` (
        `id` int PRIMARY KEY AUTO_INCREMENT,
        `fullname` char(40) NOT NULL,  -- Changed `lastname` to `fullname`
        `email` varchar(50) NOT NULL UNIQUE,
        `mobile` bigint NOT NULL,
        `password` varchar(30) NOT NULL,
        `profile_picture` varchar(100) NOT NULL DEFAULT 'default.jpg',
        `role` char(10) NOT NULL DEFAULT 'User',
        `status` char(10) NOT NULL DEFAULT 'Inactive'
    )";

    if ($con->query($registrationQuery) === TRUE) {
        echo "Registration Table Created Successfully<br>";
    } else {
        throw new Exception("Error in Creating Registration Table: " . $con->error);
    }

    // Create password_token table
    $passwordTokenQuery = "CREATE TABLE IF NOT EXISTS `password_token` (
        `id` INT AUTO_INCREMENT PRIMARY KEY, 
        `email` VARCHAR(255) NOT NULL, 
        `otp` INT(6),
        `created_at` DATETIME NOT NULL,
        `expires_at` DATETIME NOT NULL, 
        `otp_attempts` INT NOT NULL,
        `last_resend` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($con->query($passwordTokenQuery) === TRUE) {
        echo "Password Token Table Created Successfully<br>";
    } else {
        throw new Exception("Error in Creating Password Token Table: " . $con->error);
    }

    // Close the connection
    $con->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
