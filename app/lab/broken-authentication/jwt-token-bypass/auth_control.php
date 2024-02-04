<?php
require_once('config.php');
$jwt = (new JWT);

if (isset($_COOKIE['auth_type'])){
    //echo $_COOKIE['auth_type'];
    if ($validate = $jwt->is_valid($_COOKIE['auth_type'])){
        $jwt_username =  $jwt->get_username($_COOKIE['auth_type']);
        $jwt_userid =  $jwt->get_userid($_COOKIE['auth_type']);
    }else{
        header("Location: login.php");
        exit;
    }
}else{
    header("Location: login.php");
    exit;
}
?>