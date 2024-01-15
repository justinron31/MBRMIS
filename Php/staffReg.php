<?php
include 'db.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$idnum = $_POST['idnum'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert data into database
$sql = "INSERT INTO staff (firstname, lastname, idnumber, email, gender, pass) VALUES ('$fname', '$lname', '$idnum', '$email', '$gender', '$password')";

if ($conn->query($sql) === true) {
    echo '<script>';
    echo 'alert("Registered successfully!");';
    echo 'window.location.href = "/MBRMIS/Login/loginStaff.html";';
    echo '</script>';
    exit;
} else {
    echo '<script>';
    echo 'alert("Registration failed. Please try again.");';
    echo '</script>';
}

// Close connection
$conn->close();
