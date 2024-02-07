<?php

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require "vendor/autoload.php";

function CreateJWT($username = "defaultUser")
{
    $key = "dragon";
    $header = [
        "alg" => "HS512",
        "typ" => "JWT"
    ];

    $payload = [
        "username" => $username
    ];
    $JWT = JWT::encode($payload, $key, "HS256", null, $header);

    return $JWT;
}

function DecodeJWT($JWT)
{

    $key = "dragon";

    $decoded = JWT::decode($JWT, new Key($key,'HS256'));
    $decoded = get_object_vars($decoded);
    return $decoded;
}
