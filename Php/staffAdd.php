<?php
session_start(); // Start the session

include 'db.php';

// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function dataExists($conn, $idnum)
{
    $checkQuery = $conn->prepare("SELECT idnumber FROM staff_information WHERE idnumber = ?");
    $checkQuery->bind_param("s", $idnum);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();
    if ($checkResult->num_rows > 0) {
        $_SESSION['exists'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    }
    return $checkResult->num_rows > 0;
}

function logUserActivity($conn, $action)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Staff Information';

    $sql = "INSERT INTO UserActivity (StaffID, FirstName, LastName, Role, Action, ActionDate,type) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type);

    if (!$stmt->execute()) {
        error_log("Error logging user activity: " . $stmt->error);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $idnum = $_POST['idnum'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    if (dataExists($conn, $idnum)) {
        $_SESSION['error_exists'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    }

    // Prepare the SQL query
    $sql = "INSERT INTO staff_information (idnumber, first_name, last_name, dateCreated) VALUES (?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error: Unable to prepare statement: $sql " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sss", $idnum, $fname, $lname);

    // Execute the statement
    if ($stmt->execute()) {
        logUserActivity($conn, "Added staff information");
        $_SESSION['success_delete'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    } else {
        $_SESSION['error_delete'] = true;
        header('Location: ../Dashboard/staff.php');
        exit;
    }
}
$stmt->close();
// Close the connection
$conn->close();