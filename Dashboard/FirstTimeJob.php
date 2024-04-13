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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>
    <script src="../Dashboard/CSS,JS/Export.js"></script>


    <title>MAKILING BRMI SYSTEM - First Time Job Seeker</title>
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
                    FIRST TIME JOB SEEKER
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

                    <div class="export__file">

                        <div class="tableHead">
                            <!--TOTAL USER-->
                            <h1 class="titleTable">Total File Request: <span id="totalReq2">0</span></h1>
                        </div>
                        <button type="button" class="export__file-btn" title="Export File" onclick="toggleExport()" style="margin-left:10px;">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>

                        </button>
                    </div>


                </section>





                <section class="table__body" id="headerTable">
                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="firsttime">
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> Tracking Number <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center" title="Filter: Ascending/Descending"> Status <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Remarks <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Firstname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Lastname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Birthdate <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Age <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Gender <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Contact Number <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Civil Status <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Address <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Recidency <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Education <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Course <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> JobStart Program <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> ID Number <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> ID Img </th>
                                    <th title="Filter: Ascending/Descending"> Purpose <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Pickup Date/Time <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Datetime Submitted <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                include '../Php/db.php';

                                $sql = "SELECT purpose_description, type, id, firstname, lastname, birthdate, age, gender, contact_number, `civil_status`, address, residency, education, course, `job_start_beneficiary`, pickup_datetime, `datetime_created`, `id_number`, avatar, tracking_number, `file_status`, remarks FROM first_time_job ORDER BY file_status ASC, datetime_created DESC";
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
                                            "<td><strong>" . $row["tracking_number"] . "</strong></td>" .
                                            "<td style='text-align: center;'>
                            <p class='status $class padding'>" . $row["file_status"] . "</p>
                        </td>" .
                                            "<td>" . $row["remarks"] . "</td>" .
                                            "<td>" . $row["firstname"] . "</td>" .
                                            "<td>" . $row["lastname"] . "</td>" .
                                            "<td>" . date("F j, Y", strtotime($row["birthdate"])) . "</td>" .
                                            "<td>" . $row["age"] . "</td>" .
                                            "<td>" . $row["gender"] . "</td>" .
                                            "<td>" . $row["contact_number"] . "</td>" .
                                            "<td>" . $row["civil_status"] . "</td>" .
                                            "<td>" . $row["address"] . "</td>" .
                                            "<td>" . $row["residency"] . "</td>" .
                                            "<td>" . $row["education"] . "</td>" .
                                            "<td>" . $row["course"] . "</td>" .
                                            "<td>" . $row["job_start_beneficiary"] . "</td>" .
                                            "<td>" . $row["id_number"] . "</td>" .
                                            "<td>" . (!empty($row["voters_id_image"]) ? "<a href='../ResidentsID/" . $row["voters_id_image"] . "' target='_blank'>View Valid ID</a>" : "None") . "</td>" .
                                            "<td>" . $row["purpose_description"] . "</td>" .
                                            "<td title='" . date("l", strtotime($row["pickup_datetime"])) . "'>" . date("F j, Y, g:i a", strtotime($row["pickup_datetime"])) . "</td>" .
                                            "<td title='" . date("l", strtotime($row["datetime_created"])) . "'>" . date("F j, Y, g:i a", strtotime($row["datetime_created"])) . "</td>" .
                                            "<td><button class='viewMore' data-file-id='" . $row["id"] . "'>Edit</button></td>" .
                                            "</tr>";
                                    }
                                    $result->close();
                                } else {
                                    echo "<tr><td colspan='8'>No data found</td></tr>";
                                }

                                $conn->close();
                                ?>



                                <div id="customEditModal1" class="custom-modal">
                                    <div class="custom-modal-content">
                                        <h2 class="editAccountTitle">Update File Request Status </h2>
                                        <p id="TrackingN"></p>
                                        <form id="customEditForm1" method="post">
                                            <div class="updatecon">
                                                <div class="accountstatus">
                                                    <input type="hidden" id="fileStatusId" name="fileStatusId" value="">
                                                    <label for="fileStatus">File Status:</label>
                                                    <select id="fileStatus" name="fileStatus">

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
                    </div>
                </section>
            </main>


        </div>
</body>


<script>
    new DataTable("#firsttime", {
        paging: false,
        searching: true,
        info: false,
        order: false,
        layout: {
            topStart: {
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:nth-child(17)):not(:nth-child(21))'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:nth-child(17)):not(:nth-child(21))'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:nth-child(17)):not(:nth-child(21))'
                        },
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:nth-child(17)):not(:nth-child(21))'
                        },
                        autoPrint: true
                    }
                ],
            },
        },
        // Use a custom search input
        initComplete: function() {
            let input = document.querySelector(".input-group input");
            this.api().columns().every(function() {
                let that = this;
                $(input).on('keyup change clear', function() {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        },
    });
</script>

</html>