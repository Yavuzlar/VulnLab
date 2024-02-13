<?php

session_start();
header("Content-Type: application/json");

$response = array();

$uploadDirectory = 'uploads/';

// Check the user's identity.
if (!isset($_SESSION['user_id'])) {
    $response['success'] = false;
    $response['message'] = $strings['authenticate'];
    echo json_encode($response);
    exit;
}

$userId = $_SESSION['user_id'];

// Check the allowed file types.
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($_FILES['image']['type'], $allowedTypes)) {
    $response['success'] = false;
    $response['message'] = $strings['invalidtype'] . implode(', ', $allowedTypes);
    echo json_encode($response);
    exit;
}

// Create the file name.
$targetFile = $uploadDirectory . $userId . '_' . basename($_FILES['image']['name']);

// Check if a file with the same name exists.
if (file_exists($targetFile)) {
    $response['success'] = false;
    $response['message'] = $strings['samename'];
    echo json_encode($response);
    exit;
}

if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    $response['success'] = true;
    $response['message'] = $strings['success1'];
} else {
    $response['success'] = false;
    $response['message'] = $strings['uploaderr'];
}

echo json_encode($response);

?>