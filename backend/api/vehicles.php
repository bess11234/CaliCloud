<?php
include '../config.php';
include '../database.php';

$input = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    $result = $conn->query("SELECT name, initial_price, add_price, capacity, image_url FROM vehicles");
    $result->setFetchMode(PDO::FETCH_ASSOC);

    header("HTTP/1.1 200 OK");
    echo json_encode($result->fetchAll());
}
// if ($_SERVER['REQUEST_METHOD'] == "POST"){
//     $name = isset($input['name']) ? $input['name'] : null;
    
//     if ($name) {
//         $result = $conn->query("INSERT INTO test (name) VALUES ('$name')");
//         if ($result){
//             header("HTTP/1.1 201 Created");
//             echo json_encode(['status' => "Successfully inserted test data"]);
//         }else{
//             header("HTTP/1.1 500 Internal Server Error");
//             echo json_encode(['status' => "Failed to insert test data"]);
//         }
//     }else{
//         header("HTTP/1.1 400 Bad Request");
//         echo json_encode(['status' => "'name' parameter is missing"]);
//     }

// }
// if ($_SERVER['REQUEST_METHOD'] == "PUT"){
//     $name = isset($input['name']) ? $input['name'] : null;
//     $new_name = isset($input['new_name']) ? $input['new_name'] : null;

//     if ($name && $new_name) {
//         $result = $conn->query("UPDATE test SET name='$new_name' WHERE name='$name'");
//         if ($result) {
//             header("HTTP/1.1 200 OK");
//             echo json_encode(['status' => "Successfully deleted test data"]);
//         } else {
//             header("HTTP/1.1 500 Internal Server Error");
//             echo json_encode(['status' => "Failed to delete test data"]);
//         }
//     } else {
//         header("HTTP/1.1 400 Bad Request");
//         echo json_encode(['status' => "'name' or 'new_name' parameter is missing"]);
//     }

// }
// if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
//     $name = isset($input['name']) ? $input['name'] : null;

//     if ($name) {
//         $result = $conn->query("DELETE FROM test WHERE name='$name'");
//         if ($result) {
//             header("HTTP/1.1 200 OK");
//             echo json_encode(['status' => "Successfully deleted test data"]);
//         } else {
//             header("HTTP/1.1 500 Internal Server Error");
//             echo json_encode(['status' => "Failed to delete test data"]);
//         }
//     } else {
//         header("HTTP/1.1 400 Bad Request");
//         echo json_encode(['status' => "'name' parameter is missing"]);
//     }
// }
?>