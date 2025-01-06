<?php include 'header.php'; ?>

<?php
session_start();

require_once 'db_connection.php';
if (isset($_SESSION['user'])) {
    // Redirect to dashboard if already logged in
    header("Location: dashboard.php");
    exit();  // Ensure the script stops executing
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    if (empty($email)) {
        $error = 'Email is required';
    }

    if (empty($password)) {
        $error = 'Password is required';
    }

    $email_check_query = "SELECT * FROM users WHERE email = '$email'";
    $email_result = $conn->query($email_check_query);

    if (mysqli_num_rows($email_result) == 0) {
        $error = 'Incorrect Email or Password';
    } else {
        $user = mysqli_fetch_assoc($email_result);
        if (!password_verify($password, $user['password'])) {
            $error = 'Incorrect Email or Password';
        }
    }

    if (empty($error)) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    }
}
?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Login</h3>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="mb-3 text-end">
                <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
            </div>

            <!-- Show Error Message -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <span>Don't have an account?</span>
            <a href="register.php" class="text-decoration-none">Create an account.</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>