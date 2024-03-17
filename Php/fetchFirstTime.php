<?php
include 'db.php';

$sql = "SELECT type, id, firstname, lastname, birthdate, age, gender, contact_number, `civil_status`, address, residency, education, course, `job_start_beneficiary`, pickup_datetime, `datetime_created`, `id_number`, avatar, tracking_number, `file_status`, remarks FROM first_time_job ORDER BY `datetime_created` DESC";
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
