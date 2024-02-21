<?php
$userInfo = array(
    'id' => '1',
    'username' => 'admin',
    'password' => 'admin'
);
$userInfo2 = array(
    'id' => '2',
    'username' => 'user',
    'password' => 'user'
);
$userInfo = array(
    'id' => '3',
    'username' => 'user2',
    'password' => 'user2'
);
$userInfo = array(
    'id' => '4',
    'username' => 'user3',
    'password' => 'user3'
);
$userInfo = array(
    'id' => '5',
    'username' => 'user3',
    'password' => 'user3'
);

$userData = array($userInfo);

$jsonData = json_encode($userData);

file_put_contents('users.json', $jsonData);

?>