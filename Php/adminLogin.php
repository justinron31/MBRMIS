<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = md5($password);

    $sql = "SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        header("Location: /MBRMIS/Dashboard/AdminDashboard.html");
        exit();
    } else {

        echo "Invalid username or password";
    }
}

$conn->close();
