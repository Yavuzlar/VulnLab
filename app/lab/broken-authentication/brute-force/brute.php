<?php

$db = new PDO('sqlite:users.db');
$html= "";

if(isset($_POST['username']) && isset($_POST['password'])  ){
    $q = $db->prepare("SELECT * FROM users_ WHERE username=:user AND password=:pass");
    $q->execute(array(
        'user' => $_POST['username'],
        'pass' => $_POST['password']
    ));
    $_select = $q -> fetch();

    if ( isset($_select['id'])) {

        session_start();
        $_SESSION['username'] = $_POST['username'];
        $html =$strings["cong"];
        //header("Location: index.php");
    } else {
        $html=$strings["wrong"];
    }

}

?>