<?php

include 'db.php';
session_start();
date_default_timezone_set('Asia/Singapore');

function logUserActivity($conn, $action, $trackingNumber, $type)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');

    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate, request_tracking_number, Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $trackingNumber, $type);

    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['fileStatusId'];
    $newStatus = $_POST['fileStatus'];
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $currentDateTime = date('Y-m-d H:i:s');

    // Update file_request table
    $updateSql = "UPDATE file_request SET file_status = ?, remarks = ?, file_data_updated = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('sssi', $newStatus, $remarks, $currentDateTime, $userId);
    $updateResult1 = $stmt->execute();

    // Update first_time_job table
    $updateSql2 = "UPDATE first_time_job SET file_status = ?, remarks = ?, file_data_updated = ? WHERE id = ?";
    $stmt2 = $conn->prepare($updateSql2);
    $stmt2->bind_param('sssi', $newStatus, $remarks, $currentDateTime, $userId);
    $updateResult2 = $stmt2->execute();

    if ($updateResult1 && $updateResult2) {

        // Fetch the tracking number and type
        $fetchSql = "SELECT tracking_number, type FROM file_request WHERE id = ?";
        $stmt = $conn->prepare($fetchSql);
        $stmt->bind_param('i', $userId);
        $fetchResult = $stmt->execute();

        if ($fetchResult) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $trackingNumber = $data['tracking_number'];
            $type = $data['type'];
            logUserActivity($conn, 'Updated a file status', $trackingNumber, $type);
        } else {
            error_log("Error fetching tracking number and type: " . $stmt->error);
        }

        $fetchSql = "SELECT * FROM file_request WHERE id = ?";
        $stmt = $conn->prepare($fetchSql);
        $stmt->bind_param('i', $userId);
        $fetchResult = $stmt->execute();

        if ($fetchResult) {
            $result = $stmt->get_result();
            $updatedData = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'message' => 'File Status updated successfully!', 'data' => $updatedData]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching updated data: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating File status: ' . $conn->error]);
    }

    $stmt->close();
    $stmt2->close();
}

$conn->close();
