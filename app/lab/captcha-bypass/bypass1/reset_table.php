<?php
// Veritabanı bağlantısı
$db = new PDO('sqlite:comment.db');

// 1 ve 2 ID'ye sahip comment'lar hariç tüm comment'ları sil
$stmt = $db->prepare("DELETE FROM comments ");
$stmt->execute();

// Ana sayfaya yönlendirme
header("Location: /lab/captcha-bypass/bypass1/index.php");
exit();
?>
