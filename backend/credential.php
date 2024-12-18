<?php
# AWS Cognito (App client) OAuth 2.0 grant types need to be 'Authorization code grant'.

include 'config.php';
include 'database.php';

if (isset($_GET['code'])) {
    $authorizationCode = $_GET['code'];

    // Prepare the POST request to exchange the authorization code for tokens
    $url = "https://calicloudgooglev2.auth.us-east-1.amazoncognito.com/oauth2/token";
    $postFields = http_build_query([
        'grant_type' => 'authorization_code',
        'client_id' => constant("CLIENT_ID"),
        'client_secret' => constant("CLIENT_SECRET"),
        'code' => $authorizationCode,
        'redirect_uri' => constant("REDIRECT_URL"),
    ]);

    // Set up cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
    ]);

    // Execute the request
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response
    $data = json_decode($response, true);

    // Check if tokens are present in the response
    if (isset($data['access_token']) && isset($data['id_token']) && isset($data['expires_in'])) {
        $accessToken = $data['access_token'];
        $idToken = $data['id_token'];
        $expiresIn = $data['expires_in'];

        // Store tokens in session or database
        session_start();
        $_SESSION['access_token'] = $accessToken;
        $_SESSION['id_token'] = $idToken;
        $_SESSION['expires_in'] = $expiresIn;
        $_SESSION['token'] = explode(".", $accessToken)[2];

        // You can also decode the ID token to retrieve user details (if you want)
        $userData = null;
        if ($idToken) {
            // Decode the JWT (ID token) to get user information
            $payload = explode('.', $idToken)[1]; // Get the payload part of the JWT
            $decodedPayload = json_decode(base64_decode($payload), true); // Decode and convert JSON to an associative array

            $userData = $decodedPayload; // Contains user attributes

            $email = $userData['email'];
            
            $result = $conn->query("SELECT email FROM user WHERE email='$email'");
            if ($result->rowCount()==1){
                // CREATE user
                $conn->query("UPDATE user SET token='{$_SESSION['token']}' WHERE email='$email'");
            }else{
                // UPDATE user
                $conn->query("INSERT INTO user (email, token) VALUES ('$email', '{$_SESSION['token']}')");
            }
        }

        header("HTTP/1.1 200 OK");
        echo "Tokens received successfully!";
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "Failed to retrieve tokens.";
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Authorization code not found!";
}
header("location: /index.html");
