<?php
include 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['fileStatusId'];
    $newStatus = $_POST['fileStatus'];
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $currentDateTime = date('Y-m-d H:i:s');

    // Update file_request table
    $updateSql = "UPDATE file_request SET file_status = ?, remarks = ?, file_data_updated = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('ssss', $newStatus, $remarks, $currentDateTime, $userId);
    $updateResult1 = $stmt->execute();

    // Update first_time_job table
    $updateSql2 = "UPDATE first_time_job SET file_status = ?, remarks = ?, file_data_updated = ? WHERE id = ?";
    $stmt2 = $conn->prepare($updateSql2);
    $stmt2->bind_param('ssss', $newStatus, $remarks, $currentDateTime, $userId);
    $updateResult2 = $stmt2->execute();

    if ($updateResult1 && $updateResult2) {
        $fetchSql = "SELECT * FROM file_request WHERE id = ?";
        $stmt = $conn->prepare($fetchSql);
        $stmt->bind_param('s', $userId);
        $fetchResult = $stmt->execute();

        if ($fetchResult) {
            $result = $stmt->get_result();
            $updatedData = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'message' => 'File Status updated successfully!', 'data' => $updatedData]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching updated data: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating File status: ' . $conn->error]);
    }

    $stmt->close();
    $stmt2->close();
}

$conn->close();
