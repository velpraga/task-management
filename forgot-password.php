<?php
include 'header.php';
$errorMessage = $successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));

    if (empty($email)) {
        $errorMessage = 'Email is required';
    }

    $email_check_query = "SELECT * FROM users WHERE email = '$email'";
    $email_result = $conn->query($email_check_query);

    if (mysqli_num_rows($email_result) == 0) {
        $errorMessage = 'Email Not exist.';
    }

    if (empty($errorMessage)) {
        $result = sendPasswordResetLink($email);
        if ($result['success']) {
            $successMessage = 'Password reset link sent successfully...';
        } else {
            $errorMessage = $result['message'];
        }
    }
}
?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <!-- Heading -->
        <h3 class="text-center mb-4">
            <i class="bi bi-envelope-at-fill me-2"></i>Forgot Password
        </h3>
        <p class="text-center text-muted">
            Enter your registered email address, and we’ll send you instructions to reset your password.
        </p>

        <!-- Forgot Password Form -->
        <form method="POST" action="">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    Email Address&nbsp;<span class="text-danger">*</span>
                </label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your registered email address"
                    required>
            </div>

            <?php if ($successMessage || $errorMessage): ?>
                <div class="alert alert-<?= $successMessage ? 'success' : 'danger' ?> d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi <?= $successMessage ? 'bi-check-circle' : 'bi-exclamation-triangle' ?>" viewBox="0 0 16 16">
                        <?php if ($successMessage): ?>
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.97-3.03a.75.75 0 0 0-1.08-.02L6.477 9.525 4.525 7.575a.75.75 0 0 0-1.05 1.05l2.5 2.5a.75.75 0 0 0 1.08-.02l4.5-5.5a.75.75 0 0 0-.02-1.05z" />
                        <?php else: ?>
                            <path d="M7.938 2.016a.13.13 0 0 1 .12 0l6.856 3.937c.09.051.146.149.146.257v7.938a.25.25 0 0 1-.25.25h-13a.25.25 0 0 1-.25-.25V6.21c0-.108.056-.206.146-.257L7.938 2.016zm-.89 5.52a.5.5 0 1 0-.896.443l1.16 3.375a.5.5 0 1 0 .896-.443L7.05 7.536zm1.925 3.704a1 1 0 1 0-1.95 0 1 1 0 0 0 1.95 0z" />
                        <?php endif; ?>
                    </svg>
                    <div class="ms-3">
                        <?= htmlspecialchars($successMessage ?: $errorMessage) ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center mt-3">
            <span>Remember your password?</span>
            <a href="login.php" class="text-decoration-none">Go to login</a>.
        </div>
    </div>
</div>