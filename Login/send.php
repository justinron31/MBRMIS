<?php

// To Remove unwanted errors
error_reporting(0);

// Add your connection Code
include "../Php/db.php";

// Important Files (Please check your file path according to your folder structure)
require "./phpmailer/src/PHPMailer.php";
require "./phpmailer/src/SMTP.php";
require "./phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Email From Form Input
$send_to_email = $_POST["email"];

// Generate Random 6-Digit OTP
$verification_otp = random_int(100000, 999999);

// Full Name of User
$send_to_name = $_POST["firstname"];

function sendMail($send_to, $otp, $name)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Enter your email ID
    $mail->Username = "jeyanggg@gmail.com";
    $mail->Password = "cwgqizbuqjelotat";

    // Your email ID and Email Title
    $mail->setFrom("jeyanggg@gmail.com", "MBRMIS");

    $mail->addAddress($send_to);

    // You can change the subject according to your requirement!
    $mail->Subject = "Account Activation";

    // You can change the Body Message according to your requirement!
    $mail->Body = "Hello, {$name}\nYour account registration is successfully done! Now activate your account with OTP {$otp}.";
    $mail->send();
}

sendMail($send_to_email, $verification_otp, $send_to_name);

// Message to print email success!
echo "Email Sent Successfully!";
