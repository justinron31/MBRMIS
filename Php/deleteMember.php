<?php
include 'db.php';

session_start();
// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');


// Step 2: Retrieve member ID from POST request
if (isset($_POST['memberId'])) {
    $memberId = $_POST['memberId'];

    // Step 3: Fetch first name and last name of the member
    $sql = "SELECT mFirstName, mLastName FROM familymember WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $memberId);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->store_result();
    $stmt->bind_result($mfirstName, $mlastName);
    $stmt->fetch();
    $stmt->close();

    // Step 4: Construct and execute DELETE SQL query
    $sql = "DELETE FROM familymember WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $memberId); // "i" for integer type
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();

    // Logging user activity
    logUserActivity($conn, 'Deleted a Household Member', $mfirstName, $mlastName);
    $_SESSION['success_deletemember'] = true;
    header("refresh:3;url=../Dashboard/ResidentsRecord.php");
    exit();
} else {
    // Invalid request
    $_SESSION['error_message'] = "Invalid request";
    header("Location: ../Dashboard/ResidentsRecord.php");
}

// Close connection
$conn->close();
function logUserActivity($conn, $action, $mfirstName, $mlastName)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Household Record';

    $sql = "INSERT INTO useractivity (StaffID, FirstName, LastName, Role, Action, ActionDate, type, ResidentFirstName, ResidentLastName) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $mfirstName, $mlastName);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();
}
