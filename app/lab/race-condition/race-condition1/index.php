<?php

require("../../../lang/lang.php");
$strings = tr();

include( "baglanti.php" );

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = htmlspecialchars($_POST['ad']);
    $soyad = htmlspecialchars($_POST['soyad']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);


        // Kontrol et: Aynı emaile sahip kayıt var mı?
        $kontrolSql = "SELECT * FROM kayit WHERE email = '$email'";
        $kontrolSonuc = $db->query($kontrolSql);
        $results = $kontrolSonuc->fetchAll(PDO::FETCH_ASSOC);
        if (count($results) > 0) {
            // Aynı emaile sahip kayıt bulundu, uyarı ver.
            echo $strings['warning'];              //Kayıt işlemi başarısız: Epostaya kayıtlı hesap zaten mevcut!
        } else {
            // Aynı emaile sahip kayıt yok, ekle.
            $ekleSql = "INSERT INTO kayit (ad, soyad, email, tel) VALUES ('$ad', '$soyad', '$email', '$tel')";

            if ($db->exec($ekleSql)) {
                echo $strings['successful'];       //Kayıt Tamamlandı!
            } else {
                echo $strings['unsuccessful'];     //Kayıt İşlemi başarısız.
            }
        }

    $db = null;
}



if (isset($_POST['email'])) {
    session_start();
    $_SESSION['email'] = $_POST['email'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <title><?php echo "Race Condition" ?></title>
   
    
</head>
<body>

<div class="container col-md-4 shadow-lg rounded">
        <div class="d-flex row justify-content-center pt-lg-5 " style="margin-top: 20vh;text-align:center;">
            <div class="alert alert-primary col-md-7 mb-5" role="alert">
            <?php echo $strings['text']; ?>
            </div>
    
    <h2><?php  echo $strings ['information']?></h2>
    <form action="index.php" method="post">
        <label style="display: inline-block; width: 160px;"><?php echo $strings ['name']?>:</label>
        <input type="text" name="ad" required><br>
        <label style="display: inline-block; width: 160px;"><?php  echo $strings ['surname']?>:</label>
        <input type="text" name="soyad" required><br>
        <label style="display: inline-block; width: 160px;"><?php  echo $strings ['email']?>:</label>
        <input type="email" name="email" required><br>
        <label style="display: inline-block; width: 160px;"><?php  echo $strings ['phone']?>:</label>
        <input type="number" name="tel" required><br><br>
        <input type="submit" value="<?php echo $strings['register'];?>">
    </form>

    <a href="kayitlar.php"><?php echo $strings['registers'];?></a>

    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="12" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
