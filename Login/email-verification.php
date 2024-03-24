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

$showPopup = false;

if (isset($_POST["verify_email"])) {
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // mark email as verified
    $sql = "UPDATE staff SET email_verify = 1, email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        // Send confirmation email
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
        $mail->setFrom("", "MBRMIS");

        $mail->addAddress($email);

        // You can change the subject according to your requirement!
        $mail->Subject = "Account Successfully Activated";

        // You can change the Body Message according to your requirement!
        $mail->Body = "Hello, Your account registration has been successfully completed! You can now log in to your account.";
        $mail->send();

        header("Location: /MBRMIS/Login/loginStaff.php?email_verified=true");
        exit();
    } else {
        $showPopup = true;
    }
}
?>


<!--VALIDATION MESSAGE-->
<div id="validationPopup1" class="popup2" style="<?php echo $showPopup ? 'display: block;' : 'display: none;'; ?>">
    <p>Invalid Verification Code</p>
</div>



<script>
    if (<?php echo $showPopup ? 'true' : 'false'; ?>) {
        setTimeout(function() {
            document.getElementById('validationPopup1').style.display = 'none';
        }, 3000);
    }
</script>


<!DOCTYPE html>
<html lang="en">

<head>
    <!--LOGO TAB-->
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <!-- META TAGS BRO -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Barangay management system for makiling" />
    <meta name="keywords" content="Web Development, Barangay Management System" />
    <meta name="authors" content="Arcillas, Galang, Ignacio" />

    <!-- CSS / JAVASCRIPT -->
    <link rel="stylesheet" href="../Login/CSS,JS/login.css" />



    <title>Verify Email </title>
</head>

<body>

    <!--LOADER-->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup1" class="popup2">
        <p>Invalid Verification Code.</p>
    </div>



    <nav>
        <!--NAVBAR-->
        <div id="nav-bar">
            <div id="logcon">
                <img class="logo" src="../Images/logo.png" alt="Makiling logo" />
                <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
            </div>
            <a href="loginStaff.php"><button class="switchButton" role="button">
                    <span class="text">VERIFY EMAIL</span><span> LOGIN</span>
                </button></a>
        </div>
    </nav>

    <!--LOGIN FORM-->
    <div class="login-container">
        <div class="logo-container">
            <img class="logo1" src="../Images/logo.png" alt="Makiling logo" />
            <p class="login-text" style="margin-bottom: 0;">Enter verification code sent to your email.</p>
            <a id="resend-link" class="resend-link" href="/MBRMIS/Php/resend_code.php?email=<?php echo $_GET['email']; ?>">Resend code</a>

        </div>
        <br>
        <form method="POST">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
            <input type="text" name="verification_code" placeholder="Enter verification code" required />
            <button type="submit" class="login-button" name="verify_email" value="Verify Email">VERIFY</button>

        </form>
        <br>
    </div>
    <!-- FOOTER BRO-->
    <footer>
        <p>&copy; 2024 BARANGAY MAKILING RECORD MANAGEMENT AND ISSUANCE SYSTEM | All rights reserved.</p>
    </footer>

    <script src="../Login/CSS,JS/login.js"></script>
</body>

<script>
    var resendLink = document.getElementById('resend-link');
    resendLink.addEventListener('click', function(e) {
        e.preventDefault();
        resendLink.style.pointerEvents = 'none';
        var href = resendLink.getAttribute('href');
        fetch(href).then(function(response) {
            if (response.ok) {
                resendLink.textContent = 'New verification code has been sent';
                var counter = 20;
                var interval = setInterval(function() {
                    counter--;
                    resendLink.textContent = 'New verification code has been sent (' + counter +
                        ')';
                    if (counter === 0) {
                        clearInterval(interval);
                        resendLink.textContent = 'Resend code';
                        resendLink.style.pointerEvents =
                            'auto';
                    }
                }, 1000);
            } else {
                console.error('Failed to resend code');
                resendLink.style.pointerEvents = 'auto';
            }
        });
    });
</script>

</html>