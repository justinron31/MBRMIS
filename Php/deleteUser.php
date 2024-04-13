<?php
// Include your database connection file here
include 'db.php';

// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM staff WHERE idnumber = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Echo a JSON response
        echo json_encode(array("status" => "success", "message" => "User deleted successfully"));
    } else {
        // Echo a JSON response
        echo json_encode(array("status" => "error", "message" => "Error deleting user"));
    }

    $stmt->close();
    $conn->close();
}
