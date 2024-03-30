<?php
include 'db.php';
// Check if the ID was sent
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Prepare a SQL statement
    $stmt = $conn->prepare("SELECT residentrecord.*, familymember.* FROM residentrecord LEFT JOIN familymember ON residentrecord.id = familymember.resident_id WHERE residentrecord.id = ?");
    $stmt->bind_param("i", $id);
    // Execute the statement
    $stmt->execute();
    // Get the result
    $result = $stmt->get_result();

    // Fetch the data
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return the data as a JSON object
    if (!empty($data)) {
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No data found for the provided ID']);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['error' => 'No ID provided']);
}
// Close the connection
$conn->close();
