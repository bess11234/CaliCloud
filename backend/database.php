<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->load();
$dotenv->required([
    'HOST_DATABASE',
    'USERNAME_DATABASE',
    'PASSWORD_DATABASE',
])->notEmpty();

$host = $_ENV["HOST_DATABASE"];
$username = $_ENV["USERNAME_DATABASE"];
$password = $_ENV["PASSWORD_DATABASE"];
$database = "calicloud";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>