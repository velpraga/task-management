<?php
include "../../header.php";
include "../../sidebar.php";
include "../../db_connection.php";

global $isAdmin;

if (!$isAdmin) die("Permission Denied");

$id = isset($_GET['id']) ? $_GET['id'] : null;
$users = $conn->query("select * from users where status = 'Active'");

$title = $description = $dueDate = $assignedTo = '';
$status = 'Pending';
$priority = 'Medium';
if (!empty($id)) {
    $result = $conn->query("select * from tasks where id = '$id'");
    if ($result->num_rows == 0) {
        die("No task found...");
    }

    $task = $result->fetch_assoc();
    $title = trim($task['title']);
    $status = trim($task['status']);
    $priority = trim($task['priority']);
    $description = trim($task['description']);
    $assignedTo = intval($task['assigned_to']);
    $dueDate = $task['due_date'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $status = trim($_POST['status']);
    $priority = trim($_POST['priority']);
    $description = trim($_POST['description']);
    $assignedTo = intval($_POST['assignedTo']);
    $dueDate = $_POST['dueDate'];

    if (!empty($id)) {
        // update task
        $sql = "UPDATE tasks SET title = '$title', description = '$description', assigned_to = '$assignedTo', status = '$status', priority = '$priority', due_date = '$dueDate' WHERE id = '$id'";
        if ($conn->query($sql)) {
            $_SESSION['successMessage'] = "Task Updated Successfully";
            header("Location: list.php");
            exit;
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
        }
    } else {
        // create task
        $sql = "INSERT INTO tasks (title, description, assigned_to, status, priority, due_date) VALUES ('$title', '$description', '$assignedTo', '$status', '$priority', '$dueDate')";

        // Send email after task is created
        if ($conn->query($sql)) {
            $taskId = $conn->insert_id; // Get the ID of the newly created task
            sendEmailToAssignedUser($assignedTo, $taskId); // Call the function to send an email
            $_SESSION['successMessage'] = "Task Created Successfully";
            header("Location: list.php");
            exit;
        }
    }
}

$conn->close();
?>
<h3><?php echo $id ? "Edit" : "New"; ?>&nbsp;Task</h3>
<hr>
<form method="POST" class="mb-5" action="">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="title" class="form-label">Task Title&nbsp;<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title" value="<?= $title ?>" required>
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <?php foreach (['Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled'] as $val) : ?>
                    <option value="<?= $val ?>" <?= $val === $status ? 'selected' : '' ?>><?= $val ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="priority" class="form-label">Priority</label>
            <select class="form-select" id="priority" name="priority" required>
                <?php foreach (['Low', 'Medium', 'High', 'Critical'] as $val) : ?>
                    <option value=<?= $val ?> <?= $val === $priority ? 'selected' : '' ?>><?= $val ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter task description"><?= $description ?></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="assignedTo" class="form-label">Assign To</label>
            <select class="form-select" id="assignedTo" name="assignedTo" required>
                <option value="">Select user</option>
                <?php if ($users->num_rows > 0): ?>
                    <?php while ($row = $users->fetch_assoc()): ?>
                        <option value=<?= $row['id'] ?> <?php echo $row['id'] == $assignedTo ? 'selected' : "" ?>><?= $row['first_name'] . ' ' . $row['last_name'] ?></option>
                    <?php endwhile; ?>

                <?php else: ?>
                    <option value="">No customers found.</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="dueDate" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="dueDate" name="dueDate" value=<?= $dueDate ?> required>
        </div>
    </div>

    <a href="list.php" class="btn btn-secondary btn-sm">Cancel</a>
    <button type="submit" class="btn btn-outline-primary btn-sm"><?= $id ? 'Update' : 'Submit' ?> Task</button>
</form>
<?php include "../../footer.php"; ?>