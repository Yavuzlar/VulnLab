<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <title>Kayıtlar</title>
</head>
<body>



<?php

include( "baglanti.php" );

session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; // Eğer email set edilmişse $email'e ata, aksi halde boş bir string ata

if (isset($_POST['silButton'])) {

    $sql = "DELETE FROM kayit WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo $strings["reg_del"].'<br>';    //Kayıtlar başarıyla silindi.
    } else {
        echo "Error";
    }
}


try {
    $sql = "SELECT * FROM kayit WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Sonuçları ekrana yazdır
    if (count($results) > 0) {
        echo "<h2>$email $strings[registers] </h2>";
        echo "<table class='table'>
                <tr>
                    <th>$strings[name]</th>
                    <th>$strings[surname]</th>
                    <th>$strings[email]</th>
                    <th>$strings[phone]</th>
                </tr>";
    
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . $row['ad'] . "</td>
                    <td>" . $row['soyad'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['tel'] . "</td>
                  </tr>";
        }
    
        echo "</table>";
    } else {
        echo $strings['no_registration'];    //Henüz Kayıt bulunmamaktadır.
    }
} catch (PDOException $e) {
    echo "Sorgu hatası: " . $e->getMessage();
}

$db = null;

?>
<form action="" method="POST">
<a href="index.php" class="btn btn-secondary"><?php echo $strings["back"]?></a>
<button class="btn btn-danger" type="submit" name="silButton"><?php echo $strings["del"]?></button>
</form>
<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="12" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>