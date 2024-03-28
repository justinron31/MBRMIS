<?php
include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id !== null) {
    $sql = "SELECT idnumber, firstname, lastname, email, gender, age, staff_role FROM staff WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Process the results
    } else {
        echo "0 results";
    }
} else {
    echo "User ID not set in the session.";
}

// Check if the save button is clicked
if (isset($_POST['saveButton'])) {
    // Get the updated values from the form
    $idnum = isset($_POST['idnum']) ? $_POST['idnum'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $password = isset($_POST['npass']) ? $_POST['npass'] : '';

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the data in the database
    if (!$conn->connect_error) {
        // Corrected SQL query, added a comma before pass
        $sql = "UPDATE staff SET idnumber='$idnum', email='$email', firstname='$fname', lastname='$lname', age='$age', gender='$gender', pass='$hashedPassword' WHERE id = $user_id";
        $result = $conn->query($sql);

        if ($result === true) {
            // Set a session variable
            $_SESSION['showPopup'] = true;
            echo "<script>window.location.href = 'Profile.php';</script>";
            exit;
        } else {
            echo "Error updating data: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Database connection error";
    }
}
