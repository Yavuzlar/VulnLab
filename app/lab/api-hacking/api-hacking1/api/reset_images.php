<?php

header("Content-Type: application/json");

$response = array();

$backupDirectory = __DIR__ . '/backup_images/';

if (!file_exists($backupDirectory)) {
    $response['success'] = false;
    echo json_encode($response);
    exit;
}

$uploadDirectory = 'uploads/';

$files = glob($uploadDirectory . '*'); 
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file); 
    }
}

$backupFiles = glob($backupDirectory . '*');
foreach ($backupFiles as $backupFile) {
    if (is_file($backupFile)) {
        $targetFile = $uploadDirectory . basename($backupFile);
        copy($backupFile, $targetFile); 
    }
}

$response['success'] = true;
$response['message'] = $strings['reset'];
echo json_encode($response);
?>
