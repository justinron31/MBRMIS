<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

$query = "UPDATE resident_indigency SET viewed = 1 WHERE datetime_created > NOW() - INTERVAL 1 DAY AND viewed = 0";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
}