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
    <title>ssti</title>
</head>
<body>
<div style="text-align: center; padding: 20px;">

<form action="" method="GET">
    <input placeholder="<?php echo $strings['searchonpage'] ?>" type="text" name="ad">
    <button type="submit"><?php echo $strings['search'] ?></button>
</form>

<?php

// Ekrana hata mesajlarını göstermemek için
error_reporting(E_ERROR);
ini_set('display_errors', 0);



if (isset($_GET['ad'])) {
    $name = $_GET['ad'];

    $blacklist = array('{{', '}}', '{%', '%}');
    $name = str_replace($blacklist, '', $name);

    try {
        require 'vendor/autoload.php';
        Twig_Autoloader::register();
        $loader = new Twig_Loader_String();
        $twig = new Twig_Environment($loader);
        $result = $twig->render(strip_tags($name));

        echo $result.' '.$strings['not_found'];
    } catch (Exception $e) {
        echo ('ERROR:' . $e->getMessage());
    }
}


?>
</div>


<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="11" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>