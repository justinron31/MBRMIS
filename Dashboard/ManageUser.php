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
    <link rel="stylesheet" href="./CSS,JS/Dashboard.css" />
    <link rel="stylesheet" href="./CSS,JS/Table.css" />


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

    <script src="./CSS,JS/Table.js" defer></script>
    <script src="./CSS,JS/Dashboard.js" defer></script>
    <script src="./CSS,JS/Export.js" defer></script>




    <title>MAKILING BRMI SYSTEM - Manage Users</title>
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


                    <div class="export__file">

                        <div class="tableHead">
                            <!--TOTAL USER-->

                            <?php
                            include '../Php/db.php';

                            $idnum = $_SESSION['idnumber'];

                            $sql = "SELECT * FROM staff WHERE idnumber != ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $idnum);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result) {
                                $totalUsers = $result->num_rows;
                                echo "<h1 class='titleTable'>Total User: " . $totalUsers . "</h1>";
                            } else {
                                echo "Error: " . $conn->error;
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                        </div>


                        <button type="button" class="export__file-btn" onclick="toggleExport()" title="Export File"
                            style="margin-left:10px;">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>
                        </button>

                    </div>

                </section>





                <section class="table__body">
                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="manageUser">
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> ID Number <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Firstname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Lastname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Gender <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Age <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Email <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Role <i class='bx bx-sort'></i></th>
                                    <th class="center"> Account Status <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Last Login <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Date Created <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                include '../Php/db.php';


                                $idnum = $_SESSION['idnumber'];

                                $sql = "SELECT firstname, lastname, idnumber, email, gender,staff_role,age, account_status, last_login_timestamp,dateCreated FROM staff WHERE idnumber != '$idnum' ORDER BY dateCreated DESC";
                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $class = (strtolower(trim($row["account_status"])) == 'activated') ? 'delivered' : 'cancelled';
                                        $uniqueId = 'edit_' . $row["idnumber"];
                                        $last_login_timestamp = date('F j, Y, g:i a', strtotime($row["last_login_timestamp"]));
                                        $dateCreated = date('F j, Y, g:i a', strtotime($row["dateCreated"]));
                                        echo "<tr>" .
                                            "<td><strong>" . $row["idnumber"] . "</strong></td>" .
                                            "<td>" . $row["firstname"] . "</td>" .
                                            "<td>" . $row["lastname"] . "</td>" .
                                            "<td>" . $row["gender"] . "</td>" .
                                            "<td>" . $row["age"] . "</td>" .
                                            "<td>" . $row["email"] . "</td>" .
                                            "<td><strong>" . $row["staff_role"] . "</strong></td>" .
                                            "<td ><p class='status $class'>" . $row["account_status"] . "</p></td>" .
                                            "<td>" . date('F j, Y, g:i a', strtotime($row["last_login_timestamp"])) . "</td>" .
                                            "<td>" . date('F j, Y, g:i a', strtotime($row["dateCreated"])) . "</td>" .
                                            "<td class><button class='viewMore' onclick='openCustomModal(\"{$row["idnumber"]}\", \"{$row["account_status"]}\", \"{$row["staff_role"]}\")'>Edit</button> <button class='viewMore1' onclick='showDeleteModal(\"{$row["idnumber"]}\")'>Delete</button></td>" .
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
                                        <p id="dateCreated"></p>
                                        <form id="customEditForm" action="../Php/updateAstatus.php" method="post">

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


                                        </form>
                                    </div>
                                </div>



                            </tbody>
                        </table>
                    </div>

                </section>
            </main>



        </div>

        <!-- delete popup -->
        <div class=" overlayD">
        </div>
        <div class="modalD">
            <div class="modal-header1">
                <h2>IMPORTANT</h2>
            </div>

            <div class="modal-body1">
                <div class="modal-message1">
                    <i class='bx bxs-error-circle'></i>
                    <p>Are you sure you want to delete this User?</p>
                    <p>This action cannot be <Strong>UNDONE</Strong>.</p>
                </div>
                <div class="modal-buttons1">
                    <button class="yes1">Yes</button>
                    <button class="no1">No</button>
                </div>
            </div>

        </div>



</body>


<script>
new DataTable("#manageUser", {
    paging: false,
    searching: true,
    info: false,
    order: false,
    layout: {
        topStart: {
            buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:nth-child(11))'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:nth-child(11))'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(:nth-child(11))'
                    },
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:nth-child(11))'
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