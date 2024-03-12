<?php
$database_file = 'api.db';
$pdo = new PDO("sqlite:" . $database_file);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
