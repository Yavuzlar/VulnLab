<?php
require_once 'conn.php';

if (isset($_GET['bm90IGhlcmU'])) {

    $id = $_GET['bm90IGhlcmU'];

    $query = $conn->prepare("UPDATE products SET isCart = 0, piece = 0 WHERE id = ?");
    $query->execute(array($id));
    header("Location: cart.php?mess=success");


} else {
    header("Location: cart.php?mess=deleteError");
}
