<?php

// Database connection code here
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the token from the form
    $token = $_POST['token'];

    // Get the new password from the form
    $newPassword = $_POST['password'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    try {
        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE staff SET pass = ?, reset_token = NULL, passreset_timestamp = NOW() WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashedPassword, $token);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            // Password updated successfully, show an alert and then redirect to loginstaff.php
            echo "<script>
            alert('Password updated successfully');
            window.location.href='../Login/loginstaff.php';
          </script>";
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
