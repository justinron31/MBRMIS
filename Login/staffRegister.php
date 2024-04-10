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
    <script src="./CSS,JS/login.js"></script>

    <title>Registration - Staff</title>
</head>

<body>
    <!-- LOADER-->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <nav>
        <!--NAVBAR-->
        <div id="nav-bar">
            <div id="logcon">
                <img class="logo" src="../images/logo.png" alt="Makiling logo" />
                <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
            </div>
            <a href="loginStaff.php"><button class="switchButton" role="button">
                    <span class="text">REGISTER </span><span> LOGIN</span>
                </button></a>
        </div>
    </nav>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup" class="popup2">
        <p>Passwords do not match!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup1" class="popup2">
        <p>Please enter a valid email address.</p>
    </div>

    <!--VALIDATION ID Number-->
    <div id="validationPopup2" class="popup2">
        <p>Entered ID Number is already taken.</p>
    </div>

    <!--VALIDATION Email-->
    <div id="validationPopup3" class="popup2">
        <p>Entered Email Address is already taken.</p>
    </div>

    <!--VALIDATION Email-->
    <div id="validationPopup5" class="popup2">
        <p>Registration failed. The provided ID number does not exist in our records..</p>
    </div>


    <?php
    session_start();

    if (isset($_SESSION['invalid'])) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("validationPopup5").style.display = "block";
            setTimeout(function() {
                document.getElementById("validationPopup5").style.display = "none";
            }, 3000);
        });
    </script>';
        unset($_SESSION['invalid']);
    }
    ?>





    <!--LOGIN FORM-->
    <div class="login-containerReg">
        <div class="logo-container">
            <p class="login-text">STAFF REGISTRATION</p>
            <hr />
        </div>

        <form class="login-form" action="../Php/staffReg.php" method="post">

            <div class=" first">

                <!-- ─── Name ─────────────── -->
                <div class="staffName">
                    <label class="required">Firstname</label>
                    <input type="text" id="name" name="fname" placeholder="Enter Firstname" oninput="capitalizeFirstLetter('name')" autofocus required />
                </div>

                <div class="staffName1">
                    <label class="required">Lastname</label>
                    <input type="text" id="lname" name="lname" placeholder="Enter Lastname" oninput="capitalizeFirstLetter('lname')" required />
                </div>

            </div>

            <div class="first">
                <!-- ─── Id Number ────────────────────────────────────────── -->
                <div class="staffName2">
                    <label class="required">ID Number</label>
                    <input type="text" id="idnum" name="idnum" placeholder="Enter ID number" oninput="validateIDNumber(); " required />
                </div>

                <!-- ─── Age ──────────────── -->
                <div class="staffName2">
                    <label class="required">Age</label>
                    <input type="text" id="age" name="age" placeholder="Enter Age" maxlength="2" oninput="validateAge(this)" required />
                </div>

                <!-- ─── Gender ───────────── -->
                <div class="staffName2">
                    <label class="required">Gender</label>
                    <select class="selectbox" id="genderSelect" name="genderSelect" required onchange="changeFontColor(); validateIDNumber2()">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

            </div>

            <!-- ─── Email ────────────────────────────────────────────── -->
            <label class="required">Email</label>
            <input type="text" id="email" name="email" placeholder="example@gmail.com" oninput="validateEmail();" required />

            <!-- ─── Password ─────────────────────────────────────────── -->
            <label class="required">Password</label>
            <p id="validationPopup4">Password must contain at least <strong>one uppercase letter</strong>, <strong>one
                    lowercase
                    letter</strong>, <strong>one digit</strong>, and at least <strong>8
                    characters long.</strong></p>
            <input type="password" id="password" name="password" placeholder="Enter Password" required oninput="validatePassword1()" />

            <!-- ─── Cpassword ────────── -->
            <label class="required">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" oninput="validatePassword();" required />
            <button type="submit" class="login-button" name="register" id="submitBtn">SUBMIT</button>
            <br />
            <br />
        </form>
    </div>
    <br />

    <!-- FOOTER BRO-->
    <footer>
        <p>
            &copy; 2024 BARANGAY MAKILING RECORD MANAGEMENT AND ISSUANCE SYSTEM |
            All rights reserved.
        </p>
    </footer>
</body>

<script>
    document.querySelector('.login-form').addEventListener('submit', function(event) {
        setTimeout(function() {
            document.getElementById('submitBtn').disabled = true;
        }, 1);
    });
</script>


</html>