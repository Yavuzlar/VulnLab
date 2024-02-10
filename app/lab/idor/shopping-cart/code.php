<?php
require("../../../lang/lang.php");
$strings = tr();

require_once 'conn.php';

if (isset($_GET['hesoyam']) && isset($_POST['inputCode'])) {

    $inputCode = $_POST['inputCode'];

    $query = $conn->prepare("SELECT content FROM shopMessage  ORDER BY id DESC LIMIT 1");
    $query->execute();
    $code = $query->fetch(PDO::FETCH_ASSOC);

    if ($inputCode == $code['content']) {

        $sum = 0;

        $productsDB = $conn->prepare("SELECT * FROM products ORDER BY id");
        $productsDB->execute();
        $products = $productsDB->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
            if ($product["isCart"] == 0) {
                continue;
            }else{
                $sum = $sum + ($product["price"] * $product["piece"]);
            }
        }
        $newBalance = $globalBalance - $sum;
        $query = $conn->prepare("UPDATE temp SET balance = ? WHERE balance = ?");
        $query->execute(array($newBalance,$globalBalance));



        $query = $conn->prepare("SELECT * FROM products ORDER BY id");
        $query->execute();
        $productsCart = $query->fetchAll(PDO::FETCH_ASSOC);

        $text = "";
        $flag = 0;
        $redTeam = 0;
        $title = "";
        foreach ($productsCart as $product){
            if ($product['isCart'] == 0) {
                continue;
            }
            if ($product["id"] == 1) {
                $title = $strings["p1_title"];
                $redTeam = 1;
            } else if ($product["id"] == 2) {
                $title = $strings["p2_title"];
            } else if ($product["id"] == 3) {
                $title = $strings["p3_title"];
            }
            $text = $text . $product['piece'] . "x" . $title . ",";
            // if ($product['id'] == 3) {
            //     $flag = 1;
            // }
            // if ($product['id'] == 1) {
            //     $redTeam = 1;
            // }
        }

        // if ($redTeam == 1 && $flag == 1) {
        //     $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
        //     $query->execute();
        //     header("Location: index.php?flag=R3DT3AM&&flag=ZmxhZ1N1Y2Nlc3M=&&text=$text");
        // }else if ($flag == 1) {
        //     $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
        //     $query->execute();
        //     header("Location: index.php?flag=ZmxhZ1N1Y2Nlc3M=&&text=$text");
        // }else 
        if ($redTeam == 1) {
            $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
            $query->execute();
            header("Location: index.php?flag=R3DT3AM&&text=$text");
        }else{
            $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
            $query->execute();
            header("Location: cart.php?mess=buySuccess");
        }








        // foreach ($products as $product){
        //     if ($product['id'] == 3) {
        //         $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
        //         $query->execute();
        //         header("Location: index.php?flag=ZmxhZ1N1Y2Nlc3M=");
        //     }else if($product['id'] == 1) {
        //         $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
        //         $query->execute();
        //         header("Location: index.php?flag=R3DT3AM");
        //     }else{
        //         $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
        //         $query->execute();
        //         header("Location: cart.php?mess=buySuccess");
        //     }
        // }
   
    } else {
        header("Location: 3Dvalid.php?mess=wrongCode");
    }
   

} else {
    header("Location: 3Dvalid.php?mess=error");
}
