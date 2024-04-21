<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Barangay management system for makiling" />
    <meta name="keywords" content="Web Development, Barangay Management System" />
    <meta name="authors" content="Arcillas, Galang, Ignacio" />

    <!--IMPORT-->
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />


    <!--CSS-->
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <link rel="stylesheet" href="./CSS,JS/Dashboard.css" />
    <link rel="stylesheet" href="./CSS,JS/Table.css" />


    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./CSS,JS/Table.js" defer></script>
    <script src="./CSS,JS/Dashboard.js" defer></script>



    <title>MAKILING BRMI SYSTEM - Profile</title>

</head>


<!--LOGIN PHP -->
<?php
session_start();

// Check if the user is not logged in as admin or staff, or if idnumber is not set
if (!isset($_SESSION['user_name']) || ($_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'staff') || !isset($_SESSION['idnumber'])) {
    // Redirect to login page
    header("Location: ../Login/loginStaff.php");
    exit();
}

$userName = $_SESSION['user_name'];

// Check if the login message should be displayed
$showLoginMessage = isset($_SESSION['show_login_message']) && $_SESSION['show_login_message'] === true;

// Reset the session variable to avoid displaying the message on page refresh
$_SESSION['show_login_message'] = false;
?>

<?php
if (isset($_SESSION['password_updated'])) {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup1").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup1").style.display = "none";
                }, 3000);
            });
          </script>';
    unset($_SESSION['password_updated']);
} elseif (isset($_SESSION['incorrect_password'])) {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup3").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup3").style.display = "none";
                }, 3000);
            });
          </script>';
    unset($_SESSION['incorrect_password']);
} elseif (isset($_SESSION['same_password'])) {
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


<!-- MESSAGE-->
<div id="loginPopup" class="popup">
    <p>Details Updated Successfully!</p>
</div>

<!--VALIDATION MESSAGE-->
<div id="validationPopup" class="popup2">
    <p>Passwords do not match!</p>
</div>

<!--VALIDATION MESSAGE-->
<div id="validationPopup1" class="popup">
    <p>Password Successfully Updated!</p>
</div>

<!--VALIDATION MESSAGE-->
<div id="validationPopup3" class="popup2">
    <p>Incorrect current password. Please try again.</p>
</div>

<!--VALIDATION MESSAGE-->
<div id="validationPopup5" class="popup2">
    <p>Don't use the same old password!.</p>
</div>




<body>

    <!-- Idle and logout modal-->
    <?php include '../Components/idle.php'; ?>

    <!-- Sidenav-->
    <?php include '../Components/sidenav.php'; ?>


    <!-- MAIN CONTENT-->
    <div class="headermain">

        <div class="headerTop">
            <div class="header">
                <h1 class="maintitle">
                    PROFILE SETTINGS
                </h1>
                <div class="access">
                    <p class="name">
                        <?php
                        if ($_SESSION['user_type'] === 'admin') {
                            echo 'Admin';
                        } else {
                            echo 'Staff';
                        }
                        echo ' ' . $userName;
                        ?>
                    </p>
                </div>
            </div>
        </div>


        <!-- TABLE MAIN -->

        <div class="supermaincontain">

            <?php
            include '../Php/admindb.php';
            ?>

            <main class="table1" id="customers_table" style="width:fit-content; border: 4px solid #377fb9;">
                <section class="table__header1" style="background-color: #266e60;">

                    <h1 class="profileTitle" style="color: white;">PROFILE INFORMATION </h1>

                    <form method="POST">

                        <div class="export__file">
                            <button type="button" class="export__file-btn" id="editButton" onclick="toggleEdit()">
                                <p class="exportTitle"><strong>EDIT</strong></p>
                            </button>
                            <button type="submit" class="export__file-btn1" id="saveButton" name="saveButton" style="display: none;" disabled>
                                <p class="exportTitle"><strong>SAVE</strong></p>
                            </button>
                        </div>
                </section>

                <div class="profileCon">
                    <?php if ($result->num_rows > 0) : ?>
                        <?php $row = $result->fetch_assoc(); ?>

                        <div class="profilewrapper">
                            <div class="profilefirst">
                                <div class="firstcon">
                                    <div class="f1">
                                        <label class="required">ID number</label>
                                        <input type="text" id="idnum" name="idnum" value="<?php echo isset($row["idnumber"]) ? $row["idnumber"] : ''; ?>" readonly />
                                    </div>

                                    <div class="f2">
                                        <label class="required">Email</label>
                                        <input type="text" id="email" name="email" value="<?php echo isset($row["email"]) ? $row["email"] : ''; ?>" readonly />
                                    </div>
                                </div>

                                <div class="firstcon">
                                    <div class="f1">
                                        <label class="required">Firstname</label>
                                        <input type="text" id="fname" name="fname" value="<?php echo isset($row["firstname"]) ? $row["firstname"] : ''; ?>" disabled />
                                    </div>

                                    <div class="f2">
                                        <label class="required">Lastname</label>
                                        <input type="text" id="lname" name="lname" value="<?php echo isset($row["lastname"]) ? $row["lastname"] : ''; ?>" disabled />
                                    </div>
                                </div>

                                <div class="firstcon">
                                    <div class="f1">
                                        <label class="required">Age</label>
                                        <input type="text" id="age" name="age" maxlength="2" oninput="validateAge(this)" value=" <?php echo isset($row["age"]) ? $row["age"] : ''; ?>" disabled />
                                    </div>

                                    <div class="f2">
                                        <label class="required">Gender</label>
                                        <select id="gender" name="gender" disabled>
                                            <option value="Male" <?php echo isset($row["gender"]) && $row["gender"] === "Male" ? "selected" : ""; ?>>
                                                Male</option>
                                            <option value="Female" <?php echo isset($row["gender"]) && $row["gender"] === "Female" ? "selected" : ""; ?>>
                                                Female</option>
                                        </select>
                                    </div>
                                </div>


                                </form>
                                <div class="passCon" id="passCon" style="display: none;">
                                    <button type=" button" class="reset__password-btn" onclick="toggleForm()">Change
                                        Password</button>
                                </div>
                            </div>

                            <div class="passForm" id="passForm" style="display: none;">
                                <form id=" passForm1" method="post" action="../Php/updatePassword.php">


                                    <div class="passForm__group">
                                        <label for="currentPassword">Current Password</label>
                                        <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter Current Password" required>
                                    </div>
                                    <div class="passForm__group">

                                        <p id="validationPopup4">Password must contain at least <strong>one uppercase
                                                letter</strong>, <strong>one
                                                lowercase
                                                letter</strong>, <strong>one digit</strong>, and at least <strong>8
                                                characters long.</strong></p>

                                        <label for="newPassword">New Password</label>
                                        <input type="password" id="pass" name="pass" placeholder="Enter Password" required oninput="validatePassword1()">
                                    </div>
                                    <div class="passForm__group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" id="cpass" name="cpass" placeholder="Confirm Password" oninput="validatePassword();" required>
                                    </div>
                                    <button type=" submit" id="resetButton" class="reset__password-btn" name="changePassword">Save changes
                                    </button>
                                </form>
                            </div>
                        </div>

                </div>
            <?php else : ?>
                <p>No results found</p>
            <?php endif; ?>
        </div>


    </div>
</body>


</div>

<script>
    $(document).ready(function() {
        // Check for session variable on page load
        <?php if ($_SESSION['showPopup']) : ?>
            // Show a custom popup if the session variable is set
            showCustomPopup('Details Updated Successfully!');
            // Unset the session variable
            <?php unset($_SESSION['showPopup']); ?>
        <?php endif; ?>
    });
</script>



</html>