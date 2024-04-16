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

<!--VALIDATION MESSAGE-->
<div id="validationPopup3" class="popup2">
    <p>You cannot select a month in the future.</p>
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
                    REPORTING VIEW
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

                            <button type="button" id="loginButton" class="filterB" style="margin-left:5px;">
                                <p class="filterT">Logged in</p>
                            </button>


                            <button type="button" id="staffButton" class="filterB" style="margin-left:5px;">
                                <p class="filterT">Staff Info</p>
                            </button>

                            <button type="button" id="residentButton" class="filterB" style="margin-left:5px;">
                                <p class="filterT">Resident Record</p>
                            </button>

                            <button type="button" id="reviewingButton" class=" filterB" style="margin-left:5px;">
                                <p class="filterT">Indigency</p>
                            </button>

                            <button type="button" id="declinedButton" class="filterB" style="margin-left:5px;">
                                <p class="filterT">Recidency</p>
                            </button>

                            <button type="button" id="processingButton" class="filterB" style="margin-left:5px; margin-right:5px;">
                                <p class="filterT">First Time Job Seeker</p>
                            </button>

                            <button type="button" class="filterB" style="margin-right:5px;" onclick="toggleDatePicker()">
                                <i class='bx bxs-calendar'></i>
                            </button>
                        </div>


                        <button type=" button" class="filterB" style="margin-right:5px; z-index:50;" onclick="toggleTableFilter()">
                            <i class='bx bxs-filter-alt'></i>
                            <p class="filterT1">Filter</p>
                        </button>


                        <button type="button" class="export__file-btn" title="Export File" onclick="toggleExport()" style="margin-left:10px;">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>
                        </button>

                    </div>

                </section>





                <section class="table__body">
                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="reporting">
                            <thead>
                                <tr>

                                    <th title="Filter: Ascending/Descending"> ID Number <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Firstname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Lastname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Role <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Action Type <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Type <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Reference <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Resident Firstname <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Resident Lastname <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Datetime <i class='bx bx-sort'></i></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                include '../Php/db.php';

                                // Fetch data from UserActivity table
                                $query = $conn->prepare("SELECT * FROM UserActivity ORDER BY ActionDate DESC");
                                $query->execute();
                                $result = $query->get_result();
                                ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><strong><?php echo $row['StaffID']; ?></strong></td>
                                        <td><?php echo $row['FirstName']; ?></td>
                                        <td><?php echo $row['LastName']; ?></td>
                                        <td><?php echo ucfirst($row['Role']); ?></td>
                                        <td><?php echo $row['Action']; ?></td>
                                        <td><?php echo $row['type'] ? $row['type'] : 'None'; ?></td>
                                        <td><?php echo $row['request_tracking_number'] ? $row['request_tracking_number'] : 'None'; ?>
                                        </td>
                                        <td><?php echo $row['ResidentFirstName'] ? $row['ResidentFirstName'] : 'None'; ?>
                                        </td>
                                        <td><?php echo $row['ResidentLastName'] ? $row['ResidentLastName'] : 'None'; ?>
                                        </td>
                                        <td title="<?= date("l", strtotime($row["ActionDate"])) ?>">
                                            <?= date("F j, Y, g:i a", strtotime($row["ActionDate"])) ?></td>
                                    </tr>
                                <?php endwhile; ?>

                                <?php
                                $conn->close();
                                ?>

                            </tbody>
                        </table>
                    </div>
                </section>


            </main>


        </div>
</body>


<script>
    var table = new DataTable("#reporting", {
        paging: false,
        searching: true,
        info: false,
        order: false,
        layout: {
            topStart: {
                buttons: [{
                        extend: 'excel',
                        filename: function() {
                            var d = new Date();
                            var dateStr = d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2,
                                    '0') + '-' + d.getDate().toString().padStart(2, '0') +
                                '_' + d.getHours().toString().padStart(2, '0') + '-' + d.getMinutes()
                                .toString().padStart(2, '0') + '-' + d.getSeconds().toString().padStart(2,
                                    '0');
                            return 'LogsTable_' + dateStr;
                        }
                    },
                    {
                        extend: 'csv',
                        filename: function() {
                            var d = new Date();
                            var dateStr = d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2,
                                    '0') + '-' + d.getDate().toString().padStart(2, '0') +
                                '_' + d.getHours().toString().padStart(2, '0') + '-' + d.getMinutes()
                                .toString().padStart(2, '0') + '-' + d.getSeconds().toString().padStart(2,
                                    '0');
                            return 'LogsTable_' + dateStr;
                        }
                    },
                    {
                        extend: 'pdf',
                        filename: function() {
                            var d = new Date();
                            var dateStr = d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2,
                                    '0') + '-' + d.getDate().toString().padStart(2, '0') +
                                '_' + d.getHours().toString().padStart(2, '0') + '-' + d.getMinutes()
                                .toString().padStart(2, '0') + '-' + d.getSeconds().toString().padStart(2,
                                    '0');
                            return 'LogsTable_' + dateStr;
                        },
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        filename: function() {
                            var d = new Date();
                            var dateStr = d.getFullYear() + '-' + (d.getMonth() + 1).toString().padStart(2,
                                    '0') + '-' + d.getDate().toString().padStart(2, '0') +
                                '_' + d.getHours().toString().padStart(2, '0') + '-' + d.getMinutes()
                                .toString().padStart(2, '0') + '-' + d.getSeconds().toString().padStart(2,
                                    '0');
                            return 'LogsTable_' + dateStr;
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

    $('#loginButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Logged in');
            applyFilter('Logged in');
        }
    });



    $('#staffButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Staff Database');
            applyFilter('Staff Database');
        }
    });


    $('#residentButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Resident Record');
            applyFilter('Resident Record');
        }
    });

    $('#reviewingButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Certificate of Indigency');
            applyFilter('Certificate of Indigency');
        }
    });

    $('#declinedButton').on('click', function() {
        if ($(this).hasClass('active')) {
            localStorage.removeItem('filter');
            applyFilter(null);
        } else {
            localStorage.setItem('filter', 'Certificate of Residency');
            applyFilter('Certificate of Residency');
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