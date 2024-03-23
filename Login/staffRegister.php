<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require "./phpmailer/src/PHPMailer.php";
require "./phpmailer/src/SMTP.php";
require "./phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
include "../Php/db.php";

if (isset($_POST["register"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

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
    $mail->addAddress($email, $name);

    //Set email format to HTML
    $mail->isHTML(true);

    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

    $mail->Subject = 'Email verification';
    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

    $mail->send();
    // echo 'Message has been sent';

    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "makiling");

    // insert in users table
    $sql = "INSERT INTO staff(firstname, lastname, idnumber, email, gender, age, last_login_timestamp, is_logged_in, pass, verification_code, email_verified_at) VALUES ( '" . $firstname . "', '" . $lastname . "', '" . $idnumber . "', '" . $email . "', '" . $gender . "', '" . $age . "', '" . $last_login . "', '" . $is_logged_in . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
    mysqli_query($conn, $sql);

    header("Location: email-verification.php?email=" . $email);
    exit();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
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
  <script src="../Login/CSS,JS/login.js"></script>

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
        <img class="logo" src="../Images/logo.png" alt="Makiling logo" />
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





  <!--LOGIN FORM-->
  <div class="login-containerReg">
    <div class="logo-container">
      <p class="login-text">STAFF REGISTRATION</p>
      <hr />
    </div>

    <form class="login-form" method="post" onsubmit="return validatePassword() && validateEmail();">

      <div class="first">

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
          <input type="text" id="idnum" name="idnum" placeholder="Enter ID number" oninput="validateIDNumber();" required />
        </div>

        <!-- ─── Age ──────────────── -->
        <div class="staffName2">
          <label class="required">Age</label>
          <input type="text" id="age" name="age" placeholder="Enter Age" maxlength="2" oninput="validateAge(this)" required />
        </div>

        <!-- ─── Gender ───────────── -->
        <div class="staffName2">
          <label class="required">Gender</label>
          <select class="selectbox" id="genderSelect" name="genderSelect" required onchange="changeFontColor()">
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
      <button type="submit" class="login-button" name="register">SUBMIT</button>
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

</html>