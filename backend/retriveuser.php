<?php
include 'config.php';
// Start the session
session_start();

// Check if the session variables are set
if (isset($_SESSION['access_token']) && isset($_SESSION['id_token']) && isset($_SESSION['expires_in'])) {
    // Retrieve user information from session
    $accessToken = $_SESSION['access_token'];
    $idToken = $_SESSION['id_token'];
    $expiresIn = $_SESSION['expires_in'];

    // You can also decode the ID token to retrieve user details (if you want)
    $userData = null;
    if ($idToken) {
        // Decode the JWT (ID token) to get user information
        $payload = explode('.', $idToken)[1]; // Get the payload part of the JWT
        $decodedPayload = json_decode(base64_decode($payload), true); // Decode and convert JSON to an associative array

        $userData = $decodedPayload; // Contains user attributes
    }

    // Use the information as needed
    // echo "Access Token: " . $accessToken . "<br>";
    // echo "ID Token: " . $idToken . "<br>";
    // echo "Expires In: " . $expiresIn . " seconds<br>";
    
    // Print user information
    // if ($userData) {
    //     echo "<pre>User Information: ";
    //     print_r($userData);
    //     echo "</pre>";
    // }
    echo json_encode(["userdata" => $userData, "status" => 200]);
} else {
    echo json_encode(["userdata" => "No user information found in the session.", "status" => 200]);
}
?>
