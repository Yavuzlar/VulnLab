<?php

    $db = new PDO('sqlite:database.db');

    for($id=1;$id<=2;$id++){

        switch($id){
            case $id == 1:
                $password = "3cc22e4367e2d2525ea28a7d33731c12";
                break;
            case $id == 2:
                $password = "user";
                break;
        }

        $query = $db -> prepare("UPDATE csrf_changing_password SET password=:password WHERE id=:id");
        $query -> execute(array(
            'id' => $id,
            'password' => $password
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