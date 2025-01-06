<?php
$host = 'localhost';      // Database server (e.g., localhost)
$dbname = 'task_management'; // Database name
$username = 'root';       // Database username
$password = 'root';           // Database password

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>