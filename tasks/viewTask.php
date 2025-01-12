<?php
include "../header.php";
include "../sidebar.php";

$errorMessage = '';
if (isset($_POST['submitTask'])) {
    $taskId = $_POST['submitTask'];
    $description = trim($_POST['description']);
    $status = trim($_POST['status']);
    $priority = trim($_POST['priority']);

    $query = "update tasks set description = '$description', status = '$status', priority = '$priority'  where id = $taskId";
    if ($conn->query($query)) {
        $_SESSION['successMessage'] = "Task Updated Successfully";
        header("Location: list.php");
        exit;
    } else {
        $_SESSION['errorMessage'] = $conn->error;
        header("Location: list.php");
        exit;
    }
}

if (empty($_POST['viewTask'])) die("No Task found...");

$taskId = $_POST['viewTask'];
$task = $conn->query("select * from tasks where id = $taskId");
if ($task->num_rows == 0) die("No Task found...");

$task = $task->fetch_assoc();
$conn->close();

$statusColors = ['Completed' => 'success', 'Pending' => 'primary', 'In Progress' => 'info', 'On Hold' => 'warning', 'Cancelled' => 'danger'];
$priorityColors = ['Low' => 'light', 'Medium' => 'info', 'High' => 'warning', 'Critical' => 'danger'];
?>

<h3>Edit Task</h3>
<hr>
<div class="mt-4">
    <form method="POST" class="mb-5" action="">
        <div>
            <p><strong>Task Id:</strong>&nbsp;#<?= $task['id'] ?></p>
            <p><strong>Task Title:</strong>&nbsp;<?= $task['title'] ?></p>
            <p><strong>Status:</strong>&nbsp;<span class="badge bg-<?= htmlspecialchars($statusColors[$task['status']] ?? 'secondary') ?>"><?= $task['status'] ?></span></p>
            <p><strong>Priority:</strong>&nbsp;<span class="badge bg-<?= htmlspecialchars($priorityColors[$task['priority']] ?? 'secondary') ?>"><?= $task['priority'] ?></span></p>
            <p><strong>Create On:</strong>&nbsp;<?= date('M j, Y H:i:s:a', strtotime($task['created_at'])) ?></p>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter task description"><?= $task['description'] ?></textarea>
            </div>
        </div>

        <div class="mb-3 col-md-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <?php foreach (['Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled'] as $val) : ?>
                    <option value="<?= $val ?>" <?= $val === $task['status'] ? 'selected' : '' ?>><?= $val ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3 col-md-3">
            <label for="priority" class="form-label">Priority</label>
            <select class="form-select" id="priority" name="priority" required>
                <?php foreach (['Low', 'Medium', 'High', 'Critical'] as $val) : ?>
                    <option value=<?= $val ?> <?= $val === $task['priority'] ? 'selected' : '' ?>><?= $val ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <a href="list.php" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" name="submitTask" value=<?= $taskId ?> class="btn btn-outline-primary btn-sm">Update Task</button>
        </div>
    </form>
</div>
<?php include "../footer.php";
