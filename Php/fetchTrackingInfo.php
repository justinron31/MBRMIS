<?php
include 'db.php';

$tCode = $_POST['tCode'];

$query1 = "SELECT * FROM file_request WHERE tracking_number = ?";
$stmt = $conn->prepare($query1);
$stmt->bind_param("s", $tCode);

$stmt->execute();

$result = $stmt->get_result();
$data1 = $result->fetch_all(MYSQLI_ASSOC);

$query2 = "SELECT * FROM first_time_job WHERE tracking_number = ?";
$stmt = $conn->prepare($query2);
$stmt->bind_param("s", $tCode);

$stmt->execute();

$result = $stmt->get_result();
$data2 = $result->fetch_all(MYSQLI_ASSOC);

$data = array_merge($data1, $data2);

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Invalid Tracking Number']);
}
