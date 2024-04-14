<?php
include 'db.php';
session_start();
date_default_timezone_set('Asia/Singapore');

function logUserActivity($conn, $action, $idnumber)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Staff Information';
    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate,type,request_tracking_number) VALUES (?, ?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $idnumber);
    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['customUserId'];
    $newStatus = $_POST['customStatus'];
    $newRole = $_POST['customRole'];

    // Use prepared statements to prevent SQL injection
    $updateSql = "UPDATE staff SET account_status = ?, staff_role = ? WHERE idnumber = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('sss', $newStatus, $newRole, $userId);
    $updateResult = $stmt->execute();
    $stmt->close();

    if ($updateResult) {
        // Log user activity
        logUserActivity($conn, "Updated staff account status and role", $userId);

        // Fetch the updated data
        $fetchSql = "SELECT * FROM staff WHERE idnumber = ?";
        $stmt = $conn->prepare($fetchSql);
        $stmt->bind_param('s', $userId);
        $fetchResult = $stmt->execute();

        if ($fetchResult) {
            $result = $stmt->get_result();
            $updatedData = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'message' => 'Account Status updated successfully!', 'data' => $updatedData]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching updated data: ' . $conn->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating Account status: ' . $conn->error]);
    }
}

$conn->close();