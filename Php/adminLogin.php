<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM staff WHERE username = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {

            echo "Login successful!";
        } else {

            echo "Invalid password";
        }
    } else {

        echo "Invalid ID";
    }
}

$conn->close();
