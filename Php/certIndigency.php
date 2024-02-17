<?php

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

    // Handle the image upload
$target_dir = "/xampp/htdocs/MBRMIS/CertOfIndigency/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$original_filename = basename($_FILES["avatar"]["name"]);
$target_file = $target_dir . "votersID_" . str_replace(' ', '_', $original_filename);
move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);


    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO resident_indigency (firstname, lastname, contact_number, pickup_datetime, purpose_description, voters_id_image, voters_id_number) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssssss", $firstname, $lastname, $contact_number, $pickup_datetime, $purpose_description, $target_file, $voters_id_number);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
        alert('Record submitted successfully');
        window.location.href = '/MBRMIS/Website/homepage.html#service';
      </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}