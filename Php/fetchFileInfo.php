<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['id'];

    // Fetch file information from file_request table
    $fetchFileInfoSql = "SELECT tracking_number, file_status, remarks FROM file_request WHERE id = ?";
    $stmt = $conn->prepare($fetchFileInfoSql);
    $stmt->bind_param('s', $fileId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data1 = $result->fetch_all(MYSQLI_ASSOC);

    // Fetch job information from first_time_job table
    $fetchJobInfoSql = "SELECT tracking_number, file_status, remarks FROM first_time_job WHERE id = ?";
    $stmt2 = $conn->prepare($fetchJobInfoSql);
    $stmt2->bind_param('s', $fileId);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $data2 = $result2->fetch_all(MYSQLI_ASSOC);

    $data = array_merge($data1, $data2);

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Error fetching information: ' . $conn->error]);
    }

    $stmt->close();
    $stmt2->close();
}

$conn->close();
