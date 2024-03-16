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

    // Retrieve date and time from the nested aeon-datepicker
    $pickup_date = $_POST['datepicker'];
    $pickup_time = $_POST['timepicker'];

    // Combine date and time into a single datetime string in the correct format
    $pickup_datetime = date('Y-m-d h:i A', strtotime("$pickup_date $pickup_time"));

    $purpose_description = $_POST['purpose'];
    $voters_id_number = $_POST['voteId'];

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
        $newImageName = 'VotersID_' . $lastname . '_' . $firstname . '.' . $imageExtension;
        $targetDirectory = "../Uploaded File/";
        $targetFile = $targetDirectory . basename($newImageName);
        move_uploaded_file($fileTmpName, $targetFile);
    }

    // Define the certificate type
    $certificate_type = "Certificate of Residency";

    // Generate a unique tracking number
    $tracking_number = uniqid();

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO file_request (tracking_number, firstname, lastname, contact_number, pickup_datetime, purpose_description, voters_id_image, voters_id_number, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssssssss", $tracking_number, $firstname, $lastname, $contact_number, $pickup_datetime, $purpose_description, $targetFile, $voters_id_number, $certificate_type);

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
