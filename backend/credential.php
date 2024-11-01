<?php
include 'config.php';
require '../vendor/autoload.php';

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Exception\AwsException;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Cognito configuration
    $region = constant("AWS_REGION"); // Replace with your AWS region
    $appClientId = constant("CLIENT_ID"); // Replace with your App Client ID

    // User credentials
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Initialize the Cognito client
        $client = new CognitoIdentityProviderClient([
            'region' => $region,
            'version' => 'latest',
        ]);

        // Authenticate the user
        $result = $client->initiateAuth([
            'AuthFlow' => 'USER_PASSWORD_AUTH',
            'ClientId' => $appClientId,
            'AuthParameters' => [
                'USERNAME' => $email,
                'PASSWORD' => $password,
            ],
        ]);

        // Get tokens from the response
        $accessToken = $result['AuthenticationResult']['AccessToken'];
        $idToken = $result['AuthenticationResult']['IdToken'];
        $refreshToken = $result['AuthenticationResult']['RefreshToken'];

        echo "Access Token: " . $accessToken . PHP_EOL;
        echo "ID Token: " . $idToken . PHP_EOL;
        echo "Refresh Token: " . $refreshToken . PHP_EOL;

    } catch (AwsException $e) {
        // Catch an authentication error
        echo "Error: " . $e->getAwsErrorMessage();
    }
}
?>
