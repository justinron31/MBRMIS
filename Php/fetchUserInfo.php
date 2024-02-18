<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Fetch user information including the staff_role, last_login_timestamp, and dateCreated columns
    $fetchUserInfoSql = "SELECT firstname, lastname, staff_role, last_login_timestamp, dateCreated FROM staff WHERE idnumber = ?";

    // Use prepared statement for better security
    $stmt = $conn->prepare($fetchUserInfoSql);
    $stmt->bind_param('s', $userId);
    $userInfoResult = $stmt->execute();

    if ($userInfoResult) {
        $result = $stmt->get_result();
        $userInfo = $result->fetch_assoc();

        // Return the user's first name, last name, staff_role, last_login_timestamp, and dateCreated as JSON
        echo json_encode(['firstName' => $userInfo['firstname'], 'lastName' => $userInfo['lastname'], 'staffRole' => $userInfo['staff_role'], 'lastLoginTimestamp' => $userInfo['last_login_timestamp'], 'dateCreated' => $userInfo['dateCreated']]);
    } else {
        echo json_encode(['error' => 'Error fetching user information: ' . $conn->error]);
    }

    $stmt->close();
}

$conn->close();