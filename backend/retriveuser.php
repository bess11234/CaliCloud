<?php
include 'config.php';
require '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Jose\Component\Core\JWKSet;
use Jose\Component\KeyManagement\JWKFactory;
use Firebase\JWT\Key;

// Replace with your Cognito region and User Pool ID
$region = constant("AWS_REGION");
$userPoolId = constant("USER_POOL_ID");
$jwkUrl = "https://cognito-idp.$region.amazonaws.com/$userPoolId/.well-known/jwks.json";

// Fetch JWKS and create a JWKSet instance
$jwkSet = JWKFactory::createFromJKU($jwkUrl);

// Decode the JWT
$jwt = "your_jwt_token_here";

try {
    // Decode and verify JWT using the fetched JWKSet
    $decoded = JWT::decode($jwt, new Key($jwkSet->toPEM(), 'RS256'));
    print_r($decoded); // Access decoded token data
} catch (Exception $e) {
    echo "Error verifying token: " . $e->getMessage();
}
