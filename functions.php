<?php
function sendEmailToAssignedUser($assignedTo, $taskId)
{
    global $conn;
    // Retrieve the email of the assigned user
    $sql = "SELECT email FROM users WHERE id = '$assignedTo'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userEmail = $row['email'];

        // Email details
        $subject = "New Task Assigned: Task #$taskId";
        $message = "Hello,\n\nYou have been assigned a new task with Task ID: $taskId.\nPlease check your task list for more details.\n\nBest regards,\nYour Team";

        // Headers
        $headers = "From: no-reply@example.com" . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";

        // Send email
        if (mail($userEmail, $subject, $message, $headers)) {
            echo "Email sent successfully.";
            die('sds');
        } else {
            echo "Failed to send email.";
        }
    }
}

//sendEmailToAssignedUser(18, 7);
function sendPasswordResetLink($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $resetLink = "https://example.com/reset-password?email=" . urlencode($email) . "&token=" . bin2hex(random_bytes(16));

        if (mail($email, "Password Reset", "Click here to reset your password: " . $resetLink)) {
            return ['success' => true, "message" => "Email sent successfully."];
        } else {
            return ['success' => false, "message" => "Failed to send.."];
        }
    } else {
        // Handle invalid email format
        return ['success' => false, "message" => "Invalid Email address"];
    }
}

function runtime_log($message, $file = "runtime.log")
{
    $message = is_array($message) ? PHP_EOL . var_export($message, true) : $message;
    $file = dirname(__FILE__) . "/$file";
    file_put_contents($file, gmdate("[Y-m-d H:i:s] ") . " $message" . PHP_EOL, FILE_APPEND);
}
