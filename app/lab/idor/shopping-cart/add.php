<?php
require_once 'conn.php';

if (isset($_GET['bm90IGhlcmU'])) {

    $id = $_GET['bm90IGhlcmU'];

    $query = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $query->execute(array($id));
    $product = $query->fetch(PDO::FETCH_ASSOC);
    $piece =$product["piece"] + 1;

    $query = $conn->prepare("UPDATE products SET isCart = 1, piece=? WHERE id = ?");
    $query->execute(array($piece,$id));



    header("Location: index.php?mess=success");


} else {
    header("Location: index.php?mess=addError");
}
