<?php
include 'config.php';

// // ตั้งค่าเชื่อมต่อฐานข้อมูล
// $servername = "your-rds-endpoint"; // เช่น your-instance-name.region.rds.amazonaws.com
// $username = "your-username";
// $password = "your-password";
// $dbname = "your-database-name";

// // เชื่อมต่อฐานข้อมูล
// $conn = new mysqli($servername, $username, $password, $dbname);

// // ตรวจสอบการเชื่อมต่อ
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// ตรวจสอบการร้องขอ POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // อ่านข้อมูล JSON ที่ส่งมาจากฟอร์ม
    $data = json_decode(file_get_contents("php://input"), true);

    // ตรวจสอบว่ามีข้อมูลที่ต้องการหรือไม่
    if ($data) {
        // ดึงค่าต่างๆ จากข้อมูล
        $pickup_date = $data['pickup_date'] ?? null;
        $pickup_time = $data['pickup_time'] ?? null;
        $marker1_lat = $data['marker1_lat'] ?? null;
        $marker1_lon = $data['marker1_lon'] ?? null;
        $marker2_lat = $data['marker2_lat'] ?? null;
        $marker2_lon = $data['marker2_lon'] ?? null;
        $distance = $data['distance'] ?? 0;
        // $total_price = $data['total_price'] ?? 0;

        // เก็บข้อมูลอื่นๆ เช่น Service Options
        $option1 = isset($data['option1']) ? true : false;
        // $option2 = isset($data['option2']) ? true : false;
        // $option3 = isset($data['option3']) ? true : false;
        

        // ตัวอย่างการประมวลผลข้อมูล (อาจจะเก็บลงฐานข้อมูลหรือส่งต่อไปยัง API อื่น)
        // ตัวอย่างการตอบกลับด้วย JSON
        $response = [
            'status' => 'success',
            'message' => 'Reservation saved successfully.',
            'data' => [
                'pickup_date' => $pickup_date,
                'pickup_time' => $pickup_time,
                'marker1_lat' => $marker1_lat,
                'marker1_lon' => $marker1_lon,
                'marker2_lat' => $marker2_lat,
                'marker2_lon' => $marker2_lon,
                'distance' => $distance,
                'total_price' => $total_price,
                'options' => [
                    'option1' => $option1,
                    'option2' => $option2,
                    'option3' => $option3,
                ]
            ]
        ];

        // // คำสั่ง SQL สำหรับการแทรกข้อมูล
        // $sql = "INSERT INTO reservations (pickup_date, pickup_time, marker1_lat, marker1_lon, marker2_lat, marker2_lon, distance, total_price, option1, option2, option3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // // เตรียม statement และ bind parameters
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("sssssssddii", $pickup_date, $pickup_time, $marker1_lat, $marker1_lon, $marker2_lat, $marker2_lon, $distance, $total_price, $option1, $option2, $option3);

        // // ตรวจสอบการบันทึกข้อมูล
        // if ($stmt->execute()) {
        //     echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
        // } else {
        //     echo json_encode(['status' => 'error', 'message' => 'Data insertion failed']);
        // }

        // // ปิด statement
        // $stmt->close();

        // ตั้งค่า Header ให้ตอบกลับเป็น JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // กรณีข้อมูลไม่ครบหรือไม่ถูกต้อง
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    // ไม่รองรับการร้องขอที่ไม่ใช่ POST
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
