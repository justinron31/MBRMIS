<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Fetch user information including the staff_role column
    $fetchUserInfoSql = "SELECT firstname, lastname, staff_role FROM staff WHERE idnumber = ?";
    
    // Use prepared statement for better security
    $stmt = $conn->prepare($fetchUserInfoSql);
    $stmt->bind_param('s', $userId);
    $userInfoResult = $stmt->execute();

    if ($userInfoResult) {
        $result = $stmt->get_result();
        $userInfo = $result->fetch_assoc();

        // Return the user's first name, last name, and staff_role as JSON
        echo json_encode(['firstName' => $userInfo['firstname'], 'lastName' => $userInfo['lastname'], 'staffRole' => $userInfo['staff_role']]);
    } else {
        echo json_encode(['error' => 'Error fetching user information: ' . $conn->error]);
    }

    $stmt->close();
}

$conn->close();