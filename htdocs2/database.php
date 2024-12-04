<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Return the mysqli object for use in other scripts
return $mysqli;
?>
