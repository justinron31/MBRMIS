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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />


    <!--CSS-->
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
    <link rel="stylesheet" href="../Dashboard/CSS,JS/Dashboard.css" />
    <link rel="stylesheet" href="../Dashboard/CSS,JS/Table.css" />


    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>




    <title>MAKILING BRMI SYSTEM - Settings</title>
</head>


<!--LOGIN PHP -->
<?php
session_start();


// Check if the user is not logged in as admin
if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page
    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$userName = $_SESSION['user_name'];

// Check if the login message should be displayed
$showLoginMessage = isset($_SESSION['show_login_message']) && $_SESSION['show_login_message'] === true;

// Reset the session variable to avoid displaying the message on page refresh
$_SESSION['show_login_message'] = false;
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


<?php


// Check for session variables and display popups accordingly
if (isset($_SESSION['password_updated'])) {
    echo '<script>
            // Display the "Password Successfully Updated!" popup
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup1").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup1").style.display = "none";
                }, 3000); // Hide the popup after 3 seconds
            });
          </script>';
    unset($_SESSION['password_updated']); // Clear the session variable
} elseif (isset($_SESSION['incorrect_password'])) {
    echo '<script>
            // Display the "Incorrect current password. Please try again." popup
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup3").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup3").style.display = "none";
                }, 3000); // Hide the popup after 3 seconds
            });
          </script>';
    unset($_SESSION['incorrect_password']); // Clear the session variable
}
?>

