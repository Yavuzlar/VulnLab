<?php

    $db = new PDO('sqlite:database.db');

    $query = $db -> prepare("UPDATE csrf_follow SET follow_status=:follow_status");
    $query -> execute(array(
        'follow_status' => 'false'
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

    header("Location: index.php");
    exit;


?>