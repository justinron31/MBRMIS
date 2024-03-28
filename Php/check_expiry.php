<?php
include "db.php";
// Set the default timezone to Philippines
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the token from the AJAX request
    $token = $_POST['token'];

    // Check if the token is null
    if ($token === null) {
        echo json_encode(['status' => 'invalid']);
        exit();
    }

    // Retrieve the token expiry from the database
    $sql = "SELECT token_expiry FROM staff WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $expiryTime = strtotime($row['token_expiry']);

        if (time() > $expiryTime) {
            $stmt = $conn->prepare("UPDATE staff SET reset_token = NULL WHERE reset_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            // The link has expired
            echo json_encode(['status' => 'expired']);
        } else {
            echo json_encode(['status' => 'valid']);
        }
    } else {
        echo json_encode(['status' => 'invalid']);
    }
}
