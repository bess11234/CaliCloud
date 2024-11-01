<?php
include 'config.php';
session_start();
$csrf_token = ["csrf_token" => $_SESSION['csrf_token'], "status" => 200];
echo json_encode($csrf_token, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>