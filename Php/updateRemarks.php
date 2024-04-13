<?php

include 'db.php';
session_start();
date_default_timezone_set('Asia/Singapore');

function logUserActivity($conn, $action, $trackingNumber)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');

    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate, request_tracking_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $trackingNumber);

    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
}

// Check if remarks and id are set in POST
if (isset($_POST['remarks'], $_POST['id'])) {
    $remarks = $_POST['remarks'];
    $userId = $_POST['id'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("UPDATE file_request SET remarks = ? WHERE id = ?");

    // Bind parameters
    $stmt->bind_param("si", $remarks, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        // Fetch the tracking number
        $fetchSql = "SELECT tracking_number FROM file_request WHERE id = ?";
        $stmt = $conn->prepare($fetchSql);
        $stmt->bind_param('i', $userId);  // Changed 's' to 'i' as id is usually an integer
        $fetchResult = $stmt->execute();

        if ($fetchResult) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $trackingNumber = $data['tracking_number'];
            logUserActivity($conn, 'Updated a remark', $trackingNumber);
        }

        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $stmt->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Remarks or ID not provided"));
}

$conn->close();
