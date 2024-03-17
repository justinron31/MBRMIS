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
    <link rel="stylesheet" href="../Dashboard/CSS,JS/Table.css" />


    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.1/exceljs.min.js"></script>
    <script src="node_modules/xlsx/dist/xlsx.full.min.js"></script>

    <script src="https://unpkg.com/xlsx@0.16.8/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>


    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>
    <script src="../Dashboard/CSS,JS/Export.js"></script>


    <title>MAKILING BRMI SYSTEM - Certificate of Recidency</title>
</head>


<!--LOGIN PHP -->
<?php
session_start();

// Check if the user is not logged in as admin or if idnumber is not set
if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin' || !isset($_SESSION['idnumber'])) {
    // Redirect to login page
    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$userName = $_SESSION['user_name'];

// Add idnumber to the session
$idNumber = $_SESSION['idnumber'];

// Check if the login message should be displayed
$showLoginMessage = isset($_SESSION['show_login_message']) && $_SESSION['show_login_message'] === true;

// Reset the session variable to avoid displaying the message on page refresh
$_SESSION['show_login_message'] = false;
?>


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
                    CERTIFICATE OF RESIDENCY
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
                    <h1 class="titleTable">Total File Request: <span id="totalReq1">0</span></h1>

                    <div class="export__file">
                        <button type="button" class="export__file-btn" title="Export File" onclick="fnIndigencyReport()">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>

                        </button>
                    </div>

                </div>

                <section class="table__body" id="headerTable">
                    <!--TABLE CONTENT-->
                    <table>
                        <thead>
                            <tr>
                                <th> Tracking Number <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Firstname <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Lastname <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Contact Number <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Voters ID Number <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Voters ID Img <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Purpose <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Pickup Date <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Date Submitted <span class="icon-arrow">&UpArrow;</span></th>
                                <th class="center"> Action </th>
                            </tr>
                        </thead>

                        <tbody id="fileRequestsTable1">

                            <div id="customEditModal1" class="custom-modal">
                                <div class="custom-modal-content">
                                    <h2 class="editAccountTitle">Update File Request Status </h2>
                                    <p id="TrackingN"></p>
                                    <form id="customEditForm1" action="/MBRMIS/Php/updateFile.php" method="post">
                                        <div class="updatecon">
                                            <div class="accountstatus">
                                                <input type="hidden" id="fileStatusId" name="fileStatusId" value="">
                                                <label for="fileStatus">File Status:</label>
                                                <select id="fileStatus" name="fileStatus">
                                                    <option value="Ready for Pickup">Ready for Pickup</option>
                                                    <option value="Declined">Declined</option>
                                                    <option value="Reviewing">Reviewing</option>
                                                </select>
                                            </div>
                                            <button id="updateButton1" class="updateButton" type="submit">Update</button>
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