<?php
include 'db.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$idnum = $_POST['idnum'];
$email = $_POST['email'];
$gender = $_POST['genderSelect'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert data into database
$sql = "INSERT INTO staff (firstname, lastname, idnumber, email, gender, pass) VALUES ('$fname', '$lname', '$idnum', '$email', '$gender', '$password')";

if ($conn->query($sql) === true) {
    // Registration successful
    header('Location: /MBRMIS/Login/loginStaff.php?registration=success');
    exit;
} else {
    // Registration failed
    echo '<script>';
    echo 'alert("Registration failed. Please try again.");';
    echo 'window.location.href = "/MBRMIS/Login/staffRegister.html";';
    echo '</script>';
}

// Close connection
$conn->close();