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
    <link rel="stylesheet" href="../Dashboard/CSS,JS/residentsRecord.css" />



    <!--JAVASCRIPT-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.1/exceljs.min.js"></script>
    <script src="node_modules/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/xlsx@0.16.8/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>


    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>
    <script src="../Dashboard/CSS,JS/Export.js" defer></script>
    <script src="../Dashboard/CSS,JS/residentsRecord.js" defer></script>



    <title>MAKILING BRMI SYSTEM - Resident's Record</title>
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


    <!--VALIDATION MESSAGE-->
    <div id="validationPopup" class="popup">
        <p>New record created successfully!</p>
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
                            <!--TOTAL USER-->
                            <?php
                            include '../Php/db.php';

                            $idnum = $_SESSION['idnumber'];
                            $sql = "SELECT * FROM residentrecord WHERE id != $idnum";
                            $result = $conn->query($sql);

                            if ($result) {
                                $totalUsers = $result->num_rows;
                            }
                            echo "<h1 class='titleTable'>Total Residents: " . $totalUsers . "</h1>";
                            ?>
                        </div>
                        <button type="button" id="addResident" class="export__file-btn" style="margin-left:10px;" onclick="toggleResidentForm()">
                            <i class='bx bxs-plus-circle'></i>
                            <p class="exportTitle">Add Resident</p>
                        </button>

                        <button type="button" class="export__file-btn" title="Export File" onclick="fnManageReport()" style="margin-left:10px;">
                            <i class='bx bxs-file-export'></i>
                            <p class="exportTitle">Export</p>
                        </button>
                    </div>

                </section>





                <section class="table__body">

                    <!--TABLE CONTENT-->
                    <div class="tableWrap">
                        <table id="headerTable">
                            <thead>
                                <tr>
                                    <th title="Filter: Ascending/Descending"> Voters ID </th>
                                    <th title="Filter: Ascending/Descending"> Voter status</th>
                                    <th title="Filter: Ascending/Descending"> Voters ID Img </th>
                                    <th title="Filter: Ascending/Descending"> BHS </th>
                                    <th title="Filter: Ascending/Descending"> Firstname </th>
                                    <th title="Filter: Ascending/Descending"> Lastname </th>
                                    <th title="Filter: Ascending/Descending"> Middlename </th>
                                    <th title="Filter: Ascending/Descending"> Gender </th>
                                    <th title="Filter: Ascending/Descending"> Age </th>
                                    <th title="Filter: Ascending/Descending"> Purok/Sitio/Subdivision </th>
                                    <th title="Filter: Ascending/Descending"> Household Number </th>
                                    <th title="Filter: Ascending/Descending"> NHTS Household </th>
                                    <th title="Filter: Ascending/Descending"> IP or Non-IP </th>
                                    <th title="Filter: Ascending/Descending"> HH Head PhilHealth Member </th>
                                    <th title="Filter: Ascending/Descending"> Category </th>
                                    <th title="Filter: Ascending/Descending"> Date Created </th>
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
                                        } elseif ($file_status == 'non-voter') {
                                            $class = 'cancelled';
                                        } else {
                                            $class = '';
                                        }

                                        echo "<tr>" .
                                            "<td><strong>" . $row["rVotersID"] . "</strong></td>" .
                                            "<td style='text-align: center;'><p class='status $class padding'>" . $row["rvoterstatus"] . "</p></td>" .
                                            "<td><a href='../ResidentsID/" . $row["voters_id_image"] . "' target='_blank'>View Voters ID</a></td>" .
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
                                            "<td><button class='viewMore'>View</button></td>" .
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


            <!-- RESIDENTS FORM VIEW -->
            <div class="overlayR"></div>

            <div class="residentsForm">

                <div class="rtopheadcon">


                    <div class="rheadTitle">

                        <div class="rheadcon">
                            <div class="line"></div>
                            <p>ADD RESIDENT'S INFORMATION</p>
                            <div class="line"></div>
                            <i class='bx bxs-x-circle' onclick="hideResidentForm()"></i>
                        </div>

                    </div>
                </div>
                <!-- form  -->


                <form id="formContainer" action="../php/addResidents.php" method="post" enctype="multipart/form-data">
                    <div class=" rform1">

                        <input type="hidden" id="memberCount" name="memberCount" value="0">

                        <div class="rInput">
                            <label for="BHS">BHS</label>
                            <input type="text" id="textbox" name="BHS" placeholder="Enter BHS" required>
                        </div>

                        <div class="rInput">
                            <label for="Purok">Purok/Sitio/Subdivision</label>
                            <input type="text" id="textbox" name="Purok" placeholder="Enter Purok/Sitio/Subdivision" required>
                        </div>

                        <div class="rInput">
                            <label for="Household">Household Number</label>
                            <input type="text" id="textbox" name="Household" placeholder="Enter Household Number" required>
                        </div>

                    </div>

                    <div class="rform1">

                        <div class="rInput">
                            <label for="Lastname">Last Name</label>
                            <input type="text" id="textbox" name="Lastname" placeholder="Enter Lastname" required>
                        </div>

                        <div class="rInput">
                            <label for="Firstname">First Name</label>
                            <input type="text" id="textbox" name="Firstname" placeholder="Enter Firstname" required>
                        </div>

                        <div class="rInput">
                            <label for="Maiden">Mother’s Maiden Name</label>
                            <input type="text" id="textbox" name="Maiden" placeholder="Enter Mother’s Maiden Name" required>
                        </div>

                    </div>

                    <div class="rform1">

                        <div class="rInput">
                            <label for="Age">Age</label>
                            <input type="text" id="textbox" name="Age" placeholder="Enter Age" oninput="validateAge(this)" required>
                        </div>

                        <div class="rInput">
                            <label for="Gender">Gender</label>
                            <select class="selectbox" id="bussSelect3" name="Gender" required onchange="changeFontColor('bussSelect3')">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="rInput">
                            <label for="VotersID">Voter's ID</label>
                            <select class="selectbox" id="bussSelect4" name="VotersID" required onchange="changeToTextbox1(this)">
                                <option value="">Select</option>
                                <option value="None">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>

                        <div class="rInput2">
                            <label for="avatar" class="required1">Upload Voter's ID</label>
                            <input class="rIDupload" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required disabled />
                        </div>

                    </div>

                    <div class="rform1">

                        <div class="rInput">
                            <label for="NHTS">NHTS Household</label>
                            <select class="selectbox" id="bussSelect1" name="NHTS" required onchange="changeFontColor('bussSelect1')">
                                <option value="">Select</option>
                                <option value="NHTS-4Ps">NHTS-4Ps</option>
                                <option value="NHTS-Non-4Ps">NHTS-Non-4Ps</option>
                                <option value="Non-NHTS">Non-NHTS</option>
                            </select>
                        </div>

                        <div class="rInput">
                            <label for="IP">IP or Non-IP</label>
                            <select class="selectbox" id="bussSelect8" name="IP" required onchange="changeFontColor('bussSelect8')">
                                <option value="">Select</option>
                                <option value="IP">IP</option>
                                <option value="Non-IP">Non-IP</option>
                            </select>
                        </div>

                        <div class="rInput">
                            <label for="HH">HH Head PhilHealth Member</label>

                            <select class="selectbox" id="bussSelect2" name="HH" required onchange="changeToTextbox(this)">
                                <option value="">Select</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>

                        <div class="rInput">
                            <label for="Category">Category</label>
                            <select class="selectbox" id="Category" name="Category" required disabled onchange="changeToTextbox(this)">
                                <option value="">Select</option>
                                <option value="FORMAL ECONOMY">FORMAL ECONOMY</option>
                                <option value="INFORMAL ECONOMY">INFORMAL ECONOMY</option>
                                <option value="INDIGENT">INDIGENT</option>
                                <option value="SPONSORED">SPONSORED</option>
                                <option value="LIFETIME MEMBER">LIFETIME MEMBER</option>
                            </select>
                        </div>

                    </div>

                    <!-- HOUSEHOLD MEMEBERS -->
                    <div class="rheadTitle">

                        <div class="rheadcon">
                            <div class="line"></div>
                            <p>HOUSEHOLD MEMBER</p>
                            <div class="line"></div>
                        </div>

                    </div>

                    <div class="addmember">
                        <div class="rform1">

                            <div class="rInput">
                                <label for="mLastname">Last Name</label>
                                <input type="text" id="textbox" name="mLastname" placeholder="Enter Lastname" required>
                            </div>

                            <div class="rInput">
                                <label for="mFirstname">First Name</label>
                                <input type="text" id="textbox" name="mFirstname" placeholder="Enter Firstname" required>
                            </div>

                            <div class="rInput">
                                <label for="mMaiden">Mother’s Maiden Name</label>
                                <input type="text" id="textbox" name="mMaiden" placeholder="Enter Mother’s Maiden Name" required>
                            </div>

                        </div>

                        <div class="rform1">

                            <div class="rInput">
                                <label for="mRelationship">Relationship</label>
                                <select class="selectbox" id="bussSelect6" name="mRelationship" required onchange="changeToTextbox2(this)">
                                    <option value="">Select Relationship</option>
                                    <option value="Head">Head</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>

                            <div class="rInput">
                                <label for="mGender">Gender</label>
                                <select class="selectbox" id="bussSelect7" name="mGender" required onchange="changeFontColor('bussSelect7')">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>




                            <div class="rInput">
                                <label for="mAge">Age</label>
                                <input type="text" id="textbox" name="mAge" placeholder="Enter Age" oninput="validateAge(this)" required>
                            </div>

                        </div>

                        <div class="rform1">
                            <div class="rInput">
                                <label for="mRisk">Classification by Age/Health Risk</label>
                                <select class="selectbox" id="bussSelect9" name="mRisk" required onchange="changeFontColor('bussSelect9')">
                                    <option value="">Select</option>
                                    <option value="Male">Newborn</option>
                                    <option value="Female">Infant (29days-11 months old)</option>
                                    <option value="Male">Under-five (1-4 years old)</option>
                                    <option value="Female">School-aged children (5-9 years old)</option>
                                    <option value="Male">Adolescents (10-19 years old)</option>
                                    <option value="Female">Pregnant</option>
                                    <option value="Male">Persons with disability</option>
                                    <option value="Female">Adult (≥25 years old) </option>
                                    <option value="Male">Adolescent-Pregnant</option>
                                    <option value="Female">Post Partum</option>
                                    <option value="Female">Senior Citizen</option>
                                </select>
                            </div>



                            <div class="rInput">
                                <label for="mQuarter">Quarter</label>
                                <select class="selectbox" id="bussSelect10" name="mQuarter" required onchange="changeFontColor('bussSelect10')">
                                    <option value="">Select Quarter</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Fourth">Fourth</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="addMember" onclick="addMember()">
                        <span>+ Add Household Member</span>
                    </div>

                    <div class="rButcon">
                        <button type="submit" class="rSubmit">Submit</button>
                    </div>

                </form>
            </div>

        </div>


    </div>
</body>

<script>

</script>


</html>