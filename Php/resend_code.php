<?php
//Import PHPMailer classes into the global namespace
require "../Login/phpmailer/src/PHPMailer.php";
require "../Login/phpmailer/src/SMTP.php";
require "../Login/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
include "../Php/db.php";

if (isset($_GET["email"])) {
    $email = $_GET['email'];

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
        $mail->addAddress($email);

        //Set email format to HTML
        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Your Email Verification Code';
        $mail->Body    = '<p>Hello Mabuhay!, To complete your account setup, please use the verification code below:</p><p style="font-size: 24px; font-weight: bold;">' . $verification_code . '</p><p>Please enter this code in the appropriate field to verify your email address.</p><p>If you did not request this verification, please disregard this email.</p>';


        $mail->send();

        // update verification code in users table
        $sql = "UPDATE staff SET verification_code = '" . $verification_code . "' WHERE email = '" . $email . "'";
        mysqli_query($conn, $sql);

        header("Location:../Login/email-verification.php?email=" . $email);
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo '<script>';
    echo 'alert("Failed to resend code. Please try again.");';
    echo 'window.location.href = "../Login/email-verification.php";';
    echo '</script>';
}

// Close connection
$conn->close();
