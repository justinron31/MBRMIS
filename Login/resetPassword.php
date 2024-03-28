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

    <title>Reset Password - Staff</title>

</head>

<body>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup1" class="popup2">
        <p>Please enter a valid email address.</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup2" class="popup2">
        <p>Email address entered is not registered.</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup3" class="popup1">
        <p>Email sent successfully.</p>
    </div>


    <nav>
        <!--NAVBAR-->
        <div id="nav-bar">
            <div id="logcon">
                <img class="logo" src="../Images/logo.png" alt="Makiling logo" />
                <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
            </div>
            <a href="loginStaff.php"><button class="switchButton" role="button">
                    <span class="text">RESET PASSWORD </span><span> LOGIN</span>
                </button></a>
        </div>
    </nav>


    <!--RESET PASS FORM-->
    <div class="login-container">
        <div class="logo-container">
            <img class="logo1" src="../Images/logo.png" alt="Makiling logo" />
            <p class="login-text">ENTER YOUR REGISTERED EMAIL ADDRESS</p>
        </div>

        <form class="login-form">
            <input type=" text" id="email" name="email" placeholder="Enter registered email" oninput="validateEmail1();" autofocus required>
            <a class="sent" style="color: green; font-size:15px; display:none;">The email containing the password reset
                link has been successfully sent to the email address you have registered.</a>
            <button type="submit" class="login-button">Reset Password</button>
        </form>

    </div>
    <!-- FOOTER BRO-->
    <footer>
        <p>&copy; 2024 BARANGAY MAKILING RECORD MANAGEMENT AND ISSUANCE SYSTEM | All rights reserved.</p>
    </footer>

    <script src="../Login/CSS,JS/login.js"></script>

    <script>
        function validateEmail1() {
            var emailInput = document.getElementById("email");
            var validationPopup = document.getElementById("validationPopup1");
            var submitBtn = document.querySelector(".login-button");

            var email = emailInput.value.trim();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email !== "" && !emailRegex.test(email)) {
                // Display a message for invalid email format
                validationPopup.style.display = "block";
                emailInput.classList.add("error-input");

                // Change the focus color and shadow to red
                emailInput.style.borderColor = "red";
                emailInput.style.boxShadow = "0 0 5px red";

                // Disable the submit button
                submitBtn.disabled = true;

                return false;
            } else {
                // Hide the validation popup for email format
                validationPopup.style.display = "none";
                emailInput.classList.remove("error-input");

                // Reset the focus color and shadow
                emailInput.style.borderColor = ""; // Reset to the default border color
                emailInput.style.boxShadow = ""; // Reset to the default box shadow

                // Enable the submit button if there are no validation issues
                submitBtn.disabled = false;
            }

            return true;
        }

        $(document).ready(function() {
            $('.login-form').on('submit', function(e) {
                e.preventDefault();

                // Disable the submit button
                $(this).find(':submit').prop('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: '../Php/check_email.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#email').hide();
                            $('.login-button').hide();
                            $('.sent').show();
                            $('.login-text').text('EMAIL SENT SUCCESSFULLY');
                            $('#validationPopup3').show();
                            setTimeout(function() {
                                $('#validationPopup3').hide();
                            }, 3000);


                        } else {
                            $('#validationPopup2').show();
                            setTimeout(function() {
                                $('#validationPopup2').hide();
                            }, 3000);
                        }
                    },
                    complete: function() {
                        // Re-enable the submit button
                        $('.login-form').find(':submit').prop('disabled', false);

                    }
                });
            });
        });
    </script>


</body>

</html>