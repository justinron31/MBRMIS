<?php
session_start(); // Start the session

include 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $idnum = $_POST['idnum'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Prepare the SQL query
    $sql = "INSERT INTO staff_information (idnumber, first_name, last_name, dateCreated) VALUES (?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error: Unable to prepare statement: $sql " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sss", $idnum, $fname, $lname);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success_delete'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    } else {
        $_SESSION['error_delete'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    }
}
$stmt->close();
// Close the connection
$conn->close();
