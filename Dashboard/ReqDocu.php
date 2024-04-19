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
    <link rel="stylesheet" href="../Dashboard/CSS,JS/staff.css" />


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
    <script src="../Dashboard/CSS,JS/generateCert.js"></script>


    <title>MAKILING BRMI SYSTEM - Request Documents</title>
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

// Add idnumber to the session
$idNumber = $_SESSION['idnumber'];

// Check if the login message should be displayed
$showLoginMessage = isset($_SESSION['show_login_message']) && $_SESSION['show_login_message'] === true;

// Reset the session variable to avoid displaying the message on page refresh
$_SESSION['show_login_message'] = false;
?>


<!--VALIDATION MESSAGE-->
<div id="validationPopup3" class="popup2">
    <p>You cannot select a month in the future.</p>
</div>

<!--VALIDATION MESSAGE-->
<div id="validationPopup1" class="popup">
    <p>Certificate Updated Successfully.</p>
</div>

<!--VALIDATION MESSAGE-->
<div id=" validationPopup5" class="popup2">
    <p>Error Updating Certificate!</p>
</div>




<?php
if (isset($_SESSION['success_update'])) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("validationPopup1").style.display = "block";
        setTimeout(function() {
            document.getElementById("validationPopup1").style.display = "none";
        }, 3000);
    });
    </script>';
    unset($_SESSION['success_update']);
}

