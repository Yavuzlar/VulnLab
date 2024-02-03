<?php
require_once 'conn.php';

$sum = 0;

$productsDB = $conn->prepare("SELECT * FROM products ORDER BY id");
$productsDB->execute();
$products = $productsDB->fetchAll(PDO::FETCH_ASSOC);
foreach ($products as $product) {
    if ($product["isCart"] == 0) {
        continue;
    }else{
        $sum += $product["price"] ;
    }
}

if ($sum < 101 && $sum > 0) {
    // foreach ($products as $product) {
    //     if ($product["isCart"] == 0) {
    //         continue;
    //     }else{
    //         $product["isCart"] == 0;
    //     }
    // }
    header("Location: 3Dvalid.php?code=SSBoZWFyZCB0aGUgYWRtaW4gaXMgZm9yZ2V0ZnVs");
} else if ($sum > 100) {
    header("Location: cart.php?mess=priceError");
}else{
    header("Location: cart.php?mess=emptyCart");
}
