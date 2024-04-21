<?php
session_start();
include 'db.php';

// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $contact_number = $_POST['contNum'];
    $purok = $_POST['purok'];


    // Retrieve date and time from the nested aeon-datepicker
    $pickup_date = $_POST['datepicker'];
    $pickup_time = $_POST['timepicker'];

    // Combine date and time into a single datetime string in the correct format
    $pickup_datetime = date('Y-m-d h:i A', strtotime("$pickup_date $pickup_time"));

    $purpose_description = $_POST['purpose'];

    $voters_id_number = $_POST['voteId'];

    // Retrieve the most recent record for this voter ID
    $stmt = $conn->prepare("SELECT datetime_created FROM file_request WHERE voters_id_number = ? ORDER BY datetime_created DESC LIMIT 1");
    $stmt->bind_param("s", $voters_id_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if a record was found and if it was created within the last 60 seconds
    if ($row && strtotime($row['datetime_created']) > strtotime('-1 hours')) {
        echo "<script type='text/javascript'>
    alert('You must wait 1 hours between submissions.');
    window.location.href = '../Website/homepage.html';
    </script>";
        exit();
    }




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
        $newImageName = 'ValidID_' . $lastname . '_' . $firstname . '_' . $date . '.' . $imageExtension;
        $targetDirectory = "../Uploaded File/";
        $targetFile = $targetDirectory . basename($newImageName);
        move_uploaded_file($fileTmpName, $targetFile);
    }

    // Define the certificate type
    $certificate_type = "Certificate of Indigency";

    // Generate a unique tracking number
    $tracking_number = uniqid();

    // Get current date and time for datetime_created
    $datetime_created = date('Y-m-d H:i:s');

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO file_request (purok, tracking_number, firstname, lastname, contact_number, pickup_datetime, purpose_description, voters_id_image, voters_id_number, type, datetime_created) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssssssssss", $purok, $tracking_number, $firstname, $lastname, $contact_number, $pickup_datetime, $purpose_description, $targetFile, $voters_id_number, $certificate_type, $datetime_created);

    if ($stmt->execute()) {
        // Store tracking number in session
        $_SESSION['tracking_number'] = $tracking_number;

        echo "<script type='text/javascript'>
        alert('Record submitted successfully');
        window.location.href = '../Website/confirmTrack.php';
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
