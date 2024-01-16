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

        $_SESSION['user_name'] = $name;
        $_SESSION['user_type'] = 'admin';
        header("Location: /MBRMIS/Dashboard/AdminDashboard.php");
        exit();
    }

    // Check the staff database
    $staffQuery = "SELECT * FROM staff WHERE idnumber = '$username'";
    $staffResult = $conn->query($staffQuery);

    if ($staffResult->num_rows == 1) {
        // Staff found
        $row = $staffResult->fetch_assoc(); // Corrected line

        // Fetch the hashed password from the database
        $storedHashedPassword = $row['pass'];

        // Verify entered password against hashed password
        if (password_verify($password, $storedHashedPassword)) {
            // Passwords match, login successful

            // Fetch and display the name
            $name = $row['firstname'];

            // Set the user's name in the session variable
            $_SESSION['user_name'] = $name;
            $_SESSION['user_type'] = 'staff';
            $_SESSION['show_login_message'] = true; // Set this variable to true to display the message

            // Redirect to the dashboard with a welcome message
            header("Location: /MBRMIS/Dashboard/StaffDashboard.html");
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid Credentials";
        }
    } else {
        $_SESSION['error_message'] = "fuck u";
    }

    // No user found with the entered credentials
    header("Location: /MBRMIS/Login/loginStaff.html"); // Adjust the login page URL as needed
    exit();
}

$conn->close();