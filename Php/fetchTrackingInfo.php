<?php
include 'db.php';

$tCode = $_POST['tCode']; 


$query = "SELECT * FROM file_request WHERE tracking_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $tCode);

$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode($data); 
} else {
    echo json_encode(['error' => 'No record found']); 
}
