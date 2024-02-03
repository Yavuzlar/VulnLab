<?php
require_once 'conn.php';

if (isset($_GET['hesoyam']) && isset($_POST['inputCode'])) {

    $inputCode = $_POST['inputCode'];

    $query = $conn->prepare("SELECT code FROM codes  ORDER BY id DESC LIMIT 1");
    $query->execute();
    $code = $query->fetch(PDO::FETCH_ASSOC);

    if ($inputCode == $code['code']) {
        $productsDB = $conn->prepare("SELECT * FROM products WHERE id = 3");
        $productsDB->execute();
        $product = $productsDB->fetchAll(PDO::FETCH_ASSOC);

        if ($product[0]["isCart"] == 1) {
            header("Location: index.php?flag=ZmxhZ1N1Y2Nlc3M=");
        }else{
            $query = $conn->prepare("UPDATE products SET isCart = 0 WHERE  isCart = 1");
            $query->execute();
            header("Location: cart.php?mess=buySuccess");
        }
    } else {
        header("Location: 3Dvalid.php?mess=wrongCode");
    }
   

} else {
    header("Location: 3Dvalid.php?mess=error");
}