if (isset($_SESSION['error_update'])) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("validationPopup5").style.display = "block";
        setTimeout(function() {
            document.getElementById("validationPopup5").style.display = "none";
        }, 3000);
    });
    </script>';
    unset($_SESSION['error_update']);
}
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


                    <div class="export__file">

                        <div class="datepickerE">

                            <div class="datepick">
                                <i class='bx bxs-x-circle'></i>
                                <label for="date">Pick a month</label>
                                <input type="month" id="date" name="date" value="<?php echo date('Y-m'); ?>">
                            </div>
                            </br>

                            <button type="button" class=" filterB" style="margin-left:5px;">
                                <p class="filterT">Filter</p>
                            </button>

                            <button type="button" class=" filterR" style="margin-left:5px;">
                                <p class="filterT">Reset</p>
                            </button>
                        </div>

                        <div class="tablefilter">

                            <button type="button" id="reviewingButton" class=" filterB" style="margin-left:5px;">
                                <p class="filterT">Indigency</p>
                            </button>

                            <button type="button" id="declinedButton" class="filterB" style="margin-left:5px;">
                                <p class="filterT">Residency</p>
                            </button>

                            <button type="button" id="processingButton" class="filterB" style="margin-left:5px; margin-right:5px;">
                                <p class="filterT">Job Seeker</p>
                            </button>

                            <button type="button" class="filterB" style="margin-right:5px;" onclick="toggleDatePicker()">
                                <i class='bx bxs-calendar'></i>
                            </button>
                        </div>


                        <button type=" button" class="filterB" style="margin-right:10px; z-index:50;" onclick="toggleTableFilter()">
                            <i class='bx bxs-filter-alt'></i>
                            <p class="filterT1">Filter</p>
                        </button>



                        <div class="tableHead">
                            <!--TOTAL USER-->
                            <?php
                            include '../Php/db.php';

                            $result1 = mysqli_query($conn, "SELECT COUNT(*) AS count FROM file_request WHERE file_status = 'Reviewing'");

                            $result2 = mysqli_query($conn, "SELECT COUNT(*) AS count FROM first_time_job WHERE file_status = 'Reviewing'");

                            $row1 = mysqli_fetch_assoc($result1);
                            $row2 = mysqli_fetch_assoc($result2);

                            $total = $row1['count'] + $row2['count'];
                            ?>

                            <h1 class="titleTable">Total File: <span><?php echo $total; ?></span></h1>
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
                        <table id="reqdocu">
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> Document Type <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center" title="Filter: Ascending/Descending"> Status <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Firstname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Lastname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Tracking Number <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Contact Number <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Residency length <i class='bx bx-sort'></i>
                                    </th>

                                    <th title="Filter: Ascending/Descending"> Purpose <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Pickup Date <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Date Submitted <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include '../Php/db.php';


                                $sql = "SELECT id, type, file_status, firstname, lastname, tracking_number, contact_number,  pickup_datetime, purpose_description,  datetime_created, purok, NULL AS residency, file_data_updated
                                    FROM file_request WHERE file_status = 'Reviewing' OR file_status = 'Ready for Pickup'
                                    UNION ALL
                                    SELECT id, type, file_status, firstname, lastname, tracking_number, contact_number,  pickup_datetime, purpose_description,  datetime_created, address, residency, file_data_updated
                                    FROM first_time_job WHERE file_status = 'Reviewing' OR file_status = 'Ready for Pickup'
                                    ORDER BY file_data_updated DESC";


                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $file_status = strtolower(trim($row["file_status"]));
                                        if ($file_status == 'ready for pickup') {
                                            $class = 'delivered';
                                            $printButton = "<td ><button class='viewMore3'>DONE</button></td>";
                                        } elseif ($file_status == 'declined') {
                                            $class = 'cancelled';
                                            $printButton = "<td style='display: flex; align-items: center; justify-content: center;'><i class='bx bxs-edit' onclick='toggleCertEdit(" . $row['id'] . ")' ></i><button class='viewMore' onclick=\"if(confirm('Print the selected file request?')) { generateCertificate('" . $row["firstname"] . ' ' . $row["lastname"] . "', '" . $row["pickup_datetime"] . "', '" . $row["type"] . "', '" . $row["purpose_description"] . "', '" . $row["purok"] . "', '" . $row["residency"] . "', '" . $row["tracking_number"] . "', " . $row["id"] . ") }\" data-file-id='" . $row["id"] . "'>Print</button></td>";
                                        } elseif ($file_status == 'reviewing') {
                                            $class = 'pending';
                                            $printButton =
                                                $printButton = "<td style='display: flex; align-items: center; justify-content: center;'><i class='bx bxs-edit' onclick='toggleCertEdit(" . $row['id'] . ")' ></i><button class='viewMore' onclick=\"if(confirm('Print the selected file request?')) { generateCertificate('" . $row["firstname"] . ' ' . $row["lastname"] . "', '" . $row["pickup_datetime"] . "', '" . $row["type"] . "', '" . $row["purpose_description"] . "', '" . $row["purok"] . "', '" . $row["residency"] . "', '" . $row["tracking_number"] . "', " . $row["id"] . ") }\" data-file-id='" . $row["id"] . "'>Print</button></td>";
                                        } elseif ($file_status == 'processing') {
                                            $class = 'processing';
                                            $printButton =
                                                $printButton = "<td style='display: flex; align-items: center; justify-content: center;'><i class='bx bxs-edit' onclick='toggleCertEdit(" . $row['id'] . ")' ></i><button class='viewMore' onclick=\"if(confirm('Print the selected file request?')) { generateCertificate('" . $row["firstname"] . ' ' . $row["lastname"] . "', '" . $row["pickup_datetime"] . "', '" . $row["type"] . "', '" . $row["purpose_description"] . "', '" . $row["purok"] . "', '" . $row["residency"] . "', '" . $row["tracking_number"] . "', " . $row["id"] . ") }\" data-file-id='" . $row["id"] . "'>Print</button></td>";
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
                                            "<td>" . ($row["residency"] ? $row["residency"] : "None") . "</td>" .
                                            "<td>" . $row["purpose_description"] . "</td>" .
                                            "<td title='" . date("l", strtotime($row["pickup_datetime"])) . "'>" . date("F j, Y, g:i a", strtotime($row["pickup_datetime"])) . "</td>" .
                                            "<td title='" . date("l", strtotime($row["datetime_created"])) . "'>" . date("F j, Y, g:i a", strtotime($row["datetime_created"])) . "</td>" .
                                            $printButton .
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
<?php include '../Components/editCert.php'; ?>
<script>
    var table = new DataTable("#reqdocu", {
        paging: false,
        searching: true,
        info: false,
        order: false,
        layout: {
            topStart: {
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:nth-child(10))'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:nth-child(10))'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:nth-child(10))'
                        },
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:nth-child(10))'
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

    function applyFilter(filter) {
        if (filter) {
            table.search(filter).draw();
            $('input[type="search"]').val(''); // Clear the search input
        } else {
            table.search('').draw();
        }
    }

    $('#reviewingButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Indigency');
            applyFilter('Indigency');
        }
    });

    $('#declinedButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Residency');
            applyFilter('Residency');
        }
    });

    $('#processingButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'First Time Job Seeker');
            applyFilter('First Time Job Seeker');
        }
    });


    document.querySelector(".filterR").addEventListener("click", function() {
        var dateInput = document.querySelector("#date");
        dateInput.value = '';
        applyFilter('');
    });

    // Apply the filter from localStorage when the page loads
    applyFilter(localStorage.getItem('filter'));

    document.querySelector(".filterB").addEventListener("click", function() {
        var dateInput = document.querySelector("#date");
        var date = new Date(dateInput.value);
        var formattedDate = date.toLocaleString('en-US', {
            month: 'long',
            year: 'numeric'
        });
        applyFilter(formattedDate);
    });
</script>


</html>