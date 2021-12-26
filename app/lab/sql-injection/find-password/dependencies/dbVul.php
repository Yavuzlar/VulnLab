<?php

    $host = 'localhost';
    $db_name='login';
    $charset ='utf8';
    $username = 'root';
    $password = '';


$mysqli = new mysqli('localhost', 'root', '', 'login');

/* Check connection before executing the SQL query */
if ($mysqli->connect_errno) {
printf("Connect failed: %s\n", $mysqli->connect_error);
exit();
}

?>