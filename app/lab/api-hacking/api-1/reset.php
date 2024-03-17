<?php
// To return the user information in the main1.json file to default values

// Define default usernames and passwords
$defaultUsers = array(
    array("username" => "admin", "password" => "admin"),
    array("username" => "user", "password" => "user")
);

// Convert to JSON format
$defaultData = json_encode($defaultUsers, JSON_PRETTY_PRINT);

// Write to main1.json
file_put_contents('main1.json', $defaultData);

// Redirect to Index page
header("Location: index.php");
exit;
