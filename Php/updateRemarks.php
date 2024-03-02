<?php
include 'db.php';

// Check if remarks and id are set in POST
if (isset($_POST['remarks']) && isset($_POST['id'])) {
    $remarks = $_POST['remarks'];
    $userId = $_POST['id'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("UPDATE file_request SET remarks = ? WHERE id = ?");

    // Bind parameters
    $stmt->bind_param("si", $remarks, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $stmt->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Remarks or ID not provided"));
}
