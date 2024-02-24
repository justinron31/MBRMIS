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


    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>

    </script>

    <title>MAKILING BRMI SYSTEM - Dashboard</title>
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



<!--LOGIN MESSAGE-->
<div id="loginPopup" class="popup">
    <p>Login successfully!</p>
</div>



<body>

    <!-- JavaScript for Popup -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($showLoginMessage): ?>
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
        <?php endif;?>
    });
    </script>




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
                        <li class="item active">
                            <a href="#" class="link flex">
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


                        <!-- cert of indigency badge count  -->
                        <?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

$count = 0;
$query = "SELECT * FROM file_request WHERE datetime_created > NOW() - INTERVAL 1 DAY AND viewed = 0 AND type='Certificate of Indigency'";
$result = mysqli_query($conn, $query);

if ($result) {
    $count = mysqli_num_rows($result);
} else {
  
    echo "Error: " . mysqli_error($conn);
}
?>

                        <li class="item">
                            <a id="indigency-link" href="/MBRMIS/Dashboard/AdminCertofIndigency.php" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        badge
                                    </span>
                                </i>
                                <span>Certificate of Indigency</span>
                                <?php if($count > 0): ?>
                                <span class="badge"><?php echo $count; ?></span>
                                <?php endif; ?>
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
                            <a href="/MBRMIS/Dashboard/AdminManageUser.php" class="link flex">
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

                        <li class="item">
                            <a href="/MBRMIS/Dashboard/AdminProfile.php" class="link flex">
                                <i class='bx bxs-user'></i>
                                <span>Profile</span>
                            </a>
                        </li>


                        <li class="item " onclick="openLogoutModal()">
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
                            <div class="number">1217</div>
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
                            <div class="number">563</div>
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
                            <div class="number">563</div>
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
                                <div class="number1">563</div>
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
                                <div class="number1">563</div>
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
include '../Php/db.php';

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
                                    <div class="numberP">18</div>
                                </div>

                                <div class="reqIcon">
                                    <span class="material-symbols-outlined">
                                        card_membership
                                    </span>
                                    <div class="pendingTitle">
                                        First Time Job Seeker
                                    </div>
                                    <div class="numberP">8</div>
                                </div>

                                <div class="reqIcon">
                                    <span class="material-symbols-outlined">
                                        lab_profile
                                    </span>
                                    <div class="pendingTitle">
                                        Community Tax Certificate
                                    </div>
                                    <div class="numberP">3</div>
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



</body>




</html>