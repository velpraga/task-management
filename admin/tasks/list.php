<?php
include "../../header.php";
include "../../sidebar.php";
include "../../db_connection.php";

global $isAdmin;

if (!$isAdmin) die("Permission Denied");

$statusColors = ['Completed' => 'success', 'Pending' => 'primary', 'In Progress' => 'info', 'On Hold' => 'warning', 'Cancelled' => 'danger'];
$priorityColors = ['Low' => 'dark', 'Medium' => 'info', 'High' => 'warning', 'Critical' => 'danger'];
$successMessage = $errorMessage = '';
if (isset($_GET['deleteId'])) {
    $taskId = $_GET['deleteId'];
    if ($conn->query("delete from tasks where id = '$taskId' ")) {
        $_SESSION['successMessage'] = 'Task Deleted Successfully';
        header("Location: list.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = $conn->error;
        header("Location: list.php");
        exit();
    }
}

// Retrieve messages from the session if they exist
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']); // Clear the message from the session
}
if (isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']); // Clear the message from the session
}

$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);

$offSet = ($page - 1) * $limit;
$totalTasksQuery = "SELECT COUNT(*) AS total FROM tasks";
$totalTasksResult = $conn->query($totalTasksQuery);
$totalTasks = $totalTasksResult->fetch_assoc()['total'];
$totalPages = ceil($totalTasks / $limit);

$whereClause = isset($_GET['status']) ? "WHERE t.status = '$_GET[status]'" : "";
$tasks = $conn->query("SELECT t.id, t.title, t.status, t.priority, t.due_date, t.created_at, t.updated_at ,  CONCAT(u.first_name , ' ', u.last_name) AS assigned_user, u.email FROM tasks t LEFT JOIN users u ON t.assigned_to = u.id $whereClause ORDER BY t.updated_at DESC LIMIT $limit OFFSET $offSet ");

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
        <h3>View Tasks</h3>
    </div>
    <div class="col-md-6">
        <a class="btn btn-primary float-end mb-3 btn-sm" href="AddEditTask.php" role="button"><i class="bi bi-plus"></i>&nbsp;New Task</a>

    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Task Name</th>
            <th>User</th>
            <th>Email</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Created On</th>
            <th>Updated On</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($tasks->num_rows > 0): ?>
            <?php while ($row = $tasks->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['assigned_user']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <?php echo htmlspecialchars(date('M j, Y', strtotime($row['due_date']))); ?>

                    </td>
                    <td><span class="badge bg-<?= htmlspecialchars($statusColors[$row['status']] ?? 'secondary') ?>"><?= $row['status'] ?></span></td>
                    <td>
                        <span class="badge bg-<?= htmlspecialchars($priorityColors[$row['priority']] ?? 'secondary') ?>">
                            <?= htmlspecialchars($row['priority'] ?? 'Unknown') ?>
                        </span>
                    </td>
                    <td>
                        <?php echo htmlspecialchars(date('M j, Y', strtotime($row['created_at']))); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars(date('M j, Y', strtotime($row['updated_at']))); ?>
                    </td>

                    <td>
                        <!-- Action Icons -->
                        <a href="AddEditTask.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?deleteId=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Are you sure you want to delete this task?');">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No tasks found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


<?php 
include '../../pagination.php';
include "../../footer.php"; 

?>