<?php
session_start();

session_unset();
session_destroy();

$response = array('success' => true);
echo json_encode($response);
