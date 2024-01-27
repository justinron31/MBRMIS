<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Fetch user information
    $fetchUserInfoSql = "SELECT firstname, lastname FROM staff WHERE idnumber = '$userId'";
    $userInfoResult = $conn->query($fetchUserInfoSql);

    if ($userInfoResult) {
        $userInfo = $userInfoResult->fetch_assoc();

        // Return the user's first name and last name as JSON
        echo json_encode(['firstName' => $userInfo['firstname'], 'lastName' => $userInfo['lastname']]);
    } else {
        echo json_encode(['error' => 'Error fetching user information']);
    }
}

$conn->close();
