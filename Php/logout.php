<?php

include 'db.php';
session_start();
$user_id = $_SESSION['user_id']; 


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Update is_logged_in to 0
$updateLogoutStatus = $conn->prepare("UPDATE staff SET is_logged_in = 0 WHERE id = ?");
$updateLogoutStatus->bind_param("i", $user_id);
$updateLogoutStatus->execute();

session_destroy();
echo json_encode(['success' => true]);