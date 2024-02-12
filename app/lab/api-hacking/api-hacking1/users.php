<?php

$userInfo = array(
    'username' => 'user',
    'password' => 'user'
);

$userData = array($userInfo);

$jsonData = json_encode($userData);

file_put_contents('users.json', $jsonData);

?>