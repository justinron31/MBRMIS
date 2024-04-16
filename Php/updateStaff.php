<?php

session_start();
// Database connection parameters
include 'db.php';
date_default_timezone_set('Asia/Singapore');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function logUserActivity($conn, $action, $idnumber)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Staff Database';

    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate,type,request_tracking_number) VALUES (?, ?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $idnumber);

    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
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
        logUserActivity($conn, "Updated staff information", $idnumber);
        $_SESSION['success_update'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    } else {
        logUserActivity($conn, "Failed to update staff information");
        $_SESSION['error_update'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    }
}
$stmt->close();
$conn->close();
