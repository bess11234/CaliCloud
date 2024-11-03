<?php
include 'config.php';
include 'database.php';

// Start the session
session_start();

// Check if the session variables are set
if (isset($_SESSION['access_token']) && isset($_SESSION['id_token']) && isset($_SESSION['expires_in']) && isset($_SESSION['token'])) {
    // Retrieve user information from session
    $accessToken = $_SESSION['access_token'];
    $idToken = $_SESSION['id_token'];
    $expiresIn = $_SESSION['expires_in'];
    $token = $_SESSION['token'];

    // You can also decode the ID token to retrieve user details (if you want)
    $userData = null;
    if ($idToken) {
        // Decode the JWT (ID token) to get user information
        $payload = explode('.', $idToken)[1]; // Get the payload part of the JWT
        $decodedPayload = json_decode(base64_decode($payload), true); // Decode and convert JSON to an associative array

        $userData = $decodedPayload; // Contains user attributes

        $email = $userData['email'];

        $result = $conn->query("SELECT token FROM user WHERE email='$email'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result = $result->fetchObject();
        
        if ($result['token'] == $_SESSION['token']){
            header("HTTP/1.1 200 OK");
            echo json_encode(["userdata" => $userData]);
        }else{
            header("HTTP/1.1 401 Unauthorized");
            header("location: signout.php");
        }
    }

} else {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["userdata" => "No user information found in the session."]);
}
?>
