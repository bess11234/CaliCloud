<?php
// การตั้งค่า PDO
// $host = 'localhost';
// $dbname = 'your_database';
// $username = 'your_username';
// $password = 'your_password';

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// รับข้อมูลจากฟอร์ม
$marker1_lat = $_POST['marker1_lat'];
$marker1_lon = $_POST['marker1_lon'];

$marker2_lat = $_POST['marker2_lat'];
$marker2_lon = $_POST['marker2_lon'];

$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];

$distance = $_POST['distance'];
$totalPrice = $_POST['total_price'];

$userId = 1; // ตัวอย่างการกำหนดค่า user_id
$vehicleId = 1; // ตัวอย่างการกำหนดค่า vehicle_id

// ปริ้นค่าต่าง ๆ
echo "Marker 1 Latitude: " . $marker1_lat . "<br>";
echo "Marker 1 Longitude: " . $marker1_lon . "<br>";
echo "Marker 2 Latitude: " . $marker2_lat . "<br>";
echo "Marker 2 Longitude: " . $marker2_lon . "<br>";
echo "Pickup Date: " . $pickup_date . "<br>";
echo "Pickup Time: " . $pickup_time . "<br>";
echo "Distance: " . $distance . "<br>";
echo "Total Price: " . $totalPrice . "<br>";
echo "User ID: " . $userId . "<br>";
echo "Vehicle ID: " . $vehicleId . "<br>";

// สร้างข้อมูลการจอง
//     $stmt = $pdo->prepare("INSERT INTO ReserveServices (user_id, vehicle_id, total_price) VALUES (?, ?, ?)");
//     $stmt->execute([$userId, $vehicleId, $totalPrice]);

//     echo "บันทึกข้อมูลสำเร็จ";
// } catch (PDOException $e) {
//     echo "เกิดข้อผิดพลาด: " . $e->getMessage();
// }
