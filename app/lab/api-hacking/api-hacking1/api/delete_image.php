<?php

header("Content-Type: application/json");

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $imageToDelete = $_GET['image'];
    $uploadDirectory = '../api/uploads/';

    $targetFile = $uploadDirectory . $imageToDelete;

    if (file_exists($targetFile) && unlink($targetFile)) {
        $response['success'] = true;
        $response['message'] = $strings['success2'];
    } else {
        $response['success'] = false;
        $response['message'] = $strings['deleteerr'];
    }
} else {
    $response['success'] = false;
    $response['message'] = $strings['requestmethod'];
}

echo json_encode($response);
?>
