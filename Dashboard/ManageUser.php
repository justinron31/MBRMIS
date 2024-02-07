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




    <title>MAKILING BRMI SYSTEM - Manage Users</title>
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
                        <li class="item active">
                            <a href="#" class="link flex">
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
                            <a href="/MBRMIS/Dashboard/AdminSettings.php" class="link flex">
                                <i class="bx bx-cog"></i>
                                <span>Settings</span>
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
                        MANAGE SYSTEM USER
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



                <!--TABLE-->
                <main class="table" id="customers_table">

                    <section class="table__header">

                        <!-- SEARCH BAR-->
                        <div class="input-group">
                            <input type="search" placeholder="Search...">
                            <i class='bx bx-search-alt'></i>
                        </div>

                    </section>

                    <div class="tableHead">
                        <!--TOTAL USER-->
                        <?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

if ($result) {
    $totalUsers = $result->num_rows;
}
echo "<h1 class='titleTable'>Total Staff: " . $totalUsers . "</h1>";
?>

                        <div class="export__file">
                            <button type="button" class="export__file-btn" title="Export File" onclick="togglePopup()">
                                <i class='bx bxs-file-export'></i>
                                <p class="exportTitle">Export</p>
                            </button>
                        </div>


                    </div>

                    <section class="table__body">



                        <!--TABLE CONTENT-->
                        <table>
                            <thead>
                                <tr>
                                    <th> ID Number <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Firstname <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Lastname <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Gender <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Role <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Account Status <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Action </th>
                                </tr>
                            </thead>

                            <tbody>


                                <?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

$sql = "SELECT firstname, lastname, idnumber, email, gender,staff_role, account_status FROM staff";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $class = (strtolower(trim($row["account_status"])) == 'activated') ? 'delivered' : 'cancelled';
        $uniqueId = 'edit_' . $row["idnumber"];
        echo "<tr>" .
            "<td>" . $row["idnumber"] . "</td>" .
            "<td>" . $row["firstname"] . "</td>" .
            "<td>" . $row["lastname"] . "</td>" .
            "<td>" . $row["gender"] . "</td>" .
            "<td>" . $row["email"] . "</td>" .
            "<td>" . $row["staff_role"] . "</td>" .
            "<td><p class='status $class'>" . $row["account_status"] . "</p></td>" .
            "<td><i class='bx bxs-edit edit-icon' onclick='openCustomModal(\"{$row["idnumber"]}\", \"{$row["account_status"]}\")'></i></td>" .
            "</tr>";
    }
    $result->close();
} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}

$conn->close();
?>
                                <!-- POPUP FORM ACCOUNT EDIT -->
                                <div id="customEditModal" class="custom-modal">
                                    <div class="custom-modal-content">
                                        <h2 class="editAccountTitle">Edit Account Role and Status </h2>
                                        <p id="customUserName"></p>
                                        <form id="customEditForm" action="/MBRMIS/Php/updateAstatus.php" method="post">

                                            <div class="updatecon">
                                                <div class="accountstatus">
                                                    <input type="hidden" id="customUserId" name="customUserId" value="">
                                                    <label for="customRole">Role:</label>
                                                    <select id="customRole" name="customRole">
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staff">Staff</option>
                                                    </select>


                                                </div>

                                                <div class="rolestatus">

                                                    <label for="customStatus">Account Status:</label>
                                                    <select id="customStatus" name="customStatus">
                                                        <option value="Activated">Activated</option>
                                                        <option value="Deactivated">Deactivated</option>
                                                    </select>

                                                </div>


                                                <button id="updateButton" class="updateButton"
                                                    type="submit">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>



                            </tbody>
                        </table>
                    </section>
                </main>


            </div>
</body>




</html>