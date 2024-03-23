<?php
include "../Php/db.php";

$showPopup = false;

if (isset($_POST["verify_email"])) {
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // mark email as verified
    $sql = "UPDATE staff SET email_verified_at = NOW(), account_status = 'Activated' WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {

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
            <p class="login-text">Enter verification code sent to your email.</p>
        </div>
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

</html>