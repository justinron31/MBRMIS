<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['id'];

    // Fetch file information including the trackingNumber, fileStatusId, and fileStatus columns
    $fetchFileInfoSql = "SELECT tracking_number, file_status, remarks FROM file_request WHERE id = ?";

    // Use prepared statement for better security
    $stmt = $conn->prepare($fetchFileInfoSql);
    $stmt->bind_param('s', $fileId);
    $fileInfoResult = $stmt->execute();

    if ($fileInfoResult) {
        $result = $stmt->get_result();
        $fileInfo = $result->fetch_assoc();

        // Return the file's trackingNumber, fileStatusId, and fileStatus as JSON
        echo json_encode(['tracking_number' => $fileInfo['tracking_number'], 'fileStatus' => $fileInfo['file_status']]);
    } else {
        echo json_encode(['error' => 'Error fetching file information: ' . $conn->error]);
    }

    $stmt->close();
}

$conn->close();
