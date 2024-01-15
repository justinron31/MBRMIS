<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['id'];
    $password = $_POST['password'];

    // SQL query to fetch hashed password from the database
    $sql = "SELECT * FROM staff WHERE idnumber = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the hashed password from the database
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['pass'];

        // Verify entered password against hashed password
        if (password_verify($password, $storedHashedPassword)) {
            // Passwords match, login successful

            // Fetch and display the name
            $name = $row['firstname'];

            // Set the user's name in the session variable
            $_SESSION['user_name'] = $name;

            // Redirect to the dashboard with a welcome message
            header("Location: /MBRMIS/Dashboard/StaffDashboard.html");
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid Credentials";
        }
    } else {
        $_SESSION['error_message'] = "Invalid Credentials";
    }
}

$conn->close();

// Redirect to login page with error message
header("Location: /MBRMIS/Login/loginStaff.html");
exit();
