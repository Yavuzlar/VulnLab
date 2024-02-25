<?php
try {
  $db = new PDO('sqlite:database.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Bağlantı hatası: " . $e->getMessage();
  die();
}

?>