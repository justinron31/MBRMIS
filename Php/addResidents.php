<?php

include 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $BHS = $_POST['BHS'];
    $Purok = $_POST['Purok'];
    $Household = $_POST['Household'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Maiden = $_POST['Maiden'];
    $Age = $_POST['Age'];
    $Gender = $_POST['Gender'];
    $VotersID = $_POST['VotersID'];
    $NHTS = $_POST['NHTS'];
    $HH = $_POST['HH'];
    $IP = $_POST['IP'];


    $VotersID = $_POST['VotersID'];
    $voterstatus = (!empty($VotersID)) ? 'voter' : 'non-voter';

    if (isset($_POST['Category'])) {
        $Category = $_POST['Category'];
    }


    if (isset($_FILES['avatar'])) {
        $avatar = $_FILES['avatar'];

        $fileName = $avatar['name'];
        $fileSize = $avatar['size'];
        $fileTmpName = $avatar['tmp_name'];
        $validImageExtensions = array('jpg', 'jpeg', 'png');
        $fileParts = explode('.', $fileName);
        $imageExtension = strtolower(end($fileParts));

        if (!in_array($imageExtension, $validImageExtensions)) {
            $_SESSION['invalid_image'] = true;
            header("Location: ../Dashboard/ResidentsRecord.php");
        } else if ($fileSize > 2000000) { // 2MB
            $_SESSION['invalid_size'] = true;
            header("Location: ../Dashboard/ResidentsRecord.php");
        } else {
            $date = date('Y-m-d'); // get current date
            $newImageName = 'RVotersID_' . $Lastname . '_' . $Firstname . '_' . $date . '.' . $imageExtension;
            $targetDirectory = "../ResidentsID/";
            $targetFile = $targetDirectory . basename($newImageName);
            move_uploaded_file($fileTmpName, $targetFile);
        }
    }

    // SQL query to insert data into the residentrecord table
    $sql = "INSERT INTO residentrecord (rVotersID, rvoterstatus, rBHS, rPurokSitioSubdivision, rHouseholdNumber, rLastName, rFirstName, rAge, rGender, rMothersMaidenName, rNHTSHousehold, rIP, rCategory, rHHHeadPhilHealthMember, voters_id_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $VotersID, $voterstatus, $BHS, $Purok, $Household, $Lastname, $Firstname, $Age, $Gender, $Maiden, $NHTS, $IP, $Category, $HH, $targetFile);

    // Execute the query and get the ID of the inserted record
    if ($stmt->execute()) {
        $resident_id = $conn->insert_id;
    } else {
        $_SESSION['invalid_insert'] = true;
        header("Location: ../Dashboard/ResidentsRecord.php");
        exit();
    }


    $mLastname = $_POST['mLastname'];
    $mFirstname = $_POST['mFirstname'];
    $mMaiden = $_POST['mMaiden'];
    $mRelationship = $_POST['mRelationship'];
    $mGender = $_POST['mGender'];
    $mQuarter = $_POST['mQuarter'] ?? '';
    $mAge = $_POST['mAge'];
    $mRisk = $_POST['mRisk'];
    // SQL query to insert data into the familymember table
    $sql = "INSERT INTO familymember (resident_id, mLastName, mFirstName, mMothersMaidenName, mRelationship, mSex, mAge, mClassificationByAgeHealthRisk, mQuarter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $resident_id, $mLastname, $mFirstname, $mMaiden, $mRelationship, $mGender, $mAge, $mRisk, $mQuarter);

    if ($stmt->execute()) {
        $_SESSION['success_insert'] = true;
        header("Location: ../Dashboard/ResidentsRecord.php");
    } else {
        $_SESSION['invalid_insert'] = true;
        header("Location: ../Dashboard/ResidentsRecord.php");
    }
}


$memberCount = $_POST['memberCount'];

for ($i = 1; $i <= $memberCount; $i++) {
    $mLastname1 = $_POST['mLastname' . $i];
    $mFirstname1 = $_POST['mFirstname' . $i];
    $mMaiden1 = $_POST['mMaiden' . $i];
    $mRelationship1 = $_POST['mRelationship' . $i];
    $mGender1 = $_POST['mGender' . $i];
    $mQuarter1 = $_POST['mQuarter' . $i] ?? '';
    $mAge1 = $_POST['mAge' . $i];
    $mRisk1 = $_POST['mRisk' . $i];

    // SQL query to insert data into the familymember table
    $sql = "INSERT INTO familymember (resident_id, mLastName, mFirstName, mMothersMaidenName, mRelationship, mSex, mAge, mClassificationByAgeHealthRisk, mQuarter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $resident_id, $mLastname1, $mFirstname1, $mMaiden1, $mRelationship1, $mGender1, $mAge1, $mRisk1, $mQuarter1);

    if ($stmt->execute()) {
        $_SESSION['success_insert'] = true;
        header("Location: ../Dashboard/ResidentsRecord.php");
    } else {
        $_SESSION['invalid_insert'] = true;
        header("Location: ../Dashboard/ResidentsRecord.php");
    }
}
$conn->close();
