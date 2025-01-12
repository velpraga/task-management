<?php
include('header.php');
include('sidebar.php');
$user = $_SESSION['user'];
if (!$user) {
    header("Location: " . SITE_URL . '/logout.php');
    exit;
}
global $isAdmin;

$userId = $user['id'];
$result = $conn->query("select * from users where id = '$userId'");
if ($result->num_rows == 0) die("user not found");

$user = $result->fetch_assoc();
$errorMessage = $successMessage = '';
if (isset($_POST['submit'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);

    if (empty($first_name)) {
        $errorMessage = 'First Name is required';
    } else if (empty($last_name)) {
        $errorMessage = 'Last Name is required';
    } else {
        $result = $conn->query("update users set first_name = '$first_name', last_name = '$last_name' where id = '$userId'");
        if ($result) {
            $_SESSION['user']['first_name'] = $user['first_name'] = $first_name;
            $_SESSION['user']['last_name'] = $user['last_name'] = $last_name;
            $successMessage = 'Profile Updated Successfully.';
        } else {
            $errorMessage = $result->error;
        }
    }
}

$conn->close();
?>
<h3>Edit Profile</h3>
<hr>
<form method="POST" action="">
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Enter your name" value="<?= $user['first_name'] ?>" required>
        </div>
    </div>
    <div class="form-group row mt-2">
        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Enter your name" value="<?= $user['last_name'] ?>" required>
        </div>
    </div>
    <div class="form-group row mt-2">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="email" value=<?= $user['email'] ?>>
        </div>
    </div>
    <div class="form-group row mt-2">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="status" value=<?= $user['status'] ?>>
        </div>
    </div>

    <div class="form-group row mt-2">
        <label for="role" class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="role" value=<?= $user['role'] ?>>
        </div>
    </div>

    <?php if ($successMessage || $errorMessage): ?>
        <div class="alert alert-<?= $successMessage ? 'success' : 'danger' ?> d-flex align-items-center alert-dismissible fade show w-50" role="alert">
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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="mt-2">
        <a href="dashboard.php" class="btn btn-secondary btn-sm">Cancel</a>
        <button type="submit" name="submit" class="btn btn-outline-primary btn-sm">Update</button>
    </div>
</form>
<?php include('footer.php'); ?>