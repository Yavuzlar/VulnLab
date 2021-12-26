<?php

    $db = new PDO('sqlite:database.db');

    for($id=1;$id<=10;$id++){

        $password = "user-pass-".$id;

        $query = $db -> prepare("UPDATE idor_changing_password SET password=:password WHERE id=:id");
        $query -> execute(array(
            'id' => $id,
            'password' => $password
        ));
    }

    header("Location: index.php");
    exit;


?>