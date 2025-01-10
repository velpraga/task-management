<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<?php include "../../db_connection.php"; ?>

<?php
$userId = $_SESSION['user']['id'];
$users = $conn->query("SELECT * FROM users where id != '$userId'");
?>
<h1>View Customers</h1>
<div class="mt-2">
    <a class="btn btn-primary float-end mb-3" href="AddEditCustomer.php" role="button"><i class="bi bi-plus"></i>&nbsp;New User</a>
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
                        <td>
                            <!-- Action Icons -->
                            <a href="AddEditCustomer.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" title="Delete"
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
</div>
<?php include "../../footer.php"; ?>