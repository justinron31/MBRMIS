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
    <link rel="stylesheet" href="../Dashboard/CSS,JS/Dashboard.css" />


    <title>MAKILING BRMI SYSTEM - Dashboard</title>
</head>

<?php include '../Php/db.php'; ?>

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



<!--LOGIN MESSAGE-->
<div id="loginPopup" class="popup">
    <p>Login successfully!</p>
</div>



<body>

    <!-- JavaScript for Popup -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($showLoginMessage) : ?>
                var loginPopup = document.getElementById('loginPopup');
                if (loginPopup) {
                    loginPopup.style.display = 'block';

                    // Trigger the slide-up animation after 2 seconds
                    setTimeout(function() {
                        loginPopup.classList.add('slide-up');
                    }, 1500);

                    // Hide the popup after 3 seconds
                    setTimeout(function() {
                        loginPopup.style.display = 'none';
                    }, 2000);
                }
            <?php endif; ?>
        });
    </script>

    <!-- Idle and logout modal-->
    <?php include '../Components/idle.php'; ?>

    <!-- Sidenav-->
    <?php include '../Components/sidenav.php'; ?>

    <!-- MAIN CONTENT-->
    <div class="headermain">

        <div class="headerTop">
            <div class="header">

                <h1 class="maintitle">
                    OVERVIEW
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


        <!-- MAIN CONTENT -->

        <div class="supermaincontain">

            <div class="cards">


                <div class="card">
                    <div class="icon-box">
                        <span class="material-symbols-outlined">
                            group
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="number">0</div>
                        <div class="card-name">Population</div>
                    </div>
                </div>

                <div class="card">
                    <div class="icon-box1">
                        <span class="material-symbols-outlined">
                            man
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="number">0</div>
                        <div class="card-name">Male</div>
                    </div>
                </div>

                <div class="card">
                    <div class="icon-box1">
                        <span class="material-symbols-outlined">
                            woman
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="number">0</div>
                        <div class="card-name">Female</div>
                    </div>
                </div>

                <div class="cardVoters">

                    <div class="con1">
                        <div class="icon-box2">
                            <span class="material-symbols-outlined">
                                person_check
                            </span>
                        </div>

                        <div class="card-content">
                            <div class="number1">0</div>
                            <div class="card-name1">Voters</div>
                        </div>

                    </div>
                    <div class="con1">
                        <div class="icon-box2">
                            <span class="material-symbols-outlined">
                                person_cancel
                            </span>
                        </div>

                        <div class="card-content">
                            <div class="number1">0</div>
                            <div class="card-name1">Non - Voters</div>
                        </div>

                    </div>


                </div>

            </div>


            <!--LOWER CONTENT-->
            <div class="lowerCon">
                <div class="Pending">

                    <div class="Req">

                        <div class="reqHead">
                            <div class="card-nameR">PENDING FILE REQUEST</div>
                            <div class="seeMore"> <a href="#">See more</a></div>
                        </div>

                        <div class="reqItem">
                            <div class="reqIcon">
                                <span class="material-symbols-outlined">
                                    badge
                                </span>
                                <div class="pendingTitle">
                                    Certificate of Indigency
                                </div>
                                <?php

                                $sql = "SELECT * FROM file_request WHERE type='Certificate of Indigency'";
                                $result = $conn->query($sql);

                                if ($result) {
                                    $totalReq = $result->num_rows;
                                }
                                ?>

                                <div class="numberP"><?php echo $totalReq; ?></div>
                            </div>

                            <div class="reqIcon">
                                <span class="material-symbols-outlined">
                                    clinical_notes
                                </span>
                                <div class="pendingTitle">
                                    Certificate of Residency
                                </div>

                                <?php

                                $sql = "SELECT * FROM file_request WHERE type='Certificate of Residency'";
                                $result = $conn->query($sql);

                                if ($result) {
                                    $totalReq = $result->num_rows;
                                }
                                ?>

                                <div class="numberP"><?php echo $totalReq; ?></div>
                            </div>



                            <div class="reqIcon">
                                <span class="material-symbols-outlined">
                                    card_membership
                                </span>
                                <div class="pendingTitle">
                                    First Time Job Seeker
                                </div>

                                <?php

                                $sql = "SELECT * FROM first_time_job WHERE type='First Time Job Seeker'";
                                $result = $conn->query($sql);

                                if ($result) {
                                    $totalReq = $result->num_rows;
                                }
                                ?>

                                <div class="numberP"><?php echo $totalReq; ?></div>
                            </div>

                            <div class="reqIcon">
                                <span class="material-symbols-outlined">
                                    lab_profile
                                </span>
                                <div class="pendingTitle">
                                    Requested Documents
                                </div>
                                <div class="numberP">0</div>
                            </div>


                        </div>

                    </div>

                </div>

                <!--CALENDAR-->
                <div id="calendar">
                    <div class="calendarBg">
                        <div id="calendar-header">
                            <span id="month-prev" class="change-month">&lt;</span>
                            <h1 id="month" onclick="showCurrentDate()"></h1>
                            <span id="month-next" class="change-month">&gt;</span>
                        </div>
                        <div id="days"></div>
                        <div id="calendar-body"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Session.js" defer></script>

</body>


</html>