<?php

session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['id'];
    $password = $_POST['password'];

    // Check the staff database using prepared statement
    $staffQuery = $conn->prepare("SELECT id, idnumber, firstname, pass, account_status, staff_role, last_login_timestamp, is_logged_in FROM staff WHERE idnumber = ?");
    $staffQuery->bind_param("s", $username);
    $staffQuery->execute();
    $staffResult = $staffQuery->get_result();

    if ($staffResult->num_rows == 1) {

        $row = $staffResult->fetch_assoc();
        $user_id = $row['id'];
        $accountStatus = $row['account_status'];
        $idnum = $row['idnumber'];
        $is_logged_in = $row['is_logged_in'];

       if ($is_logged_in) {
    $_SESSION['error_message'] = "You are currently logged in. Logout first.";
    $user_type = $_SESSION['user_type'];
    header("Location: /MBRMIS/Login/loginStaff.php?user_type=$user_type");
    exit();
}

        if ($accountStatus === 'Activated') {
            if (password_verify($password, $row['pass'])) {
                $name = $row['firstname'];
                $role = $row['staff_role'];

                $_SESSION['show_login_message'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $name;
                $_SESSION['idnumber'] = $idnum;
                $_SESSION['last_login_timestamp'] = $row['last_login_timestamp']; 

                // Set $_SESSION['user_type'] based on the role value
                $_SESSION['user_type'] = strtolower($role);

                // Update last login timestamp and set is_logged_in to 1
                $updateLoginTimestamp = $conn->prepare("UPDATE staff SET last_login_timestamp = NOW(), is_logged_in = 1 WHERE id = ?");
                $updateLoginTimestamp->bind_param("i", $user_id);
                $updateLoginTimestamp->execute();

                // Redirect based on user type
                if ($_SESSION['user_type'] === 'admin') {
                    header("Location: /MBRMIS/Dashboard/AdminDashboard.php");
                } elseif ($_SESSION['user_type'] === 'staff') {
                    header("Location: /MBRMIS/Dashboard/StaffDashboard.php");
                } else {
                    $_SESSION['error_message'] = "Invalid role";
                    header("Location: /MBRMIS/Login/loginStaff.php");
                }

                exit();
            } else {
                $_SESSION['error_message'] = "Invalid Credentials.";
            }
        } else {
            $_SESSION['error_message'] = "Account Deactivated. Please contact the admin.";
        }
    } else {
        $_SESSION['error_message'] = "Error.";
    }

    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$conn->close();