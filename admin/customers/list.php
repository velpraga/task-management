<?php
include "../../header.php"; // Include header
include "../../sidebar.php"; // Include sidebar
include "../../db_connection.php"; // Include database connection

global $isAdmin;

// Check for admin permissions
if (!$isAdmin) die("Permission Denied");

$successMessage = $errorMessage = '';
if (isset($_GET['deleteId'])) {
    $userId = $_GET['deleteId'];
    if ($conn->query("DELETE FROM users WHERE id = '$userId'")) {
        $_SESSION['successMessage'] = 'User Deleted Successfully';
        header("Location: list.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = $conn->error;
        header("Location: list.php");
        exit();
    }
}

// Retrieve and display messages from session
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
}
if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
}

$userId = $_SESSION['user']['id'];
$users = $conn->query("SELECT * FROM users WHERE id != '$userId'");
?>

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
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <h3>View Customers</h3>
    </div>
    <div class="col-md-6">
        <a class="btn btn-primary btn-sm float-end mb-3" href="AddEditCustomer.php" role="button"><i class="bi bi-plus"></i>&nbsp;New User</a>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($users->num_rows > 0): ?>
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td>
                        <span class="badge text-bg-<?= $row['status'] == 'Active' ? 'success' : 'danger' ?>"><?= htmlspecialchars($row['status']) ?></span>
                    </td>
                    <td>
                        <!-- Action Icons -->
                        <a href="AddEditCustomer.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?deleteId=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Are you sure you want to delete this user?');">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No customers found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include "../../footer.php"; // Include footer 
?>