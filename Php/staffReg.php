<?php
//Import PHPMailer classes into the global namespace
require "../../MBRMIS/Login/phpmailer/src/PHPMailer.php";
require "../../MBRMIS/Login/phpmailer/src/SMTP.php";
require "../../MBRMIS/Login/phpmailer/src/Exception.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
include "db.php";

if (isset($_POST["register"])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $idnumber = $_POST['idnum'];
    $email = $_POST['email'];
    $gender = $_POST['genderSelect'];
    $age = $_POST['age'];
    $password = $_POST["password"];
    $last_login = date("Y-m-d H:i:s");
    $is_logged_in = 0;

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
        $mail->Username = 'jeyanggg@gmail.com';

        //SMTP password
        $mail->Password = 'cwgqizbuqjelotat';

        //Enable TLS encryption;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('jeyanggg@gmail.com', 'MBRMIS');

        //Add a recipient
        $mail->addAddress($email, $firstname);

        //Set email format to HTML
        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Your Email Verification Code';
        $mail->Body    = '<p>Hello Mabuhay!, To complete your account setup, please use the verification code below:</p><p style="font-size: 24px; font-weight: bold;">' . $verification_code . '</p><p>Please enter this code in the appropriate field to verify your email address.</p><p>If you did not request this verification, please disregard this email.</p>';


        $mail->send();

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);


        // insert in users table
        $sql = "INSERT INTO staff(firstname, lastname, idnumber, email, gender, age, last_login_timestamp, is_logged_in, pass, verification_code, email_verified_at) VALUES ( '" . $firstname . "', '" . $lastname . "', '" . $idnumber . "', '" . $email . "', '" . $gender . "', '" . $age . "', '" . $last_login . "', '" . $is_logged_in . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
        mysqli_query($conn, $sql);
        header("Location:../Login/email-verification.php?email=" . $email);
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo '<script>';
    echo 'alert("Registration failed. Please try again.");';
    echo 'window.location.href = "../Login/staffRegister.php";';
    echo '</script>';
}

// Close connection
$conn->close();
