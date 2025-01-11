<?php include 'header.php'; ?>

<?php
session_start();
if (isset($_SESSION['user'])) {
    // Redirect to dashboard if already logged in
    header("Location: dashboard.php");
    exit();  // Ensure the script stops executing
}
require_once 'db_connection.php';

// Initialize error and success messages arrays
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Basic validation
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }

    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If no errors, proceed to insert into the database
    if (empty($errors)) {
        // Hash password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists in the database
        $email_check_query = "SELECT * FROM users WHERE email = '$email'";
        $email_result = $conn->query($email_check_query);

        if (mysqli_num_rows($email_result) > 0) {
            $errors[] = "Email is already registered.";
        }

        // If no errors, insert the user into the database
        if (empty($errors)) {
            $insert_query = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";
            if ($conn->query($insert_query)) {
                $successMessage = 'Registration successful! You can now <a href="login.php">login</a>.';
            } else {
                $errors[] = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Register Account</h3>

        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name&nbsp;<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name&nbsp;<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address&nbsp;<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password&nbsp;<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <!-- Show Error Messages -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Show Success Message -->
            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" value="submit">Register</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <span>Already have an account?</span>
            <a href="login.php" class="text-decoration-none">Go to login.</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>