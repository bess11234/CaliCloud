<?php
include 'config.php';
session_start();
session_destroy();

header("HTTP/1.1 200 OK");
header("location: https://calicloudgooglev2.auth.us-east-1.amazoncognito.com/logout?client_id=7uvm35k22tckpfkhbq46b7jkut&redirect_uri=https%3A%2F%2F3.82.155.205%2Fbackend%2Ftest.php&response_type=code")
?>