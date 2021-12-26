<?php
    ob_start();
    session_start();
    
    $_SESSION['authority'] = "user";
    
    $db = new PDO('sqlite:database.db');
    
    require("../../../lang/lang.php");
    $strings = tr();
    
    $selectUser = $db -> prepare("SELECT * FROM csrf_money_transfer WHERE authority=:authority");
    $selectUser -> execute(array('authority' => $_SESSION['authority']));
    $selectUser_Info = $selectUser -> fetch();
    
    sleep(1);
    
    echo $strings['card_money']."  <b>" .$selectUser_Info['money']. " ".$strings['card_money_symbol']. "</b>";

?>