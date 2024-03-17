<?php
include 'db.php';

$count = 0;
$notifCount = 0;
$query = "SELECT * FROM file_request WHERE DATE(datetime_created) = DATE(NOW()) AND file_status = 'Processing' AND type='Certificate of Indigency'";
$result = mysqli_query($conn, $query);

if ($result) {
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['notification_played'] == false) {
            $notifCount++;
            $updateQuery = "UPDATE file_request SET notification_played = true WHERE id = " . $row['id'];
            mysqli_query($conn, $updateQuery);
        }
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

echo json_encode(array('count' => $count, 'notifCount' => $notifCount));
