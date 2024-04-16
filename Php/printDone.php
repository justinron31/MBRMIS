<?php

include 'db.php';
session_start();
date_default_timezone_set('Asia/Singapore');

header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get POST data
    $tracking = $_POST['trackingNumber'];
    $userId = $_POST['userId'];
    $fileType = $_POST['fileType'];
    $newStatus = 'Ready for Pickup';
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $currentDateTime = date('Y-m-d H:i:s');

    // Determine the table to update based on file type
    switch ($fileType) {
        case 'Certificate of Indigency':
        case 'Certificate of Residency':
            $table = 'file_request';
            break;
        case 'First Time Job Seeker':
            $table = 'first_time_job';
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
            exit;
    }

    // Prepare and execute the update query
    $updateSql = "UPDATE $table SET file_status = ?, remarks = ?, file_data_updated = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing update statement: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param('sssi', $newStatus, $remarks, $currentDateTime, $userId);
    $updateResult = $stmt->execute();
    if (!$updateResult) {
        echo json_encode(['status' => 'error', 'message' => 'Error updating file status: ' . $stmt->error]);
        exit;
    }

    // Log user activity
    $action = 'Printed Certificate';
    logUserActivity($conn, $action, $tracking, $fileType);

    // Close statement
    $stmt->close();

    // Return success response
    echo json_encode(['status' => 'success']);
}

// Function to log user activity
function logUserActivity($conn, $action, $trackingNumber, $type)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');

    // Prepare and execute insert query
    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate, request_tracking_number, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $trackingNumber, $type);

    if ($stmt->execute()) {
        $_SESSION['success_update'] = true;
        header('Location: ../Dashboard/ReqDocu.php');
        exit;
    } else {
        $_SESSION['error_update'] = true;
        header('Location: ../Dashboard/ReqDocu.php');
        exit;
    }
}