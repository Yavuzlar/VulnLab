<?php
$uploadDirectory = '../api/uploads/';

$images = array_diff(scandir($uploadDirectory), array('..', '.'));

echo json_encode(array_values($images));
?>
