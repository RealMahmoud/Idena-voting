<?php
$servername = "localhost";
$username = "root";
$password = "e37a602f8a785005553974f";
$dbname = "voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>