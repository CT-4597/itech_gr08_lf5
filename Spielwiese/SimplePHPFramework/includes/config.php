<?php
// Database parameter
$servername = "localhost";
$username = "g8";
$password = "#Kennwort10!";
$dbname = "krautundrueben";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>