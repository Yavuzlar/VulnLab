<?php

    $db = new PDO('sqlite:database.db');

    for($id=1;$id<=10;$id++){

        switch($id){
            case $id == 1:
                $address = "";
                break;
            case $id == 2:
                $address = "38740 McDermott Centers Suite 216 Keelingfurt, CO 79459-7315";
                break;
            case $id == 3:
                $address = "9287 Kacie View Apt. 466 Roycetown, RI 41148-8999";
                break;
            case $id == 4:
                $address = "814 Junior Heights Apt. 923 Blickborough, NE 07165";
                break;
            case $id == 5:
                $address = "82224 Royal Court Apt. 041 South Adam, TX 95519";
                break;
            case $id == 6:
                $address = "4694 Wiegand Neck Apt. 150 Alexandrineborough, MI 05609";
                break;
            case $id == 7:
                $address = "5435 Trantow Spring Suite 828 Theresiaton, SC 63831-7476";
                break;
            case $id == 8:
                $address = "82226 Blick Gardens Suite 473 North Krista, CA 97233-8527";
                break;
            case $id == 9:
                $address = "457 Ambrose Branch Apt. 297 Marciamouth, DC 88336";
                break;
            case $id == 10:
                $address = "78903 Theodore Coves Suite 309 Matildachester, MI 10227-6637";
                break;

        }

        $query = $db -> prepare("UPDATE idor_address_entry SET address=:address WHERE id=:id");
        $query -> execute(array(
            'id' => $id,
            'address' => $address
        ));


    }

    header("Location: index.php");
    exit;


?>