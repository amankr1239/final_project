<?php
$servername = "sql309.infinityfree.com";  // Your host name
$username = "if0_39399038";               // Your database username
$password = "Aamankr1239";                // Your database password
$database = "if0_39399038_project3";      // Your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
