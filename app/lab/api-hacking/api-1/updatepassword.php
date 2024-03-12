<?php
// Veri gönderme işlemi için cURL kullanarak API'ye istek yapılır
function sendRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// API endpoint
//$apiUrl = "http://localhost:1337/lab/api-hacking/api-1/api.php";
include "./api.php";

// HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// User update (POST)
if ($method === 'POST') {
    $username = $_GET['username'];
    $newPassword = $_GET['newpassword'];

    // Data to be sent to the API
    $data = array(
        'username' => $username,
        'newpassword' => $newPassword
    );

    // Send request to API
    $response = sendRequest($apiUrl, $data);

    // Print the response from the API to the screen
    echo $response;
}

