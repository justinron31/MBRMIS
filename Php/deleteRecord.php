<?php

include 'db.php';
session_start();

$id = $_POST['id'];

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
