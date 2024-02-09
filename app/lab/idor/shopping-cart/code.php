<?php
require_once 'conn.php';

if (isset($_GET['hesoyam']) && isset($_POST['inputCode'])) {

    $inputCode = $_POST['inputCode'];

    $query = $conn->prepare("SELECT content FROM shopMessage  ORDER BY id DESC LIMIT 1");
    $query->execute();
    $code = $query->fetch(PDO::FETCH_ASSOC);

    if ($inputCode == $code['content']) {
        $productsDB = $conn->prepare("SELECT * FROM products WHERE isCart = 1");
        $productsDB->execute();
        $products = $productsDB->fetchAll(PDO::FETCH_ASSOC);


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


        foreach ($products as $product){
            if ($product['id'] == 3) {
                $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
                $query->execute();
                header("Location: index.php?flag=ZmxhZ1N1Y2Nlc3M=");
            }else if($product['id'] == 1) {
                $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
                $query->execute();
                header("Location: index.php?flag=R3DT3AM");
            }else{
                $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE  isCart = 1");
                $query->execute();
                header("Location: cart.php?mess=buySuccess");
            }
        }
   
    } else {
        header("Location: 3Dvalid.php?mess=wrongCode");
    }
   

} else {
    header("Location: 3Dvalid.php?mess=error");
}
