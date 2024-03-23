<?php

// Database connection code here
session_start();
include '../Php/db.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user id from the session or hidden input field
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id']; // or $_POST['user_id']
    }

    // Get the new password from the form
    $newPassword = $_POST['Password'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    try {
        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE staff SET pass = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
