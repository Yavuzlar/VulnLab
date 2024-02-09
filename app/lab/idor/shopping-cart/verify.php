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
        $sum = $sum + ($product["price"] * $product["piece"]);
    }
}

if ($sum > 0 && $sum < $globalBalance) {
    // foreach ($products as $product) {
    //     if ($product["isCart"] == 0) {
    //         continue;
    //     }else{
    //         $product["isCart"] == 0;
    //     }
    // }
    header("Location: 3Dvalid.php?code=SSBoZWFyZCB0aGUgYWRtaW4gaXMgZm9yZ2V0ZnVs");
} else if ($sum > $globalBalance) {
    header("Location: cart.php?mess=priceError");
}else{
    header("Location: cart.php?mess=emptyCart");
}
