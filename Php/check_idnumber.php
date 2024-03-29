<?php
include 'db.php';

$idnum = $_GET['idnum'];

// Prepare a SQL query to check if the ID number already exists in the database
$stmt = $pdo->prepare("SELECT * FROM staff_information WHERE idnum = :idnum");
$stmt->execute(['idnum' => $idnum]);

// If the ID number is found in the database, return "taken"
if ($stmt->fetch()) {
    echo "taken";
} else {
    echo "available";
}
