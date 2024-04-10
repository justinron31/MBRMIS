<?php
$servername = "localhost";
$username = "u699564583_admin";
$password = "BS1t123.";
$dbname = "u699564583_MBRMIS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}