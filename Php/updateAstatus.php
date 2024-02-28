<?php
include 'db.php';

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