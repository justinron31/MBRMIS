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


    <title>Login</title>
</head>

<?php
session_start();

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);

if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])):
?>
<?php endif;?>

<body>

    <script>
    var userRole = "<?php echo isset($_SESSION['user_type']) ? $_SESSION['user_type'] : ''; ?>";


    // Check if the user is already logged in and redirect accordingly
    if (userRole === "admin") {
        alert("Your are currently logged in. Logout first.");
        window.location.href = "/MBRMIS/Dashboard/AdminDashboard.php";
    } else if (userRole === "staff") {
        alert("Your are currently logged in. Logout first.");
        window.location.href = "/MBRMIS/Dashboard/StaffDashboard.php";
    } else {
        // Handle other roles or show an error message
        console.error("Invalid user role. Please contact support.");
    }
    </script>

    <!--LOADER-->
    <div id="preloader">
        <div id="status">&nbsp;</div>
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

    <!--REGISTER MESSAGE-->
    <div id="registerPopup" class="popup1">
        <p>Registered successfully!</p>
    </div>

    <!--LOGOUT MESSAGE-->
    <div id="LogoutPopup" class="popup1">
        <p>Logout Successfully!</p>
    </div>



    <!--LOGIN FORM-->
    <div class="login-container">
        <div class="logo-container">
            <img class="logo1" src="../Images/logo.png" alt="Makiling logo" />
            <p class="login-text">STAFF LOGIN</p>
        </div>
        <form class="login-form" action="../Php/adminLogin.php" method="post">

            <?php if (!empty($error_message)): ?>
            <div class="error-message" style="color: red;">
                <?php echo $error_message; ?>
            </div>
            <?php endif;?>

            <input type="text" id="id" name="id" placeholder="ID" autofocus required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <p class="forgot-password"><a href="resetPassword.html">Forget Password?</a></p>
            <button type="submit" class="login-button">LOGIN</button>

            <p class="register-link">Don’t have an account? <a href="staffRegister.html">Register here</a></p>
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