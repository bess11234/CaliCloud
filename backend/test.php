<?php
include 'config.php';
session_start();

# Reserve
# ต้องข้อมูล name, lat, long, distance
// if (isset($_SESSION['access_token'])){
//     # เชื่อม Database
//     # INSERT
// }

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    $_SESSION['token'] = $_GET['access_token'];
}

header("location: index.html?access_token{$_GET['access_token']}")
?>