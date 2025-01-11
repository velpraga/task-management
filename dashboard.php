<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

?>
<h1 class="mb-4">Welcome <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Tasks</div>
            <div class="card-body">
                <h5 class="card-title">Manage Tasks</h5>
                <p class="card-text">Create and manage tasks for your team.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Customers</div>
            <div class="card-body">
                <h5 class="card-title">Manage Customers</h5>
                <p class="card-text">Add, update, and view customer details.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Logout</div>
            <div class="card-body">
                <h5 class="card-title">Sign Out</h5>
                <p class="card-text">Logout from the admin panel.</p>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>