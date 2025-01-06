<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<h1>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h1>

<pre>
<?php print_r($user); ?>
</pre>
