<?php
// Include your database connection file here
include 'db.php';
session_start();

// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');

function logUserActivity($conn, $action, $idnumber)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'System User';

    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate,type,request_tracking_number) VALUES (?, ?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);

    // Check if $stmt is created successfully
    if ($stmt === false) {
        error_log("Failed to prepare the SQL statement");
        return;
    }

    $stmt->bind_param("isssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $idnumber);

    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM staff WHERE idnumber = ?");

    // Check if $stmt is created successfully
    if ($stmt === false) {
        echo json_encode(array("status" => "error", "message" => "Error preparing the delete statement"));
        $conn->close();
        exit;
    }

    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Log user activity
        logUserActivity($conn, "Deleted system user", $id);

        // Echo a JSON response
        echo json_encode(array("status" => "success", "message" => "User deleted successfully"));
    } else {
        // Echo a JSON response
        echo json_encode(array("status" => "error", "message" => "Error deleting user"));
    }

    $stmt->close();
    $conn->close();
}