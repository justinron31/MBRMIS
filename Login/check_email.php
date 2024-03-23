<?php
// Database connection
session_start();
include '../Php/db.php';

// Get the email from the AJAX request
$email = $_POST['email'];

// Check if the email exists in the database
$sql = "SELECT * FROM staff WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header('Location: /MBRMIS/Login/createNewPassword.html');
    exit;
} else {
    echo "false";
}

$stmt->close();
$conn->close();
