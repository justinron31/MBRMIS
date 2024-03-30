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
    <script src="../Dashboard/CSS,JS/Export.js"></script>


    <title>MAKILING BRMI SYSTEM - Request Documents</title>
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
                    REQUEST DOCUMENTS
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
                        <input type="search" placeholder="Search">
                        <i class='bx bx-search-alt'></i>

                    </div>

                    <div class="export__file">

                        <div class="tableHead">
                            <!--TOTAL USER-->
                            <?php
                            include '../Php/db.php';

                            $result1 = mysqli_query($conn, "SELECT COUNT(*) AS count FROM file_request");
                            $result2 = mysqli_query($conn, "SELECT COUNT(*) AS count FROM first_time_job");

                            $row1 = mysqli_fetch_assoc($result1);
                            $row2 = mysqli_fetch_assoc($result2);

                            $total = $row1['count'] + $row2['count'];
                            ?>

                            <h1 class="titleTable">Total File Request: <span><?php echo $total; ?></span></h1>
                        </div>

                        <button type="button" class="export__file-btn" title="Export File" onclick="fnIndigencyReport()"
                            style="margin-left:10px;">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>

                        </button>
                    </div>

                </section>



                <section class="table__body" id="headerTable">
                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table>
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> Document Type </th>
                                    <th class="center" title="Filter: Ascending/Descending"> Status </th>
                                    <th title="Filter: Ascending/Descending"> Firstname </th>
                                    <th title="Filter: Ascending/Descending"> Lastname </th>
                                    <th title="Filter: Ascending/Descending"> Tracking Number </th>
                                    <th title="Filter: Ascending/Descending"> Contact Number </th>
                                    <th title="Filter: Ascending/Descending"> Purpose </th>
                                    <th title="Filter: Ascending/Descending"> Pickup Date </th>
                                    <th title="Filter: Ascending/Descending"> Date Submitted </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include '../Php/db.php';

                                $sql = "SELECT id, type, file_status, firstname, lastname, tracking_number, contact_number,  pickup_datetime, purpose_description,  datetime_created
                                FROM file_request
                                WHERE file_status = 'reviewing'
                                UNION ALL
                                SELECT id, type, file_status, firstname, lastname, tracking_number, contact_number,  pickup_datetime, purpose_description,  datetime_created
                                FROM first_time_job
                                WHERE file_status = 'reviewing'";
                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $file_status = strtolower(trim($row["file_status"]));
                                        if ($file_status == 'ready for pickup') {
                                            $class = 'delivered';
                                        } elseif ($file_status == 'declined') {
                                            $class = 'cancelled';
                                        } elseif ($file_status == 'reviewing') {
                                            $class = 'pending';
                                        } elseif ($file_status == 'processing') {
                                            $class = 'processing';
                                        } else {
                                            $class = '';
                                        }
                                        $uniqueId = 'edit_' . $row["id"];
                                        echo "<tr>" .
                                            "<td><strong>" . $row["type"] . "</strong></td>" .
                                            "<td style='text-align: center;'><p class='status $class padding'>" . $row["file_status"] . "</p></td>" .
                                            "<td>" . $row["firstname"] . "</td>" .
                                            "<td>" . $row["lastname"] . "</td>" .
                                            "<td>" . $row["tracking_number"] . "</td>" .
                                            "<td>" . $row["contact_number"] . "</td>" .
                                            "<td>" . $row["purpose_description"] . "</td>" .
                                            "<td title='" . date("l", strtotime($row["pickup_datetime"])) . "'>" . date("F j, Y, g:i a", strtotime($row["pickup_datetime"])) . "</td>" .
                                            "<td title='" . date("l", strtotime($row["datetime_created"])) . "'>" . date("F j, Y, g:i a", strtotime($row["datetime_created"])) . "</td>" .
                                            "<td><i class='bx bxs-edit edit-icon' data-file-id='" . $row["id"] . "'></i></td>" .
                                            "</tr>";
                                    }
                                    $result->close();
                                } else {
                                    echo "<tr><td colspan='8'>No data found</td></tr>";
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