<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['id'];
    $password = $_POST['password'];

    // Check the staff database using prepared statement
    $staffQuery = $conn->prepare("SELECT id, firstname, pass, account_status, staff_role FROM staff WHERE idnumber = ?");
    $staffQuery->bind_param("s", $username);
    $staffQuery->execute();
    $staffResult = $staffQuery->get_result();

    if ($staffResult->num_rows == 1) {
        // Staff found
        $row = $staffResult->fetch_assoc();
        $user_id = $row['id'];
        $accountStatus = $row['account_status'];

        if ($accountStatus === 'Activated' && password_verify($password, $row['pass'])) {
            $name = $row['firstname'];
            $role = $row['staff_role'];

            $_SESSION['show_login_message'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $name;

            // Set $_SESSION['user_type'] based on the role value
            $_SESSION['user_type'] = strtolower($role); 

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
            $_SESSION['error_message'] = "Invalid Credentials";
        }
    } else {
        $_SESSION['error_message'] = "Invalid Credentials";
    }

    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$conn->close();