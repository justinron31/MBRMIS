<?php
session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['id'];
    $password = $_POST['password'];

    // Check the admin database
    $adminQuery = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $adminResult = $conn->query($adminQuery);

    if ($adminResult->num_rows == 1) {
        // Admin found
        $row = $adminResult->fetch_assoc(); // Corrected line
        $name = $row['name'];

        $_SESSION['show_login_message'] = true;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_type'] = 'admin';

        // Assign user role to userRole variable

        header("Location: /MBRMIS/Dashboard/AdminDashboard.php");
        exit();
    }

    // Check the staff database
    $staffQuery = "SELECT id, firstname, pass, account_status FROM staff WHERE idnumber = '$username'";
    $staffResult = $conn->query($staffQuery);

    if ($staffResult->num_rows == 1) {
        // Staff found
        $row = $staffResult->fetch_assoc();

        // Check the account status
        $accountStatus = $row['account_status'];

        if ($accountStatus === 'active') {
            // Fetch the hashed password from the database
            $storedHashedPassword = $row['pass'];

            // Verify entered password against hashed password
            if (password_verify($password, $storedHashedPassword)) {
                // Passwords match, login successful

                // Fetch and display the name
                $name = $row['firstname'];

                $_SESSION['show_login_message'] = true;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_type'] = 'staff';

                // Assign user role to userRole variable

                // Redirect to the dashboard with a welcome message
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

    // No user found with the entered credentials
    header("Location: /MBRMIS/Login/loginStaff.php");
    exit();
}

$conn->close();
