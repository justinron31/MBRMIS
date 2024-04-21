<?php

session_start();
include 'db.php';

// Set timezone to UTC +08:00
date_default_timezone_set('Asia/Singapore');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['id'];
    $password = $_POST['password'];

    // Check the staff database using prepared statement
    $staffQuery = $conn->prepare("SELECT id, idnumber, firstname, lastname, pass, email, account_status, staff_role, last_login_timestamp, is_logged_in, email_verify FROM staff WHERE idnumber = ?");
    $staffQuery->bind_param("s", $username);
    $staffQuery->execute();
    $staffResult = $staffQuery->get_result();

    if ($staffResult->num_rows == 1) {

        $row = $staffResult->fetch_assoc();
        $user_id = $row['id'];
        $accountStatus = $row['account_status'];
        $idnum = $row['idnumber'];
        $is_logged_in = $row['is_logged_in'];

        if ($is_logged_in) {
            $updateLogoutStatus = $conn->prepare("UPDATE staff SET is_logged_in = 0 WHERE id = ?");
            $updateLogoutStatus->bind_param("i", $user_id);
            $updateLogoutStatus->execute();
        }

        if ($accountStatus === 'Activated') {
            if (password_verify($password, $row['pass'])) {
                // Check if email is verified
                if ($row['email_verify'] == 0) {
                    header("Location: ../Login/email-verification.php?email=" . $row['email']);
                    exit();
                }

                $name = $row['firstname'];
                $lastname = $row['lastname'];
                $role = $row['staff_role'];

                $_SESSION['show_login_message'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $name;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['idnumber'] = $idnum;
                $_SESSION['last_login_timestamp'] = $row['last_login_timestamp'];

                // Set $_SESSION['user_type'] based on the role value
                $_SESSION['user_type'] = strtolower($role);

                // Update last login timestamp and set is_logged_in to 1
                $updateLoginTimestamp = $conn->prepare("UPDATE staff SET last_login_timestamp = NOW(), is_logged_in = 1 WHERE id = ?");
                $updateLoginTimestamp->bind_param("i", $user_id);
                $updateLoginTimestamp->execute();

                // Insert login activity into UserActivity table
                $insertUserActivity = $conn->prepare("INSERT INTO useractivity (StaffID, FirstName, LastName, Role, Action, ActionDate, type) VALUES (?, ?, ?, ?, 'Logged in', NOW(), ?)");
                $insertUserActivity->bind_param("issss", $user_id, $name, $lastname, $role, $type);

                // Define the type
                $type = "System";

                $insertUserActivity->execute();

                // Redirect based on user type
                if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff') {
                    header("Location: ../Dashboard/Home.php");
                } else {
                    $_SESSION['error_message'] = "Invalid role";
                    header("Location: ../Login/loginStaff.php");
                }

                exit();
            } else {
                $_SESSION['error_message'] = "Invalid Credentials.";
            }
        } else {
            $_SESSION['error_message'] = "Account Deactivated. Please contact the admin.";
        }
    } else {
        $_SESSION['error_message'] = "Invalid Credentials.";
    }

    header("Location: ../Login/loginStaff.php");
    exit();
}

$conn->close();
