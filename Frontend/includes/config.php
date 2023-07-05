<?php
    // Database parameter
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "krautundrueben";

    $debugging = True;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $default_page = 'main'
?>
