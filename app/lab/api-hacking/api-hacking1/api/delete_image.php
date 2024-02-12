<?php

header("Content-Type: application/json");

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $imageToDelete = $_GET['image'];
    $uploadDirectory = '../api/uploads/';

    $targetFile = $uploadDirectory . $imageToDelete;

    if (file_exists($targetFile) && unlink($targetFile)) {
        $response['success'] = true;
        $response['message'] = "Image deleted successfully.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error deleting the image.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
}

echo json_encode($response);
?>
