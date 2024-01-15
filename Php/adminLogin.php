<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the entered password (replace this with a more secure method like bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to fetch data
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch and display the name
        $row = $result->fetch_assoc();
        $name = $row['name'];

        $_SESSION['user_name'] = $name;

        header("Location: /MBRMIS/Dashboard/AdminDashboard.html");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid Credentials";
    }
}

$conn->close();

header("Location: /MBRMIS/Login/loginAdmin.html");
exit();
