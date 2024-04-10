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
    <link rel="stylesheet" href="./CSS,JS/login.css" />


    <title>Login</title>
</head>

<?php
session_start();

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);

if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) :
?>
<?php endif; ?>

<?php


if (isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];
    if ($userType === 'admin' || $userType === 'staff') {
        header('Location: ../Dashboard/Home.php');
        exit;
    }
}
?>


<body>

    <!--LOADER-->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>


    <!--incompatibility CONTENT-->
    <div class="incomp">
        <div id="logcon">
            <img class="logo" src="../images/logo.png" alt="Makiling logo" stlye="width:30px" />
            <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
        </div>
        <h3>"Please access the solution on your larger devices to maximize functionality and view."</h3>
    </div>

    <nav>
        <!--NAVBAR-->
        <div id="nav-bar">
            <div id="logcon">
                <img class="logo" src="../images/logo.png" alt="Makiling logo" />
                <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
            </div>
        </div>
    </nav>

    <!--REGISTER MESSAGE-->
    <div id="registerPopup" class="popup1">
        <p>Registered successfully!</p>
    </div>

    <!--LOGOUT MESSAGE-->
    <div id="LogoutPopup" class="popup1">
        <p>Logout Successfully!</p>
    </div>

    <!--VERIFY MESSAGE-->
    <div id="verifyPopup" class="popup1">
        <p>Email verified! You may now proceed to log in.</p>
    </div>


    <!--LOGIN FORM-->
    <div class="login-container">
        <div class="logo-container">
            <img class="logo1" src="../images/logo.png" alt="Makiling logo" />
            <!-- <p class="login-text">STAFF LOGIN</p> -->
        </div>
        <form class="login-form" action="../Php/adminLogin.php" method="post">

            <?php if (!empty($error_message)) : ?>
            <div class="error-message" style="color: red;">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <input type="text" id="id" name="id" placeholder="ID" autofocus required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <p class="forgot-password"><a href="resetPassword.php">Forget Password?</a></p>
            <button type="submit" class="login-button">LOGIN</button>

            <p class="register-link">Don’t have an account? <a href="dataConsent.html">Register here</a></p>
        </form>
    </div>
    <br />

    <!-- FOOTER BRO-->
    <footer>
        <p>&copy; 2024 BARANGAY MAKILING RECORD MANAGEMENT AND ISSUANCE SYSTEM | All rights reserved.</p>
    </footer>

    <script src="../Login/CSS,JS/login.js"></script>

    <script>
    // Check if the 'verified' parameter is in the URL
    if (window.location.search.indexOf('verified=true') > -1) {
        // Show the verifyPopup div
        document.getElementById('verifyPopup').style.display = 'block';

        // Hide the verifyPopup div after 3 seconds
        setTimeout(function() {
            document.getElementById('verifyPopup').style.display = 'none';
        }, 3000);
    }
    </script>


</body>

</html>