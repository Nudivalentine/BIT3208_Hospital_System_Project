<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "week1db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<h2 style='color:red;'>Connection failed: " . $conn->connect_error . "</h2>");
}

echo "<h2 style='color:green;'>Database connected successfully!</h2>";
?>