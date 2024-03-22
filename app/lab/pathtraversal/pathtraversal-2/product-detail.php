<?php require("../../../lang/lang.php");
$lang = tr();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $lang['title']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .detay-kapsayici {
            text-align: center;
            margin-top: 50px;
        }

        .detay-kapsayici img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="detay-kapsayici">
            <?php
                $productId = $_GET['productId'];
                
                $filePath = str_replace("../","", $productId);
                $fileContent = file_get_contents("/var/www/html/lab/path/img/" . $filePath);

                if ($fileContent != false) {
                    echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
                }    
                
                echo '<img src="img/' . $productId . '">';
                
                switch ($productId) {
                    case '1.png':
                        echo '<h2>' . $lang['productTitle'] . '</h2>';
                        echo '<p>' . $lang['productDes1'] . '</p>';
                        break;
                    case '2.png':
                        echo '<h2>' . $lang['productTitle'] . '</h2>';
                        echo '<p>' . $lang['productDes2'] . '</p>';
                        break;
                    case '3.png':
                        echo '<h2>' . $lang['productTitle'] . '</h2>';
                        echo '<p>' . $lang['productDes3'] . '</p>';
                        break;
                    case '4.png':
                        echo '<h2>' . $lang['productTitle'] . '</h2>';
                        echo '<p>' . $lang['productDes4'] . '</p>';
                        break;
                    default:
                        echo '<h2>' . $lang['productError'] . '</h2>';
                        break;
                }
            ?>
            <a href="index.php" class="btn btn-primary mt-3"><?php echo $lang['back']; ?></a>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="9" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
