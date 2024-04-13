<?php
include 'db.php';

date_default_timezone_set('Asia/Singapore');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['fileStatusId'];
    $newStatus = $_POST['fileStatus'];
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $currentDateTime = date('Y-m-d H:i:s');

    $updateSql = "UPDATE first_time_job SET file_status = ?, remarks = ?, file_data_updated = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('ssss', $newStatus, $remarks, $currentDateTime, $userId);
    $updateResult = $stmt->execute();

    if ($updateResult) {
        $fetchSql = "SELECT * FROM first_time_job WHERE id = ?";
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
}

$conn->close();
