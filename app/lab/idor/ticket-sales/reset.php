<?php

    $db = new PDO('sqlite:database.db');

    $query = $db -> prepare("UPDATE idor_buy_tickets SET money=1000, ticket=10 WHERE id=1");
    $query -> execute();


    header("Location: index.php");
    exit;


?>