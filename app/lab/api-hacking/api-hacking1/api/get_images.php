<?php
session_start();

$uploadDirectory = '../api/uploads/';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $images = array_filter(scandir($uploadDirectory), function ($image) use ($userId) {
        //Check if the number at the beginning of the file name matches the user ID.
        preg_match('/^(\d+)_/', $image, $matches);
        return isset($matches[1]) && $matches[1] == $userId;
    });

    echo json_encode(array_values($images));
} else {
    echo json_encode([]);
}
?>
