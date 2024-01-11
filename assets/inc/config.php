<?php
$base_path		= "http://localhost/e-promote";
$time_limit_reg = "15";
$time_limit_ver = "10";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e2407_promot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>