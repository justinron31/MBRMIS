<?php

include 'db.php';
session_start();
// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');
$response = [];

function logUserActivity($conn, $action, $residentFirstName, $residentLastName)
{
    // Assuming you store user data in session after they log in
    $staffId = $_SESSION['idnumber'];
    $firstName = $_SESSION['user_name'];
    $lastName = $_SESSION['lastname'];
    $role = $_SESSION['user_type'];
    $actionDate = date('Y-m-d H:i:s');
    $type = 'Resident Record';

    $sql = "INSERT INTO useractivity (StaffID, FirstName, LastName, Role, Action, ActionDate, type,ResidentFirstName,ResidentLastName) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $staffId, $firstName, $lastName, $role, $action, $actionDate, $type, $residentFirstName, $residentLastName);
    $stmt->execute();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Decode the JSON data
    $_POST = json_decode(file_get_contents('php://input'), true);

    // Check if rVotersID is empty, None, none, or N/A
    if (empty($_POST['rVotersID']) || strtolower($_POST['rVotersID']) == 'none' || strtolower($_POST['rVotersID']) == 'n/a') {
        $rVoterStatus = "Non-voter";
        $_POST['rVotersID'] = "None";
    } else {
        $rVoterStatus = "Voter";
    }

    // Check if rHHHeadPhilHealthMember is empty, None, none, or N/A
    if (empty($_POST['rHHHeadPhilHealthMember']) || strtolower($_POST['rHHHeadPhilHealthMember']) == 'none' || strtolower($_POST['rHHHeadPhilHealthMember']) == 'n/a') {
        $_POST['rHHHeadPhilHealthMember'] = "No";
    }

    // Check if rCategory is empty
    if (empty($_POST['rCategory'])) {
        $_POST['rCategory'] = "None";
    }

    // Get the form data for residentsrecord
    $sql = "UPDATE residentrecord SET rVotersID = ?, rVoterStatus = ?, rBHS = ?, rPurokSitioSubdivision = ?, rHouseholdNumber = ?, rLastName = ?, rFirstName = ?, rAge = ?, rGender = ?, rMothersMaidenName = ?, rNHTSHousehold = ?, rIP = ?, rCategory = ?, rHHHeadPhilHealthMember = ?, dateUpdated = ? WHERE id = ?";
    $dateUpdated = date('Y-m-d H:i:s');

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssss", $_POST['rVotersID'], $rVoterStatus, $_POST['rBHS'], $_POST['rPurokSitioSubdivision'], $_POST['rHouseholdNumber'], $_POST['rLastName'], $_POST['rFirstName'], $_POST['rAge'], $_POST['rGender'], $_POST['rMothersMaidenName'], $_POST['rNHTSHousehold'], $_POST['rIP'], $_POST['rCategory'], $_POST['rHHHeadPhilHealthMember'], $dateUpdated, $_POST['id']);
    $stmt->execute();

    if ($stmt->error) {
        $response[] = ['error' => $stmt->error];
    } else if ($stmt->execute() === TRUE) {
        $response[] = ['success' => "Record updated successfully for resident: "];
        $residentFirstName = $_POST['rFirstName'];
        $residentLastName = $_POST['rLastName'];
        logUserActivity($conn, 'Update/Edit', $residentFirstName, $residentLastName);
    } else {
        $response[] = ['message' => "No records were updated in residentrecord."];
    }

    $stmt->close();

    $sql = "UPDATE familymember SET mLastName = ?, mFirstName = ?, mMothersMaidenName = ?, mRelationship = ?, mSex = ?, mAge = ?, mClassificationByAgeHealthRisk = ?, mQuarter = ?, dateUpdated = ? WHERE id = ?";
    $dateUpdated = date('Y-m-d H:i:s');

    $stmt = $conn->prepare($sql);

    if (isset($_POST['members']) && !empty($_POST['members'])) {
        // Loop through each member in the members array
        foreach ($_POST['members'] as $member) {
            $stmt->bind_param("sssssssssi", $member['mLastName'], $member['mFirstName'], $member['mMothersMaidenName'], $member['mRelationship'], $member['mGender'], $member['mAge'], $member['mClassificationByAgeHealthRisk'], $member['mQuarter'],  $dateUpdated, $member['mId']);
            $stmt->execute();

            if ($stmt->error) {
                $response[] = ['error' => $stmt->error];
            } else if ($stmt->affected_rows > 0) {
                $response[] = ['success' => "Record updated successfully for household member: "];
            } else {
                $response[] = ['message' => "No records were updated in household member."];
            }
        }
    } else {
        $response[] = "No members data found.";
    }

    $stmt->close();

    // Close connection
    $conn->close();

    echo json_encode($response);
}