<body>


    <!--  MODAL POPUP-->
    <div id="overlay" class="overlay"></div>
    <div id="logoutModal" class="modal">
        <div class="modal-message">
            <p>Do you want to logout?</p>
        </div>
        <div class="modal-buttons">
            <button class="yes" onclick="logout()">Yes</button>
            <button class="no" onclick="closeLogoutModal()">No</button>
        </div>
    </div>

    <!-- SIDEBAR-->
    <div class="masterCOn">
        <nav class="sidebar locked">
            <div class="logo_items flex">
                <span class="nav_image">
                    <img src="../Images/logo.png" alt="logo_img" />
                </span>
                <span class="logo_name"> MBRMI SYSTEM</span>
                <i class="bx bxs-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
                <i class="bx bx-x" id="sidebar-close" title="lock Sidebar"></i>
            </div>


            <!--SIDEBAR CONTENT-->
            <div class="menu_container">
                <div class="menu_items">
                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">Dashboard</span>
                            <span class="line"></span>
                        </div>
                        <li class="item ">
                            <a href="/MBRMIS/Dashboard/AdminDashboard.php" class="link flex">
                                <i class="bx bxs-dashboard"></i>
                                <span>Overview</span>
                            </a>
                        </li>

                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        location_away
                                    </span>
                                </i>
                                <span>Residents Record</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">Menu</span>
                            <span class="line"></span>
                        </div>

                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        badge
                                    </span>
                                </i>
                                <span>Barangay Certificates</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        clinical_notes
                                    </span>
                                </i>
                                <span>Certificate of Residency</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        card_membership
                                    </span>
                                </i>
                                <span>First Time Job Seeker</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        lab_profile
                                    </span>
                                </i>
                                <span>Community Tax Certificate</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        home_storage
                                    </span>
                                </i>
                                <span>Requested Documents</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">Others</span>
                            <span class="line"></span>
                        </div>
                        <li class="item">
                            <a href="/MBRMIS/Dashboard/ManageUser.php" class="link flex">
                                <i class='bx bxs-user-detail'></i>
                                <span>Manage System User</span>
                            </a>
                        </li>
                        <li class="item ">
                            <a href="#" class="link flex">
                                <i class='bx bxs-report'></i>
                                <span>Reporting View</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">System</span>
                            <span class="line"></span>
                        </div>
                        <li class="item active">
                            <a href="#" class="link flex">
                                <i class='bx bxs-user'></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="item1 " onclick="openLogoutModal()">
                            <a href="#" class="link flex">
                                <i class='bx bxs-exit bx-rotate-180'></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- MAIN CONTENT-->
        <div class="headermain">



            <div class="headerTop">
                <div class="header">

                    <h1 class="maintitle">
                        SETTINGS
                    </h1>

                    <div class="access">
                        <p class="name">
                            Admin
                            <?php echo $userName; ?>

                        </p>
                        <div class="logoHead">

                            <img src="../Images/user.png" alt="logo_img" />
                        </div>

                    </div>


                </div>
            </div>


            <!-- TABLE MAIN -->

            <div class="supermaincontain">

                <?php
                include 'C:\xampp\htdocs\MBRMIS\Php\admindb.php';

                ?>

                <main class="table1" id="customers_table">
                    <section class="table__header">
                        <h1 class="profileTitle">PROFILE INFORMATION </h1>
                        <div class="export__file">
                            <button type="button" class="export__file-btn" id="editButton" onclick="toggleEdit()">
                                <p class="exportTitle"><strong>EDIT</strong></p>
                            </button>


                            <form method="POST" action="">
                                <button type="submit" class="export__file-btn1" id="saveButton" name="saveButton"
                                    style="display: none;" disabled>
                                    <p class="exportTitle"><strong>SAVE</strong></p>
                                </button>

                        </div>
                    </section>

                    <div class="profileCon">
                        <?php if ($result->num_rows > 0) : ?>
                        <?php $row = $result->fetch_assoc(); ?>

                        <div class="firstcon">
                            <div class="f1">
                                <label class="required">ID number</label>
                                <input type="text" id="idnum" name="idnum"
                                    value="<?php echo isset($row["idnumber"]) ? $row["idnumber"] : ''; ?>" disabled />
                            </div>

                            <div class="f2">
                                <label class="required">Email</label>
                                <input type="text" id="email" name="email" oninput="validateEmail();"
                                    value="<?php echo isset($row["email"]) ? $row["email"] : ''; ?>" disabled />
                            </div>
                        </div>

                        <div class="firstcon">
                            <div class="f1">
                                <label class="required">Firstname</label>
                                <input type="text" id="fname" name="fname"
                                    value="<?php echo isset($row["firstname"]) ? $row["firstname"] : ''; ?>" disabled />
                            </div>

                            <div class="f2">
                                <label class="required">Lastname</label>
                                <input type="text" id="lname" name="lname"
                                    value="<?php echo isset($row["lastname"]) ? $row["lastname"] : ''; ?>" disabled />
                            </div>
                        </div>

                        <div class="firstcon">
                            <div class="f1">
                                <label class="required">Age</label>
                                <input type="text" id="age" name="age" maxlength="2" oninput="validateAge(this)"
                                    value=" <?php echo isset($row["age"]) ? $row["age"] : ''; ?>" disabled />
                            </div>

                            <div class="f2">
                                <label class="required">Gender</label>
                                <select id="gender" name="gender" disabled>
                                    <option value="Male"
                                        <?php echo isset($row["gender"]) && $row["gender"] === "Male" ? "selected" : ""; ?>>
                                        Male</option>
                                    <option value="Female"
                                        <?php echo isset($row["gender"]) && $row["gender"] === "Female" ? "selected" : ""; ?>>
                                        Female</option>
                                </select>
                            </div>
                            </form>
                        </div>

                        <div class="passCon" id="passCon" style="display: none;">
                            <button type=" button" class="reset__password-btn" onclick="toggleForm()">Reset
                                Password</button>
                        </div>







                        <div class="passForm" id="passForm" style="display: none;">
                            <form id="passForm1" method="post" action="/MBRMIS/Php/updatePassword.php">

                                <br>
                                <div class="passForm__group">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" id="currentPassword" name="currentPassword"
                                        placeholder="Enter Current Password" required>
                                </div>
                                <div class="passForm__group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" id="pass" name="pass" placeholder="Enter Password" required>
                                </div>
                                <div class="passForm__group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" id="cpass" name="cpass" placeholder="Confirm Password"
                                        oninput="validatePassword();" required>
                                </div>
                                <button type=" submit" id="resetButton" class="reset__password-btn"
                                    name="changePassword">Change
                                    Password</button>
                            </form>
                        </div>




                    </div>
                    <?php else : ?>
                    <p>No results found</p>
                    <?php endif; ?>


            </div>



            </main>
        </div>
</body>



</div>





</html>