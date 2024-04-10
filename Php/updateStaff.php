<?php

session_start();
// Database connection parameters
include 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the form
    $idnumber = $_POST['idnum'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];

    // Prepare an SQL statement for updating the data
    $stmt = $conn->prepare("UPDATE staff_information SET first_name = ?, last_name = ?, date_updated = NOW() WHERE idnumber = ?");

    // Bind the form data to the SQL statement
    $stmt->bind_param("ssi", $firstname, $lastname, $idnumber);

    // Execute the SQL statement
    if ($stmt->execute()) {
        $_SESSION['success_update'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    } else {
        $_SESSION['error_update'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    }
}
$stmt->close();
$conn->close();
