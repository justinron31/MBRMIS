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
    <link rel="stylesheet" href="./CSS,JS/Dashboard.css" />
    <link rel="stylesheet" href="./CSS,JS/Table.css" />
    <link rel="stylesheet" href="./CSS,JS/staff.css" />


    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
    <script src="./CSS,JS/staff.js" defer></script>
    <script src="./CSS,JS/Export.js" defer></script>



    <title>MAKILING BRMI SYSTEM - Staff Database</title>
</head>


<!--LOGIN PHP -->
<?php
session_start();

// Check if the user is not logged in as admin or staff, or if idnumber is not set
if (!isset($_SESSION['user_name']) || ($_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'staff') || !isset($_SESSION['idnumber']) || !isset($_SESSION['lastname'])) {
    // Redirect to login page
    header("Location: ../Login/loginStaff.php");
    exit();
}

$userName = $_SESSION['user_name'];
$idNumber = $_SESSION['idnumber'];
$lastName = $_SESSION['lastname'];

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



    <!-- MESSAGE-->
    <div id="loginPopup" class="popup">
        <p>User Added Successfully!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup" class="popup2">
        <p>Error Deleting User!</p>
    </div>

    <!-- MESSAGE-->
    <div id="loginPopup1" class="popup">
        <p>User Updated Successfully!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup1" class="popup2">
        <p>Error Updating User!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup2" class="popup2">
        <p>User already exist in the database. </p>
    </div>


    <?php
    if (isset($_SESSION['success_delete'])) {
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("loginPopup").style.display = "block";
        setTimeout(function() {
            document.getElementById("loginPopup").style.display = "none";
        }, 3000);
    });
    </script>';
        unset($_SESSION['success_delete']);
    }

    if (isset($_SESSION['error_delete'])) {
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("validationPopup").style.display = "block";
        setTimeout(function() {
            document.getElementById("validationPopup").style.display = "none";
        }, 3000);
    });
    </script>';
        unset($_SESSION['error_delete']);
    }
    if (isset($_SESSION['success_update'])) {
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("loginPopup1").style.display = "block";
        setTimeout(function() {
            document.getElementById("loginPopup1").style.display = "none";
        }, 3000);
    });
    </script>';
        unset($_SESSION['success_update']);
    }
    if (isset($_SESSION['error_update'])) {
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("validationPopup1").style.display = "block";
        setTimeout(function() {
            document.getElementById("validationPopup1").style.display = "none";
        }, 3000);
    });
    </script>';
        unset($_SESSION['error_update']);
    }

    if (isset($_SESSION['exists'])) {
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("validationPopup2").style.display = "block";
        setTimeout(function() {
            document.getElementById("validationPopup2").style.display = "none";
        }, 3000);
    });
    </script>';
        unset($_SESSION['exists']);
    }
    ?>



    <!-- MAIN CONTENT-->
    <div class="headermain">

        <div class="headerTop">
            <div class="header">

                <h1 class="maintitle">
                    STAFF DATABASE
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
            <main class="table" id="stafftable">

                <section class="table__header">


                    <div class="export__file">

                        <div class="tableHead">
                            <!--TOTAL USER-->

                            <?php
                            include '../Php/db.php';

                            $sql = "SELECT * FROM staff_information";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result) {
                                $totalUsers = $result->num_rows;
                                echo "<h1 class='titleTable'>Total Staff: " . $totalUsers . "</h1>";
                            } else {
                                echo "Error: " . $conn->error;
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                        </div>

                        <button type="button" class="export__file-btn2" style="margin-left:10px;" onclick="displayElements()">
                            <i class='bx bxs-plus-circle'></i>
                            <p class="exportTitle1">Add Staff </p>
                        </button>

                        <button type="button" class="export__file-btn" title="Export File" style="margin-left:10px;" onclick="toggleExport()">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>
                        </button>

                    </div>

                </section>


                <section class="table__body">
                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="managestaff">
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> ID Number <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Firstname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Lastname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Datetime Added <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> Datetime Updated <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                include '../Php/db.php';

                                $sql = "SELECT id, first_name, last_name, idnumber, dateCreated, date_updated FROM staff_information ORDER BY dateCreated DESC";
                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $dateCreated = date('F j, Y, g:i a', strtotime($row["dateCreated"]));
                                        $dateUpdated = isset($row["date_updated"]) ? date('F j, Y, g:i a', strtotime($row["date_updated"])) : '';
                                        echo "<tr>" .
                                            "<td><strong>" . $row["idnumber"] . "</strong></td>" .
                                            "<td>" . $row["first_name"] . "</td>" .
                                            "<td>" . $row["last_name"] . "</td>" .
                                            "<td>" . $dateCreated . "</td>" .
                                            "<td>" .  $dateUpdated  . "</td>" .
                                            "<td class=\"center\"><button class='viewMore' onclick='populateForm11(\"{$row["idnumber"]}\")'>Edit</button> <button class='viewMore1' onclick='showDeleteModal1(\"{$row["idnumber"]}\")'>Delete</button></td>" .
                                            "</tr>";
                                    }
                                    $result->close();
                                } else {
                                    echo "<tr ><td colspan='6' >No data found</td></tr>";
                                }

                                $conn->close();
                                ?>


                            </tbody>
                        </table>
                    </div>
                </section>
            </main>

        </div>


        <!-- Staff EDit-->
        <?php include '../Components/staffEdit.php'; ?>


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
                    <p>Are you sure you want to delete this Record?</p>
                    <p>This action cannot be <Strong>UNDONE</Strong>.</p>
                </div>
                <div class="modal-buttons1">
                    <button class="yes1">Yes</button>
                    <button class="no1">No</button>
                </div>
            </div>

        </div>


        <!-- Staff add-->
        <?php include '../Components/staffAdd.php'; ?>



        <script>
            // ─── Delete MODAL ──────────────────────────────────────────────
            var intervalId;

            function showDeleteModal1(id) {
                document.querySelector(".overlayD").style.display = "block";
                document.querySelector(".modalD").style.display = "block";

                var yesButton = document.querySelector(".yes1");
                yesButton.disabled = true;

                var counter = 5;
                yesButton.innerText = `Yes (${counter})`;
                var intervalId = startTimer(yesButton, counter);

                yesButton.addEventListener("click", function() {
                    deleteUserStaff(id);
                    clearInterval(intervalId);
                });

                document.querySelector(".no1").addEventListener("click", function() {
                    document.querySelector(".overlayD").style.display = "none";
                    document.querySelector(".modalD").style.display = "none";
                    clearInterval(intervalId);
                    yesButton.innerText = "Yes";
                    yesButton.disabled = true;
                });
            }

            function startTimer(yesButton, counter) {
                return setInterval(function() {
                    counter--;
                    if (counter >= 0) {
                        yesButton.innerText = `Yes (${counter})`;
                    } else {
                        yesButton.disabled = false;
                        yesButton.innerText = "Yes";
                        clearInterval(intervalId);
                    }
                }, 1000);
            }

            // ─── Delete Function ──────────────────────────────────────────
            function deleteUserStaff(id) {
                console.log("Deleting user with id: ", id);
                $.ajax({
                    type: "POST",
                    url: "../Php/deleteUserStaff.php",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(data) {
                        // Check the status in the response
                        if (data.status === "success") {
                            // Set session storage value
                            sessionStorage.setItem("showCustomPopup", data.message);
                            // Refresh the page
                            location.reload();
                        } else {
                            // Show a custom error popup
                            showCustomPopup(data.message);
                        }
                    },
                    error: function(error) {
                        console.log("Error deleting user: ", error);

                        // Show a custom error popup
                        showCustomPopup("Error deleting user");
                    },
                });
            }

            // Function to show a custom popup
            function showCustomPopup(message) {
                var popupContainer = $('<div class="custom-popup"></div>').text(message);
                $("body").append(popupContainer);

                popupContainer
                    .css("display", "none")
                    .fadeIn(200, function() {
                        $(this).animate({
                                top: "-20px",
                                opacity: 0,
                            },
                            300,
                            function() {
                                $(this).remove();
                            }
                        );
                    })
                    .delay(2000);
            }
        </script>





</body>

<script>
    new DataTable("#managestaff", {
        autoWidth: true,
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
                            return 'ManageStaffTable_' + dateStr;
                        },
                        exportOptions: {
                            columns: ':not(:nth-child(6))'
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
                            return 'ManageStaffTable_' + dateStr;
                        },
                        exportOptions: {
                            columns: ':not(:nth-child(6))'
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
                            return 'ManageStaffTable_' + dateStr;
                        },
                        exportOptions: {
                            columns: ':not(:nth-child(6))'
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
                            return 'ManageStaffTable_' + dateStr;
                        },
                        exportOptions: {
                            columns: ':not(:nth-child(6))'
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