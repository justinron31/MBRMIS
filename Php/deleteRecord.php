<?php

include 'db.php';
session_start();

function logUserActivity($conn, $action, $rfirstName, $rlastName)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Resident Record';

    $sql = "INSERT INTO useractivity (StaffID, FirstName, LastName, Role, Action, ActionDate, type, ResidentFirstName, ResidentLastName) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $rfirstName, $rlastName);
    $stmt->execute();
}


// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');

$id = $_POST['id'];

// Fetch the resident's first name and last name
$query = "SELECT rFirstName, rLastName FROM residentrecord WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($rfirstName, $rlastName);
$stmt->fetch();
$stmt->close();

// Prepare and execute the query to delete the family members
$query = "DELETE FROM familymember WHERE resident_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id);
if ($stmt->execute()) {
    // Prepare and execute the query to delete the record
    $query = "DELETE FROM residentrecord WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        // Set the session variable for success
        $_SESSION['success_delete'] = true;
        echo 'success';
        logUserActivity($conn, 'Deleted a record', $rfirstName, $rlastName);
    } else {
        // Set the session variable for failure
        $_SESSION['failure_delete'] = true;
        echo 'failure';
    }
} else {
    // Set the session variable for failure
    $_SESSION['failure_delete'] = true;
    echo 'failure';
}

$conn->close();
exit();
