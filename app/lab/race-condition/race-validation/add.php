<?php
require_once 'conn.php';

if (isset($_GET['bm90IGhlcmU'])) {

    $id = $_GET['bm90IGhlcmU'];

    $query = $conn->prepare("UPDATE products SET isCart = 1 WHERE id = ?");
    $query->execute(array($id));
    header("Location: index.php?mess=success");


} else {
    header("Location: index.php?mess=addError");
}
