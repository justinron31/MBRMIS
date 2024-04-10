<?php
include 'db.php';

$count1 = 0;
$count2 = 0;

// Query for first table
$query1 = "SELECT COUNT(*) AS count FROM file_request WHERE file_status = 'Reviewing'";
$result1 = mysqli_query($conn, $query1);

if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
    $count1 = $row1['count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

// Query for second table
$query2 = "SELECT COUNT(*) AS count FROM first_time_job WHERE file_status = 'Reviewing'";
$result2 = mysqli_query($conn, $query2);

if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    $count2 = $row2['count'];
} else {
    echo "Error: " . mysqli_error($conn);
}

echo json_encode(array('count1' => $count1, 'count2' => $count2));
?>