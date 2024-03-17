<?php
include 'db.php';

$sql = "SELECT id, lastname, firstname, contact_number, pickup_datetime, purpose_description, voters_id_image, voters_id_number, datetime_created, tracking_number, file_status FROM file_request WHERE type='Certificate of Indigency' ORDER BY datetime_created DESC";
$result = $conn->query($sql);

$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $result->close();
}

echo json_encode($data);

$conn->close();
