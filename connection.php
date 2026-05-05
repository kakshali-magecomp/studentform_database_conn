<?php
$servername = "localhost";  
$username = "magecomp";
$password = "Admin@123";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);     
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>