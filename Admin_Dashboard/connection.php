<?php
// Database configuration
$serverName = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "curious_cubs"; // Change this to your MySQL database name

// Create connection
$conn = mysqli_connect($serverName, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Remember to close the connection when you're done
// mysqli_close($conn);
?>
