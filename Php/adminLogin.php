<?php
// Include the database connection
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password (use password_hash for better security)
    $hashedPassword = md5($password);

    // SQL query to check user credentials
    $sql = "SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        header("Location: /MBRMIS/Dashboard/AdminDashboard.html"); // Redirect to index.html on successful login
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}

// Close the database connection
$conn->close();
