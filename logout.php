<?php
// Start the session
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login or home page
header("Location: login.php");
exit();
