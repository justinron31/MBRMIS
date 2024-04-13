<?php

session_start();

//Import PHPMailer classes into the global namespace
require "../Login/phpmailer/src/PHPMailer.php";
require "../Login/phpmailer/src/SMTP.php";
require "../Login/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Database connection code here
include 'db.php';

date_default_timezone_set('Asia/Singapore');


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the token from the form
    $token = $_POST['token'];

    // Get the new password from the form
    $newPassword = $_POST['password'];

    // Fetch the current password and email from the database
    $stmt = $conn->prepare("SELECT pass, email FROM staff WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $storedPasswordHash = $row['pass'];
    $email = $row['email']; // Fetch the email

    // Check if the new password is the same as the current password
    if (password_verify($newPassword, $storedPasswordHash)) {
        // New password is the same as the current password
        $_SESSION['same_password'] = true;
        header("Location: ../Login/passwordReset.php?token=$token");
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    try {
        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE staff SET pass = ?, reset_token = NULL, passreset_timestamp = NOW() WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashedPassword, $token);

        if ($stmt->execute()) {

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Enable verbose debug output
                $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;

                //Send using SMTP
                $mail->isSMTP();

                //Set the SMTP server to send through
                $mail->Host = 'smtp.gmail.com';

                //Enable SMTP authentication
                $mail->SMTPAuth = true;

                //SMTP username
                $mail->Username = 'barangay.makiling24@gmail.com';

                //SMTP password
                $mail->Password = 'uzpgybuoyxerjsmm';

                //Enable TLS encryption;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('barangay.makiling24@gmail.com', 'MBRMIS');

                //Add a recipient
                $mail->addAddress($email); // Use the fetched email

                $mail->isHTML(true);

                $mail->Subject = 'Password Update Successful';
                $mail->Body    = '<p>Hello Mabuhay!,</p><p>Your password has been successfully updated.</p><p>If you did not make this change, please contact our support team immediately.</p>';

                $mail->send();

                // Password updated successfully, show an alert and then redirect to loginstaff.php
                echo "<script>
    alert('Password updated successfully');
    window.location.href='../Login/loginStaff.php';
    </script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating password: " . $conn->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
