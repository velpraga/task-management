<?php
ob_start();

include "../../header.php";
include "../../sidebar.php";

global $isAdmin;

if (!$isAdmin) die("Permission Denied");

// Initialize variables for the form fields
$id = null;
$first_name = "";
$last_name = "";
$email = "";
$role = "User";
$status = "Active";

if (isset($_GET['id'])) {
    // Get the customer details for editing
    $id = intval($_GET['id']); // Sanitize input
    $result = $conn->query("SELECT * FROM users WHERE id = " . $id . "");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $first_name = htmlspecialchars($user['first_name']);
        $last_name = htmlspecialchars($user['last_name']);
        $email = htmlspecialchars($user['email']);
        $role = htmlspecialchars($user['role']);
        $status = htmlspecialchars($user['status']);
    } else {
        echo "<p>User not found.</p>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $status = trim($_POST['status']);
    if (!empty($first_name) && !empty($last_name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!empty($id)) {
            // Update existing customer
            $query = "UPDATE users 
                      SET first_name = '$first_name', 
                          last_name = '$last_name', 
                          email = '$email', 
                          role = '$role', 
                          status = '$status' 
                      WHERE id = $id";
        } else {
            // Add new customer
            $password = password_hash(uniqid(), PASSWORD_DEFAULT);
            $query = "INSERT INTO users (first_name, last_name, email, password, role, status) 
                      VALUES ('$first_name', '$last_name', '$email', '$password', '$role', '$status')";
        }

        if ($conn->query($query)) {
            $_SESSION['successMessage'] = !empty($id) ? "User Updated Successfully" : "User Added Successfully";
            header("Location: list.php");
            exit;
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Invalid input. Please ensure all fields are filled correctly.</div>";
    }
}
$conn->close();
ob_end_flush();
?>

<h3><?php echo $id ? "Edit" : "Add"; ?>&nbsp;Customer</h3>
<hr>
<form method="POST" action="">
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name; ?>" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $last_name; ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-control">
            <option value="User" <?php echo $role === 'User' ? 'selected' : ''; ?>>User</option>
            <option value="Admin" <?php echo $role === 'Admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="Active" <?php echo $status === 'Active' ? 'selected' : ''; ?>>Active</option>
            <option value="Inactive" <?php echo $status === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
        </select>
    </div>
    <a href="list.php" class="btn btn-secondary btn-sm">Cancel</a>
    <button type="submit" class="btn btn-outline-primary btn-sm"><?php echo $id ? "Update" : "Submit"; ?></button>
</form>

<?php include "../../footer.php"; ?>