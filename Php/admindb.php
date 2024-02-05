<?php
include 'C:\xampp\htdocs\MBRMIS\Php\db.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user ID from the session variable
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Check if the user ID is set before using it
if ($user_id !== null) {
    // SQL query to retrieve the required data from the 'admin' table for the logged-in user
    $sql = "SELECT username, firstname, lastname FROM admin WHERE id = $user_id";

    // Execute the query and store the result set
    $result = $conn->query($sql);

    // Check if there are any rows in the result set
    if ($result->num_rows > 0) {
        // Output the data of the logged-in user
    } else {
        echo "0 results";
    }
} else {
    echo "User ID not set in the session.";
}

// Close the database connection
$conn->close();