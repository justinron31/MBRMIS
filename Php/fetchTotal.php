<?php
include 'db.php';

$sql = "SELECT * FROM file_request WHERE type='Certificate of Indigency'";
$result = $conn->query($sql);

$totalReq = 0;
if ($result) {
    $totalReq = $result->num_rows;
}

echo json_encode(array('totalReq' => $totalReq));
