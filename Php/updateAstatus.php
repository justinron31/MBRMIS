<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['customUserId'];
    $newStatus = $_POST['customStatus'];

    $updateSql = "UPDATE staff SET account_status = '$newStatus' WHERE idnumber = '$userId'";
    $updateResult = $conn->query($updateSql);

    if ($updateResult) {
        // Fetch the updated data
        $fetchSql = "SELECT * FROM staff WHERE idnumber = '$userId'";
        $fetchResult = $conn->query($fetchSql);

        if ($fetchResult) {
            $updatedData = $fetchResult->fetch_assoc();
            echo json_encode(['status' => 'success', 'message' => 'Status updated successfully', 'data' => $updatedData]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching updated data: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating status: ' . $conn->error]);
    }
}

$conn->close();
