<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "Yetkisiz erişim!";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "dbconnect.php";

    $content_id = $_POST['content_id'];
    $new_content = $_POST['new_content'];

    $sql = "UPDATE contents SET content = :new_content WHERE id = :content_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':new_content', $new_content, PDO::PARAM_STR);
    $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT);
    $Stmt->bindParam(':userid', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    echo "Makale başarıyla güncellendi!";
} else {
    http_response_code(405);
    echo "Geçersiz metod!";
}
?>
