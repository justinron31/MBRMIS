<?php
session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $contact_number = $_POST['contNum'];
    $birthdate = $_POST['Bdatepicker'];
    $age = $_POST['age'];
    $gender = $_POST['bussSelect'];
    $civil_status = $_POST['bussSelect1'];
    $address = $_POST['add'];
    $residency = $_POST['stay'];
    $education = $_POST['edu'];
    $course = $_POST['course'];
    $job_start_beneficiary = $_POST['jobStartBeneficiary'];
    $purpose_description = $_POST['purpose'];

    // Retrieve date and time from the nested aeon-datepicker
    $pickup_date = $_POST['datepicker'];
    $pickup_time = $_POST['timepicker'];

    // Combine date and time into a single datetime string in the correct format
    $pickup_datetime = date('Y-m-d h:i A', strtotime("$pickup_date $pickup_time"));

    // Generate a unique tracking number
    $tracking_number = uniqid();

    $id_number = $_POST['idNum'];

    $certificate_type = "First Time Job Seeker";

    // File upload logic
    $file = $_FILES['avatar'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileTmpName = $file['tmp_name'];
    $validImageExtensions = array('jpg', 'jpeg', 'png');
    $fileParts = explode('.', $fileName);
    $imageExtension = strtolower(end($fileParts));

    if (!in_array($imageExtension, $validImageExtensions)) {
        echo "<script> alert('Invalid Image Extension'); </script>";
        exit();
    } else if ($fileSize > 2000000) { // 2MB
        echo "<script> alert('Image Size Is Too Large'); </script>";
        exit();
    } else {
        $date = date('Y-m-d'); // get current date
        $newImageName = 'VotersID_' . $lastname . '_' . $firstname . '_' . $date . '.' . $imageExtension;
        $targetDirectory = "../Uploaded File/";
        $targetFile = $targetDirectory . basename($newImageName);
        move_uploaded_file($fileTmpName, $targetFile);
    }


    $stmt = $conn->prepare("INSERT INTO first_time_job ( purpose_description ,type, firstname, lastname, birthdate, age, gender, contact_number, civil_status, address, residency, education, course, job_start_beneficiary, pickup_datetime, id_number, avatar, tracking_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssissssssssssss", $purpose_description, $certificate_type, $firstname, $lastname, $birthdate, $age, $gender, $contact_number, $civil_status, $address, $residency, $education, $course, $job_start_beneficiary, $pickup_datetime, $id_number, $targetFile, $tracking_number);

    if ($stmt->execute()) {
        // Store tracking number in session
        $_SESSION['tracking_number'] = $tracking_number;

        echo "<script type='text/javascript'>
        alert('Record submitted successfully');
        window.location.href = '/MBRMIS/Website/confirmTrack.html';
        </script>";
        echo "<script type='text/javascript'>
        window.onbeforeunload = function() {
            for(let i=0; i<document.forms.length; i++) {
                document.forms[i].reset();
            }
        }
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
