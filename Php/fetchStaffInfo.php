<?php

include 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idnumber = $_GET['idnumber'];

    $sql = "SELECT idnumber, first_name, last_name FROM staff_information WHERE idnumber = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $idnumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'No user found with the provided ID.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Error preparing the SQL statement: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}

$conn->close();