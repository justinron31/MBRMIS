<?php

include 'db.php';
session_start();
date_default_timezone_set('Asia/Singapore');

header('Content-Type: application/json');

function logUserActivity($conn, $action, $tracking_number)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Requested Document';
    $sql = "INSERT INTO useractivity (StaffID, FirstName, LastName, Role, Action, ActionDate,type,request_tracking_number) VALUES (?, ?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $tracking_number);
    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get POST data
    $id = $_POST['idnumC'];
    $tracking_number = $_POST['trackingC'];
    $type = $_POST['typeC'];
    $firstname = $_POST['fnameC'];
    $lastname = $_POST['lnameC'];
    $purpose = $_POST['PurposeC'];
    $address = $_POST['AddressC'];

    // Check if the "ResidencyC" field is set in the $_POST array
    $residency = isset($_POST['ResidencyC']) ? $_POST['ResidencyC'] : null;

    // Determine the table to update based on the file type
    switch ($type) {
        case 'Certificate of Residency':
        case 'Certificate of Indigency':
            $table = 'file_request';
            break;
        case 'First Time Job Seeker':
            $table = 'first_time_job';
            break;
        default:
            // Handle other file types here (e.g., "Scholarship")
            echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
            exit;
    }

    // Prepare and execute the update query
    if ($table === 'file_request') {
        $updateSql = "UPDATE $table SET firstname = ?, lastname = ?, purpose_description = ?, purok = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => 'Error preparing update statement: ' . $conn->error]);
            exit;
        }
        $stmt->bind_param('ssssi', $firstname, $lastname, $purpose, $address, $id);
    } else if ($table === 'first_time_job') {
        if (!empty($residency)) {
            $updateSql = "UPDATE $table SET firstname = ?, lastname = ?, purpose_description = ?, address = ?, residency = ? WHERE id = ?";
            $stmt = $conn->prepare($updateSql);
            if (!$stmt) {
                echo json_encode(['status' => 'error', 'message' => 'Error preparing update statement: ' . $conn->error]);
                exit;
            }
            $stmt->bind_param('sssssi', $firstname, $lastname, $purpose, $address, $residency, $id);
        } else {
            // Skip the update if residency is empty
            echo json_encode(['status' => 'error', 'message' => 'Residency cannot be empty']);
            exit;
        }
    }

    $updateResult = $stmt->execute();
    if (!$updateResult) {
        $_SESSION['error_update'] = true;
        header('Location: ../Dashboard/ReqDocu.php');
    } else {
        $_SESSION['success_update'] = true;
        header('Location: ../Dashboard/ReqDocu.php');
    }

    // Log user activity
    logUserActivity($conn, 'Update/Edit', $tracking_number);
    // Close statement
    $stmt->close();
}
