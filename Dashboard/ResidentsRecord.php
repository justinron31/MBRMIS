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
    <link rel="stylesheet" href="./CSS,JS/residentsRecord.css" />



    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.1/exceljs.min.js"></script>
    <script src="node_modules/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/xlsx@0.16.8/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>

    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/residentsRecord.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>
    <script src="../Dashboard/CSS,JS/Export.js"></script>





    <title>MAKILING BRMI SYSTEM - Resident's Record</title>
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


    <!--VALIDATION MESSAGE-->
    <div id="validationPopup" class="popup">
        <p>New record created successfully!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup5" class="popup">
        <p>Record deleted successfully!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup6" class="popup">
        <p>Record updated successfully!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup7" class="popup2">
        <p>Error updating residents record.</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup1" class="popup2">
        <p>Invalid Image Extension!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup2" class="popup2">
        <p>Image Size Is Too Large!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup3" class="popup2">
        <p>Error Creating a new resident record!</p>
    </div>

    <!--VALIDATION MESSAGE-->
    <div id="validationPopup4" class="popup2">
        <p>Error deleting resident record!</p>
    </div>



    <?php
    if (isset($_SESSION['invalid_image'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup1").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup1").style.display = "none";
                }, 3000);
            });
          </script>';
        unset($_SESSION['invalid_image']);
    } elseif (isset($_SESSION['invalid_size'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup2").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup2").style.display = "none";
                }, 3000);
            });
          </script>';
        unset($_SESSION['invalid_size']);
    } elseif (isset($_SESSION['invalid_insert'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup3").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup3").style.display = "none";
                }, 3000);
            });
          </script>';
        unset($_SESSION['invalid_insert']);
    } elseif (isset($_SESSION['success_insert'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup").style.display = "none";
                }, 3000);
            });
          </script>';
        unset($_SESSION['success_insert']);
    } elseif (isset($_SESSION['success_delete'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup5").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup5").style.display = "none";
                }, 3000);
            });
          </script>';
        unset($_SESSION['success_delete']);
    } elseif (isset($_SESSION['failure_delete'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("validationPopup4").style.display = "block";
                setTimeout(function() {
                    document.getElementById("validationPopup4").style.display = "none";
                }, 3000);
            });
          </script>';
        unset($_SESSION['failure_delete']);
    }
    ?>




    <!-- MAIN CONTENT-->
    <div class="headermain">

        <div class="headerTop">
            <div class="header">

                <h1 class="maintitle">
                    RESIDENT'S RECORD
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
                            <h1 class="titleTable">Total Residents: <span id="totalReq3">0</span></h1>
                        </div>
                        <button type="button" id="addResident" class="export__file-btn" style="margin-left:10px;"
                            onclick="toggleResidentForm()">
                            <i class='bx bxs-plus-circle'></i>
                            <p class="exportTitle">Add Resident</p>
                        </button>

                        <button type="button" class="export__file-btn" title="Export File"
                            onclick="fnResidentReport('residentsRec')" style="margin-left:10px;">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>
                        </button>
                    </div>

                </section>





                <section class="table__body">

                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="residentsRec">
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> Voters ID <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Voter status <i class='bx bx-sort'></i>
                                    </th>
                                    <!--<th title="Filter: Ascending/Descending"> Voters ID Img </th>-->
                                    <th title="Filter: Ascending/Descending"> BHS <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Firstname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Lastname <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Middlename <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Gender <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Age <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Purok/Sitio/Subdivision <i
                                            class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Household Number <i
                                            class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> NHTS Household <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> IP or Non-IP <i class='bx bx-sort'></i>
                                    </th>
                                    <th title="Filter: Ascending/Descending"> HH Head PhilHealth Member <i
                                            class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Category <i class='bx bx-sort'></i></th>
                                    <th title="Filter: Ascending/Descending"> Date Inserted <i class='bx bx-sort'></i>
                                    </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                include '../Php/db.php';

                                $sql = "SELECT * FROM residentrecord ORDER BY datecreated DESC";
                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $file_status = strtolower(trim($row["rvoterstatus"]));
                                        if ($file_status == 'voter') {
                                            $class = 'delivered';
                                        } elseif ($file_status == 'non-voter' || $file_status == 'none' || $file_status == 'n/a') {
                                            $class = 'cancelled';
                                        } else {
                                            $class = '';
                                        }


                                        echo "<tr>" .
                                            "<td><strong>" . (!empty($row["rVotersID"]) ? $row["rVotersID"] : "None") . "</strong></td>" .
                                            "<td style='text-align: center;'><p class='status $class padding'>" . $row["rvoterstatus"] . "</p></td>" .
                                            // "<td>" . (!empty($row["voters_id_image"]) ? "<a href='../ResidentsID/" . $row["voters_id_image"] . "' target='_blank'>View Voters ID</a>" : "None") . "</td>" .
                                            "<td>" . $row["rBHS"] . "</td>" .
                                            "<td>" . $row["rFirstName"] . "</td>" .
                                            "<td>" . $row["rLastName"] . "</td>" .
                                            "<td>" . $row["rMothersMaidenName"] . "</td>" .
                                            "<td>" . $row["rGender"] . "</td>" .
                                            "<td>" . $row["rAge"] . "</td>" .
                                            "<td>" . $row["rPurokSitioSubdivision"] . "</td>" .
                                            "<td>" . $row["rHouseholdNumber"] . "</td>" .
                                            "<td>" . $row["rNHTSHousehold"] . "</td>" .
                                            "<td>" . $row["rIP"] . "</td>" .
                                            "<td>" . $row["rHHHeadPhilHealthMember"] . "</td>" .
                                            "<td>" . $row["rCategory"] . "</td>" .
                                            "<td title='" . date("l", strtotime($row["datecreated"])) . "'>" . date("F j, Y, g:i a", strtotime($row["datecreated"])) . "</td>" .
                                            "<td><button class='viewMore' onclick=\"toggleResidentForm1('" . $row["id"] . "')\">View</button></td>" .
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

            <!-- add Resident -->

            <?php include '../Components/residentAdd.php'; ?>
            <?php include '../Components/residentEdit.php'; ?>

        </div>


    </div>
</body>


<script>
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var update = urlParams.get('update');

    var popupId;
    if (update === 'success') {
        popupId = 'validationPopup6';
    } else if (update === 'error') {
        popupId = 'validationPopup7';
    }

    if (popupId) {
        var popup = document.getElementById(popupId);
        popup.style.display = 'block';

        setTimeout(function() {
            popup.style.display = 'none';
        }, 3000);
    }
});
</script>

</html>