<?php

    $db = new PDO('sqlite:database.db');

    for($id=1;$id<=2;$id++){

        switch($id){
            case $id == 1: //admin
                $money = "999999999999";
                break;
            case $id == 2: //user
                $money = "1000";
                break;
        }

        $query = $db -> prepare("UPDATE csrf_money_transfer SET money=:money WHERE id=:id");
        $query -> execute(array(
            'id' => $id,
            'money' => $money
        ));

        $query2 = $db -> prepare("DROP TABLE csrf_chat");
        $query2 -> execute();

        $query3 = $db -> prepare('CREATE TABLE "csrf_chat" (
            "id"	INTEGER,
            "authority"	TEXT,
            "message"	TEXT,
            PRIMARY KEY("id" AUTOINCREMENT)
        )');
        $query3 -> execute();



    }

    header("Location: index.php");
    exit;


?>