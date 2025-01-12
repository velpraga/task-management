<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Absolute path for including PHPMailer files
require __DIR__ . '/../PHPMailer/Exception.php';
require __DIR__ . '/../PHPMailer/PHPMailer.php';
require __DIR__ . '/../PHPMailer/SMTP.php';

function sendEmailToAssignedUser($assignedTo, $taskId)
{
    global $conn;
    // Retrieve the email of the assigned user
    $sql = "SELECT * FROM users WHERE id = '$assignedTo'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userEmail = $row['email'];
        $name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
        
        $message = "Hi $name,\n\n"
            . "You have been assigned a new task with Task ID: $taskId.\n"
            . "Please check your task list for more details.\n\n"
            . "Best regards,\nYour Team";
        runtime_log(" message " . $message);
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'infoflotestest@gmail.com';
            $mail->Password = 'dyuvlsebzzxxpgjz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Email settings
            $mail->setFrom('sender@example.com', 'Velu');
            $mail->addReplyTo('reply@example.com', 'Velu');
            $mail->addAddress($userEmail);

            $mail->isHTML(true);
            $mail->Subject = "New Task Assigned: Task #$taskId";

            $mail->Body = $message;

            $mail->send();

            runtime_log('Taks Notification has been sent.');
            return ['success' => true, "message" => "Password reset link sent successfully."];
        } catch (Exception $e) {
            runtime_log('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
            return ['success' => false, "message" => 'Mailer Error: ' . $mail->ErrorInfo];
        }
    }
}

function sendPasswordResetLink($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        // Generate reset link
        $token = bin2hex(random_bytes(16));
        $resetLink = SITE_URL . "/reset-password.php?email=" . urlencode($email) . "&token=" . $token;

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'infoflotestest@gmail.com'; // Gmail address
            $mail->Password = 'dyuvlsebzzxxpgjz';        // App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
            $mail->Port = 465;

            // Email settings
            $mail->setFrom('sender@example.com', 'Velu');
            $mail->addReplyTo('reply@example.com', 'Velu');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';

            // Email body with an elegant reset button
            $mail->Body = '
                <div style="font-family: Arial, sans-serif; text-align: center; padding: 20px;">
                    <h2 style="color: #333;">Password Reset Request</h2>
                    <p style="color: #555;">We received a request to reset your password. Click the button below to reset it:</p>
                    <a href="' . $resetLink . '" 
                       style="display: inline-block; padding: 10px 20px; margin: 10px 0; font-size: 16px; 
                              color: #fff; background-color: #007BFF; text-decoration: none; border-radius: 5px;">
                        Reset Password
                    </a>
                    <p style="color: #777;">If you did not request this, please ignore this email.</p>
                </div>
            ';

            // Send the email
            $mail->send();

            runtime_log('Message has been sent.');
            return ['success' => true, "message" => "Password reset link sent successfully.", 'token' => $token];
        } catch (Exception $e) {
            runtime_log('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
            return ['success' => false, "message" => 'Mailer Error: ' . $mail->ErrorInfo];
        }
    } else {
        // Handle invalid email format
        return ['success' => false, "message" => "Invalid email address."];
    }
}

//sendPasswordResetLink("infoflotestest@gmail.com");

function runtime_log($message, $file = "runtime.log")
{
    $message = is_array($message) ? PHP_EOL . var_export($message, true) : $message;
    $file = dirname(__FILE__) . "/$file";
    file_put_contents($file, gmdate("[Y-m-d H:i:s] ") . " $message" . PHP_EOL, FILE_APPEND);
}
