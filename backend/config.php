<?php
// Allow from any origin (update to specific domain if possible)
header("Access-Control-Allow-Origin: http://localhost:3000"); // Replace with your actual frontend URL

// Allow the necessary methods
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Allow specific headers, including Content-Type
header("Access-Control-Allow-Headers: Content-Type, Authorization");

define('AWS_REGION', 'us-east-1');
define('USER_POOL_ID', 'us-east-1_IJfiebLkV');
define('CLIENT_ID', '7uvm35k22tckpfkhbq46b7jkut');
?>