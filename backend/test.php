<?php
include 'config.php';
// session_start();

# Reserve
# ต้องข้อมูล name, lat, long, distance
// if (isset($_SESSION['access_token'])){
//     # เชื่อม Database
//     # INSERT
// }

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $content = file_get_contents('php://input');
    $data = json_decode($content);
    echo $content;
    echo $data->email;
    // $arr = ["email" => $_POST["email"], "password" => $_POST["password"]];
    // echo json_encode($arr);
}

?>