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

    <title>Create New Password - Staff</title>

</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['same_password'])) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("validationPopup5").style.display = "block";
            setTimeout(function() {
                document.getElementById("validationPopup5").style.display = "none";
            }, 3000);
        });
    </script>';
        unset($_SESSION['same_password']);
    }
    ?>


    <!--VALIDATION MESSAGE-->
    <div id="validationPopup" class="popup2">
        <p>Passwords do not match!</p>
    </div>


    <!--VALIDATION MESSAGE-->
    <div id="validationPopup5" class="popup2">
        <p>Don't use the same old password!.</p>
    </div>

    <nav>
        <!--NAVBAR-->
        <div id="nav-bar">
            <div id="logcon">
                <img class="logo" src="../Images/logo.png" alt="Makiling logo" />
                <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
            </div>

        </div>
    </nav>

    <!--LOGIN FORM-->
    <div class="login-container">
        <div class="logo-container">
            <img class="logo1" src="../Images/logo.png" alt="Makiling logo" />
            <p class="login-text">CREATE NEW PASSWORD</p>
        </div>

        <p id="validationPopup7">Password must contain at least <strong>one uppercase letter</strong>, <strong>one
                lowercase
                letter</strong>, <strong>one digit</strong>, and at least <strong>8
                characters long.</strong></p>

        <form class="login-form" action="../Php/update_password.php" method="post">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" />
            <input type="password" id="password" name="password" placeholder="Enter Password" required oninput="validatePassword1()" />
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" oninput="validatePassword();" required />
            <button type="submit" class="savePass">SAVE PASSWORD</button>
        </form>
    </div>
    <br />

    <!-- FOOTER BRO-->
    <footer>
        <p>&copy; 2024 BARANGAY MAKILING RECORD MANAGEMENT AND ISSUANCE SYSTEM | All rights reserved.</p>
    </footer>

    <script src="../Login/CSS,JS/login.js"></script>
</body>

</html>