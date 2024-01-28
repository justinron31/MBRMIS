<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $field = $_GET['field'];
    $value = $_GET['value'];

    // Check if either the original or capitalized value exists in the database
    $sql = "SELECT * FROM staff WHERE $field = '$value' OR $field = '" . strtoupper($value) . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Value is already taken
        echo "taken";
    } else {
        // Value is available
        echo "available";
    }
}
