<?php

if (isset($_POST["login"])) {
    $idnumber = $_POST["idnumber"];
    $password = $_POST["password"];

    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "makiling");

    // check if credentials are okay, and email is verified
    $sql = "SELECT * FROM staff WHERE idnumber = '" . $idnumber . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        die("Email not found.");
    }

    $user = mysqli_fetch_object($result);

    if (!password_verify($password, $user->password)) {
        die("Password is not correct");
    }

    if ($user->email_verified_at == null) {
        die("Please verify your email <a href='email-verification.php?email=" . $idnumber . "'>from here</a>");
    }

    echo "<p>Your login logic here</p>";
    exit();
}
?>

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

if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) :
?>
<?php endif; ?>

<?php


if (isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];
    if ($userType === 'admin') {
        header('Location: /MBRMIS/Dashboard/AdminDashboard.php');
        exit;
    } else if ($userType === 'staff') {
        header('Location: /MBRMIS/Dashboard/StaffDashboard.php');
        exit;
    }
}
?>


<body>

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
        <form class="login-form" method="post">

            <?php if (!empty($error_message)) : ?>
                <div class="error-message" style="color: red;">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <input type="text" id="id" name="idnumber" placeholder="ID" autofocus required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <p class="forgot-password"><a href="resetPassword.php">Forget Password?</a></p>
            <button type="submit" class="login-button" name="login">LOGIN</button>

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