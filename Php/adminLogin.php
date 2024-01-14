<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the entered password (replace this with a more secure method like bcrypt)
    $hashedPassword = md5($password);

    // SQL query to fetch data
    $sql = "SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch and display the name
        $row = $result->fetch_assoc();
        $name = $row['name'];

        // Set the user's name in the session variable
        $_SESSION['user_name'] = $name;

        // Redirect to the dashboard with a welcome message
        header("Location: /MBRMIS/Dashboard/AdminDashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid Credentials";
    }
}

$conn->close();

// Redirect to login page with error message
header("Location: /MBRMIS/Login/loginAdmin.php");
exit();
