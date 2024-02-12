<?php

header("Content-Type: application/json");

$response = array();

$uploadDirectory = 'uploads/';

if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

$targetFile = $uploadDirectory . basename($_FILES['image']['name']);

if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    $response['success'] = true;
    $response['message'] = "The upload process has been successfully completed.";
} else {
    $response['success'] = false;
    $response['message'] = "An error occurred while uploading the file.";
}

echo json_encode($response);

?>