<?php
$servername = "localhost";
$username = "tutortui";
$password = "m*buPQf6*MM0";
$dbname = "tutor_tuition";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
