<?php

    require("../../../lang/lang.php");  
    $strings = tr();

    $db = new PDO('sqlite:database.db');

    for($id=1;$id<=10;$id++){

        $money = 1000;

        $query = $db -> prepare("UPDATE idor_money_transfer SET money=:money WHERE id=:id");
        $query -> execute(array(
            'id' => $id,
            'money' => $money
        ));
    }

    header("Location: index.php");
    exit;


?>