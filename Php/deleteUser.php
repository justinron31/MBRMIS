<?php
    // Include your database connection file here
    include 'db.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM staff WHERE idnumber = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            echo 1;
        } else {
            echo 0;
        }

        $stmt->close();
        $conn->close();
    }