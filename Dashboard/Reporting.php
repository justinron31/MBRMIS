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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.1/exceljs.min.js"></script>
    <script src="node_modules/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/xlsx@0.16.8/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>


    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>
    <script src="../Dashboard/CSS,JS/Export.js" defer></script>




    <title>MAKILING BRMI SYSTEM - Reporting</title>
</head>


<!--LOGIN PHP -->
<?php
session_start();

// Check if the user is not logged in as admin or staff, or if idnumber is not set
if (!isset($_SESSION['user_name']) || ($_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'staff') || !isset($_SESSION['idnumber'])) {
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
                    MANAGE SYSTEM USER
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
                    include '../Php/db.php';

                    $idnum = $_SESSION['idnumber'];
                    $sql = "SELECT * FROM staff WHERE idnumber != $idnum";
                    $result = $conn->query($sql);

                    if ($result) {
                        $totalUsers = $result->num_rows;
                    }
                    echo "<h1 class='titleTable'>Total Staff: " . $totalUsers . "</h1>";
                    ?>

                    <div class="export__file">
                        <button type="button" class="export__file-btn" title="Export File" onclick="fnManageReport()">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>
                        </button>
                    </div>


                </div>

                <section class="table__body">
                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="headerTable">
                            <thead>
                                <tr>
                                    <th> ID Number <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Firstname <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Lastname <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Gender <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Age <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Role <span class="icon-arrow">&UpArrow;</span></th>
                                    <th class="center"> Account Status <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Last Login <span class="icon-arrow">&UpArrow;</span></th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

                                $idnum = $_SESSION['idnumber'];

                                $sql = "SELECT firstname, lastname, idnumber, email, gender,staff_role,age, account_status, last_login_timestamp FROM staff WHERE idnumber != '$idnum' ORDER BY dateCreated DESC";
                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $class = (strtolower(trim($row["account_status"])) == 'activated') ? 'delivered' : 'cancelled';
                                        $uniqueId = 'edit_' . $row["idnumber"];
                                        echo "<tr>" .
                                            "<td><strong>" . $row["idnumber"] . "</strong></td>" .
                                            "<td>" . $row["firstname"] . "</td>" .
                                            "<td>" . $row["lastname"] . "</td>" .
                                            "<td>" . $row["gender"] . "</td>" .
                                            "<td>" . $row["age"] . "</td>" .
                                            "<td>" . $row["email"] . "</td>" .
                                            "<td><strong>" . $row["staff_role"] . "</strong></td>" .
                                            "<td ><p class='status $class'>" . $row["account_status"] . "</p></td>" .
                                            "<td title='" . date("l", strtotime($row["last_login_timestamp"])) . "'>" . date("F j, Y, g:i a", strtotime($row["last_login_timestamp"])) . "</td>" .
                                            "<td><i class='bx bxs-edit edit-icon' onclick='openCustomModal(\"{$row["idnumber"]}\", \"{$row["account_status"]}\")'></i> <i class='bx bxs-trash-alt' onclick='deleteUser(\"{$row["idnumber"]}\")'></i></td>" .
                                            "</tr>";
                                    }
                                    $result->close();
                                } else {
                                    echo "<tr><td colspan='7'>No data found</td></tr>";
                                }

                                $conn->close();
                                ?>


                            </tbody>
                        </table>
                    </div>
                </section>
            </main>


        </div>
</body>




</html>