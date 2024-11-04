<?php
include '../config.php';
include '../database.php';
session_start();

$input = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $result = $conn->query("SELECT * FROM reserveservices FROM user WHERE token='{$_SESSION['token']}'");
    $result->setFetchMode(PDO::FETCH_ASSOC);

    header("HTTP/1.1 200 OK");
    echo json_encode($result->fetchAll());
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $result = $conn->query("SELECT id FROM user WHERE token='{$_SESSION['token']}'");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result = $result->fetchObject();
    $user_id = $result->id;
    echo $_SESSION['token'];
    // $user_id = isset($input['user_id']) ? $input['user_id'] : null;
    // $user_id = 1;

    $vehicleID = isset($input['vehicle_id']) ? $input['vehicle_id'] : null;
    $result = $conn->query("SELECT name, initial_price, add_price FROM vehicles WHERE id=$vehicleID");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $vehicle = $result->fetchObject();

    $marker1_lat = isset($input['marker1_lat']) ? $input['marker1_lat'] : null;
    $marker1_lon = isset($input['marker1_lon']) ? $input['marker1_lon'] : null;
    $marker2_lat = isset($input['marker2_lat']) ? $input['marker2_lat'] : null;
    $marker2_lon = isset($input['marker2_lon']) ? $input['marker2_lon'] : null;
    $distance = isset($input['distance']) ? $input['distance'] : null;
    $pickup_date = isset($input['pickup_date']) ? $input['pickup_date'] : null;
    $pickup_time = isset($input['pickup_time']) ? $input['pickup_time'] : null;
    $options = isset($input['option']) ? $input['option'] : null;
    $pay = isset($input['pay']) ? $input['pay'] : null;

    $total_price = $vehicle->initial_price;
    $total_price += $vehicle->add_price * $distance;

    $options = json_encode($options);
    $options = str_replace("[", "(", $options);
    $options = str_replace("]", ")", $options);
    $result = $conn->query("SELECT SUM(price) AS sum_price FROM serviceoptions WHERE id in $options");

    $total_price += $result->fetchObject()->sum_price;

    //echo $user_id ." 1 ". $vehicleID ." 2 ". $marker1_lat ." 3 ". $marker1_lon ." 4 ". $marker2_lat ." 5 ". $marker2_lon ." 6 ". $distance ." 7 ". $pickup_date ." 8 ". $pickup_time ." 9 ". $options ." 10 ". $pay ." 11 ". $total_price ;

    if ($user_id && $vehicleID && $marker1_lat && $marker1_lon && $marker2_lat && $marker2_lon && $distance && $pickup_date && $pickup_time && $options && $pay && $total_price) {
        $result = $conn->query("INSERT INTO reserveservices (user_id, vehicle_id, pickup_location_lat, pickup_location_lon, dropoff_location_lat, dropoff_location_lon, distance, total_price, payment_method, transport_status, pickup_date, pickup_time) VALUES 
        ($user_id, $vehicleID, $marker1_lat, $marker1_lon, $marker2_lat, $marker2_lon, $distance, $total_price, '$pay', 'WAITING', '$pickup_date', '$pickup_time')");

        if ($result) {
            header("HTTP/1.1 200 OK");
            echo json_encode(['status' => "Successfully inserted reservation data"]);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(['status' => "Failed to insert reservation data"]);
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['status' => "Parameter is missing"]);
    }
}
if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $name = isset($input['name']) ? $input['name'] : null;
    $new_name = isset($input['new_name']) ? $input['new_name'] : null;

    if ($name && $new_name) {
        $result = $conn->query("UPDATE test SET name='$new_name' WHERE name='$name'");
        if ($result) {
            header("HTTP/1.1 200 OK");
            echo json_encode(['status' => "Successfully updated test data"]);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(['status' => "Failed to update test data"]);
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['status' => "'name' or 'new_name' parameter is missing"]);
    }
}
if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $name = isset($input['name']) ? $input['name'] : null;

    if ($name) {
        $result = $conn->query("DELETE FROM test WHERE name='$name'");
        if ($result) {
            header("HTTP/1.1 200 OK");
            echo json_encode(['status' => "Successfully deleted test data"]);
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(['status' => "Failed to delete test data"]);
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['status' => "'name' parameter is missing"]);
    }
}
