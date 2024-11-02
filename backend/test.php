<?php
include 'config.php';

$host = getenv("HOST_DATABASE");
$username = getenv("USERNAME_DATABASE");
$password = getenv("PASSWORD_DATABASE");
$database = "calicloud";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>