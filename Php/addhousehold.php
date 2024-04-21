<?php

include 'db.php'; // Include database connection file

// Start session
session_start();
// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');
// Include the logUserActivity function
function logUserActivity($conn, $action, $addmFirstname, $addmLastname)
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
    $stmt->bind_param("sssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $addmFirstname, $addmLastname);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $addmLastname = $_POST["addmLastname"];
    $addmFirstname = $_POST["addmFirstname"];
    $addmMaiden = $_POST["addmMaiden"];
    $addmRelationship = $_POST["addmRelationship"];
    $addmGender = $_POST["addmGender"];
    $addmAge = $_POST["addmAge"];
    $addmRisk = $_POST["addmRisk"];
    $addmQuarter = $_POST["addmQuarter"];

    // Check if selectedRowId is sent in the form data
    if (isset($_POST["selectedRowId"])) {
        $selectedRowId = $_POST["selectedRowId"];
    }

    // Prepare SQL statement with parameterized query to prevent SQL injection
    $sql = "INSERT INTO familymember (resident_id, mLastName, mFirstName, mMothersMaidenName, mRelationship, mSex, mAge, mClassificationByAgeHealthRisk, mQuarter)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("isssssiss", $selectedRowId, $addmLastname, $addmFirstname, $addmMaiden, $addmRelationship, $addmGender, $addmAge, $addmRisk, $addmQuarter);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Log user activity
        logUserActivity($conn, 'Added a Household Member', $addmFirstname, $addmLastname);

        // Set session variable to indicate success
        $_SESSION['success_household'] = true;
        header("refresh:3;url=../Dashboard/ResidentsRecord.php");
        exit();
    } else {
        // Set session variable to indicate error
        $_SESSION['error_household'] = true;
        header("Location: ../Dashboard/ResidentsRecord.php");
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
