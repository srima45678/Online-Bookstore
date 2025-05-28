<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "project";


// Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $conn->set_charset("utf8mb4");
// echo "Connected successfully";
?>
