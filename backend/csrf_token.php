<?php
include 'config.php';
session_start();
function csrf_token() {
    return bin2hex(random_bytes(35));
}

function create_csrf_token() {
    if (isset($_SESSION['csrf_token'])) {
        return $_SESSION['csrf_token'];
    }
    $token = csrf_token();
    $_SESSION['csrf_token'] = $token;
    $_SESSION['csrf_token_time'] = time();
    return $token;
}

function csrf_token_tag() {
    $token = create_csrf_token();
    return $token;
}

$csrf_token = ["csrf_token" => csrf_token_tag()];
echo json_encode($csrf_token, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>