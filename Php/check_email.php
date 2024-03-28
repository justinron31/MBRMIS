<?php

// Set the default timezone to Philippines
date_default_timezone_set('Asia/Manila');
// Import PHPMailer classes into the global namespace
require "../../MBRMIS/Login/phpmailer/src/PHPMailer.php";
require "../../MBRMIS/Login/phpmailer/src/SMTP.php";
require "../../MBRMIS/Login/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
include "db.php";

// Get the email from the AJAX request
$email = $_POST['email'];

// Check if the email exists in the database
$sql = "SELECT * FROM staff WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Generate a unique token
    $token = bin2hex(random_bytes(50));

    // Generate expiry time
    $expiryTime = time() + (5 * 60); // 5 minutes

    // Convert Unix timestamp to MySQL TIMESTAMP format
    $expiryTime = date('Y-m-d H:i:s', $expiryTime);

    // Store the token and expiry time in the database
    $sql = "UPDATE staff SET reset_token = ?, token_expiry = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $token, $expiryTime, $email);
    $stmt->execute();

    // Send an email
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jeyanggg@gmail.com';
        $mail->Password = 'cwgqizbuqjelotat';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('jeyanggg@gmail.com', 'MBRMIS');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $resetLink = 'http://localhost/MBRMIS/Login/passwordReset.php?token=' . $token;
        $mail->Body    =
            '<p>Your request for a password reset has been received. Kindly proceed with the steps outlined in this email to initiate the password reset process.</p><p> Click the button below to reset your password securely:</p> <a href="' . $resetLink . '"><button style="padding: 10px; border-radius:10px; font-weight:600; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Reset Password</button></a>';
        $mail->send();
        echo json_encode(array("success" => true));
    } catch (Exception $e) {
        echo json_encode(array("success" => false, "error" => $mail->ErrorInfo));
    }
} else {
    echo json_encode(array("success" => false));
}

$stmt->close();
$conn->close();
