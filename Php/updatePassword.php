<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePassword'])) {
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in the session

    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['pass'];

    $sql = "SELECT pass FROM staff WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $storedPasswordHash = $row['pass'];

        // Verify the entered current password against the stored hash
        if (password_verify($currentPassword, $storedPasswordHash)) {
            // Current password is correct, now update the password
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateSql = "UPDATE staff SET pass = ? WHERE id = ?";
            $updateStmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($updateStmt, "si", $newPasswordHash, $userId);

            if (mysqli_stmt_execute($updateStmt)) {
                $_SESSION['password_updated'] = true;
                // Redirect first, and then display the custom popup in AdminProfile.php
                header("Location: /MBRMIS/Dashboard/AdminProfile.php");
                exit();
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            // Incorrect current password, redirect and display the custom popup in AdminProfile.php
            $_SESSION['incorrect_password'] = true;
            header("Location: /MBRMIS/Dashboard/AdminProfile.php");
            exit();
        }
    } else {
        echo "Error fetching current password: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}