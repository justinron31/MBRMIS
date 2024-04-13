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

    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate, request_tracking_number, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
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

        // Fetch the tracking number and type from file_request table
        $fetchSql1 = "SELECT tracking_number, type FROM file_request WHERE id = ?";
        $stmt1 = $conn->prepare($fetchSql1);
        $stmt1->bind_param('i', $userId);
        $fetchResult1 = $stmt1->execute();

        if ($fetchResult1) {
            $result1 = $stmt1->get_result();
            if ($result1 && $data1 = $result1->fetch_assoc()) {
                $trackingNumber1 = $data1['tracking_number'];
                $type1 = $data1['type'];
                logUserActivity($conn, 'Updated File Status', $trackingNumber1, $type1);
            } else {
                error_log("No data found in file_request for user with ID: " . $userId);
            }
        } else {
            error_log("Error fetching tracking number and type from file_request: " . mysqli_stmt_error($stmt1));
        }

        // Fetch the tracking number and type from first_time_job table
        $fetchSql2 = "SELECT tracking_number, type FROM first_time_job WHERE id = ?";
        $stmt2 = $conn->prepare($fetchSql2);
        $stmt2->bind_param('i', $userId);
        $fetchResult2 = $stmt2->execute();

        if ($fetchResult2) {
            $result2 = $stmt2->get_result();
            if ($result2 && $data2 = $result2->fetch_assoc()) {
                $trackingNumber2 = $data2['tracking_number'];
                $type2 = $data2['type'];
                logUserActivity($conn, 'Updated File Status', $trackingNumber2, $type2);
            } else {
                error_log("No data found in first_time_job for user with ID: " . $userId);
            }
        } else {
            error_log("Error fetching tracking number and type from first_time_job: " . mysqli_stmt_error($stmt2));
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
}
