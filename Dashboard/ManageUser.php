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
    <script src="../Dashboard/CSS,JS/Dashboard.js" defer></script>
    <script src="../Dashboard/CSS,JS/Table.js" defer></script>


    <title>MAKILING BRMI SYSTEM - Manage Users</title>
</head>


<!--LOGIN PHP -->
<?php
session_start();

// Check if the user is not logged in as admin
if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page
    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$userName = $_SESSION['user_name'];

// Check if the login message should be displayed
$showLoginMessage = isset($_SESSION['show_login_message']) && $_SESSION['show_login_message'] === true;

// Reset the session variable to avoid displaying the message on page refresh
$_SESSION['show_login_message'] = false;
?>


<body>


    <!--  MODAL POPUP-->
    <div id="overlay" class="overlay"></div>
    <div id="logoutModal" class="modal">
        <div class="modal-message">
            <p>Do you want to logout?</p>
        </div>
        <div class="modal-buttons">
            <button class="yes" onclick="logout()">Yes</button>
            <button class="no" onclick="closeLogoutModal()">No</button>
        </div>
    </div>

    <!-- SIDEBAR-->
    <div class="masterCOn">
        <nav class="sidebar locked">
            <div class="logo_items flex">
                <span class="nav_image">
                    <img src="../Images/logo.png" alt="logo_img" />
                </span>
                <span class="logo_name"> MBRMI SYSTEM</span>
                <i class="bx bxs-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
                <i class="bx bx-x" id="sidebar-close" title="lock Sidebar"></i>
            </div>


            <!--SIDEBAR CONTENT-->
            <div class="menu_container">
                <div class="menu_items">
                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">Dashboard</span>
                            <span class="line"></span>
                        </div>
                        <li class="item ">
                            <a href="/MBRMIS/Dashboard/AdminDashboard.php" class="link flex">
                                <i class="bx bxs-dashboard"></i>
                                <span>Overview</span>
                            </a>
                        </li>

                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        location_away
                                    </span>
                                </i>
                                <span>Residents Record</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">Menu</span>
                            <span class="line"></span>
                        </div>

                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        badge
                                    </span>
                                </i>
                                <span>Barangay Certificates</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        clinical_notes
                                    </span>
                                </i>
                                <span>Certificate of Residency</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        card_membership
                                    </span>
                                </i>
                                <span>Brgy. Business Clearance</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        lab_profile
                                    </span>
                                </i>
                                <span>Community Tax Certificate</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i>
                                    <span class="material-symbols-outlined">
                                        home_storage
                                    </span>
                                </i>
                                <span>Requested Documents</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">Others</span>
                            <span class="line"></span>
                        </div>
                        <li class="item active">
                            <a href="#" class="link flex">
                                <i class='bx bxs-user-detail'></i>
                                <span>Manage System User</span>
                            </a>
                        </li>
                        <li class="item ">
                            <a href="#" class="link flex">
                                <i class='bx bxs-report'></i>
                                <span>Reporting View</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="menu_item">
                        <div class="menu_title flex">
                            <span class="title">System</span>
                            <span class="line"></span>
                        </div>
                        <li class="item">
                            <a href="#" class="link flex">
                                <i class="bx bx-cog"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="item " onclick="openLogoutModal()">
                            <a href="#" class="link flex">
                                <i class='bx bxs-exit bx-rotate-180'></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- MAIN CONTENT-->
        <div class="headermain">

            <div class="headerTop">
                <div class="header">

                    <h1 class="maintitle">
                        DASHBOARD
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


            <!-- MAIN CONTENT -->

            <div class="supermaincontain">

                <main class="table" id="customers_table">
                    <section class="table__header">
                        <h1>Customer's Orders</h1>
                        <div class="input-group">
                            <input type="search" placeholder="Search Data...">
                            <img src="images/search.png" alt="">
                        </div>
                        <div class="export__file">
                            <label for="export-file" class="export__file-btn" title="Export File"></label>
                            <input type="checkbox" id="export-file">
                            <div class="export__file-options">
                                <label>Export As &nbsp; &#10140;</label>
                                <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                                <label for="export-file" id="toJSON">JSON <img src="images/json.png" alt=""></label>
                                <label for="export-file" id="toCSV">CSV <img src="images/csv.png" alt=""></label>
                                <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                            </div>
                        </div>
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Customer <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Location <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Order Date <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> <img src="images/Zinzu Chan Lee.jpg" alt="">Zinzu Chan Lee</td>
                                    <td> Seoul </td>
                                    <td> 17 Dec, 2022 </td>
                                    <td>
                                        <p class="status delivered">Delivered</p>
                                    </td>
                                    <td> <strong> $128.90 </strong></td>
                                    <td> <strong> $128.90 </strong></td>
                                    <td> <strong> $128.90 </strong></td>
                                    <td> <strong> $128.90 </strong></td>
                                    <td> <strong> $128.90 </strong></td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td><img src="images/Jeet Saru.png" alt=""> Jeet Saru </td>
                                    <td> Kathmandu </td>
                                    <td> 27 Aug, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$5350.50</strong> </td>
                                    <td> <strong>$5350.50</strong> </td>
                                    <td> <strong>$5350.50</strong> </td>
                                    <td> <strong>$5350.50</strong> </td>
                                    <td> <strong>$5350.50</strong> </td>
                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td><img src="images/Sonal Gharti.jpg" alt=""> Sonal Gharti </td>
                                    <td> Tokyo </td>
                                    <td> 14 Mar, 2023 </td>
                                    <td>
                                        <p class="status shipped">Shipped</p>
                                    </td>
                                    <td> <strong>$210.40</strong> </td>
                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td><img src="images/Alson GC.jpg" alt=""> Alson GC </td>
                                    <td> New Delhi </td>
                                    <td> 25 May, 2023 </td>
                                    <td>
                                        <p class="status delivered">Delivered</p>
                                    </td>
                                    <td> <strong>$149.70</strong> </td>
                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td><img src="images/Sarita Limbu.jpg" alt=""> Sarita Limbu </td>
                                    <td> Paris </td>
                                    <td> 23 Apr, 2023 </td>
                                    <td>
                                        <p class="status pending">Pending</p>
                                    </td>
                                    <td> <strong>$399.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 6</td>
                                    <td><img src="images/Alex Gonley.jpg" alt=""> Alex Gonley </td>
                                    <td> London </td>
                                    <td> 23 Apr, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$399.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 7</td>
                                    <td><img src="images/Alson GC.jpg" alt=""> Jeet Saru </td>
                                    <td> New York </td>
                                    <td> 20 May, 2023 </td>
                                    <td>
                                        <p class="status delivered">Delivered</p>
                                    </td>
                                    <td> <strong>$399.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 8</td>
                                    <td><img src="images/Sarita Limbu.jpg" alt=""> Aayat Ali Khan </td>
                                    <td> Islamabad </td>
                                    <td> 30 Feb, 2023 </td>
                                    <td>
                                        <p class="status pending">Pending</p>
                                    </td>
                                    <td> <strong>$149.70</strong> </td>
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td><img src="images/Alex Gonley.jpg" alt=""> Alson GC </td>
                                    <td> Dhaka </td>
                                    <td> 22 Dec, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$249.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td><img src="images/Alex Gonley.jpg" alt=""> Alson GC </td>
                                    <td> Dhaka </td>
                                    <td> 22 Dec, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$249.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td><img src="images/Alex Gonley.jpg" alt=""> Alson GC </td>
                                    <td> Dhaka </td>
                                    <td> 22 Dec, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$249.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td><img src="images/Alex Gonley.jpg" alt=""> Alson GC </td>
                                    <td> Dhaka </td>
                                    <td> 22 Dec, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$249.99</strong> </td>
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td><img src="images/Alex Gonley.jpg" alt=""> Alson GC </td>
                                    <td> Dhaka </td>
                                    <td> 22 Dec, 2023 </td>
                                    <td>
                                        <p class="status cancelled">Cancelled</p>
                                    </td>
                                    <td> <strong>$249.99</strong> </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </main>


            </div>
</body>




</html>