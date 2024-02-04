<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['id'];
    $password = $_POST['password'];

    // Check the admin database using prepared statement
    $adminQuery = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $adminQuery->bind_param("ss", $username, $password);
    $adminQuery->execute();
    $adminResult = $adminQuery->get_result();

    if ($adminResult->num_rows == 1) {
        // Admin found
        $row = $adminResult->fetch_assoc();
        $name = $row['name'];

        $_SESSION['show_login_message'] = true;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_type'] = 'admin';

        header("Location: /MBRMIS/Dashboard/AdminDashboard.php");
        exit();
    }

    // Check the staff database using prepared statement
    $staffQuery = $conn->prepare("SELECT id, firstname, pass, account_status FROM staff WHERE idnumber = ?");
    $staffQuery->bind_param("s", $username);
    $staffQuery->execute();
    $staffResult = $staffQuery->get_result();

    if ($staffResult->num_rows == 1) {
        // Staff found
        $row = $staffResult->fetch_assoc();
        $accountStatus = $row['account_status'];

        if ($accountStatus === 'Activated') {
            $storedHashedPassword = $row['pass'];

            if (password_verify($password, $storedHashedPassword)) {
                $name = $row['firstname'];

                $_SESSION['show_login_message'] = true;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_type'] = 'staff';

                header("Location: /MBRMIS/Dashboard/StaffDashboard.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Invalid Credentials";
            }
        } else {
            $_SESSION['error_message'] = "Your account is deactivated. Please contact the admin.";
        }
    } else {
        $_SESSION['error_message'] = "Invalid Credentials";
    }

    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$conn->close();
