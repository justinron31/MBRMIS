<?php

include 'db.php';
session_start();
date_default_timezone_set('Asia/Singapore');

header('Content-Type: application/json');

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Get GET data
    $userId = $_GET['id'];

    // Prepare and execute the select query for file_request table
    $selectSql = "SELECT id, type, firstname, lastname, purpose_description, purok, tracking_number FROM file_request WHERE id = ?";
    $stmt = $conn->prepare($selectSql);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing select statement: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param('s', $userId);
    $selectResult = $stmt->execute();
    if (!$selectResult) {
        echo json_encode(['status' => 'error', 'message' => 'Error fetching user details: ' . $stmt->error]);
        exit;
    }

    // Fetch the result
    $result = $stmt->get_result();
    $userDetails = $result->fetch_assoc();

    // If no result in file_request table, try first_time_job table
    if (!$userDetails) {
        $stmt->close();

        $selectSql = "SELECT id, type, firstname, lastname, purpose_description, residency, address, tracking_number FROM first_time_job WHERE id = ?";
        $stmt = $conn->prepare($selectSql);
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => 'Error preparing select statement: ' . $conn->error]);
            exit;
        }
        $stmt->bind_param('s', $userId);
        $selectResult = $stmt->execute();
        if (!$selectResult) {
            echo json_encode(['status' => 'error', 'message' => 'Error fetching user details: ' . $stmt->error]);
            exit;
        }

        // Fetch the result
        $result = $stmt->get_result();
        $userDetails = $result->fetch_assoc();
    }

    // Close statement
    $stmt->close();

    // Return success response with user details
    echo json_encode(['status' => 'success', 'data' => $userDetails]);
}
