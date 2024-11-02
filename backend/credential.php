<?php
# AWS Cognito (App client) OAuth 2.0 grant types need to be 'Authorization code grant'

include 'config.php';

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