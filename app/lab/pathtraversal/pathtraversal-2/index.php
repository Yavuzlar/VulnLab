<?php require("../../../lang/lang.php"); 
$lang = tr();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Path Traversal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .urun-karti {
            margin-bottom: 20px;
            cursor: pointer;
        }

        .urun-karti img {
            max-width: 100%;
            height: auto;
        }

        .urun-karti-baslik {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <?php
                $imageCount = 4;

                for ($i = 1; $i <= $imageCount; $i++) {
                    $productId = $i;
                    $imageName = $i . ".png";

                    echo '<div class="col-md-3">';
                    echo '<div class="urun-karti">';
                    echo '<a href="product-detail.php?productId=' . $productId . '.png' . '">';
                    echo '<img src="img/' . $imageName . '">';
                    echo '<h4 class="urun-karti-baslik">';
                    switch ($productId) {
                        case 1:
                            echo $lang['productTitle1'];
                            break;
                        case 2:
                            echo $lang['productTitle2'];
                            break;    
                        case 3:
                            echo $lang['productTitle3'];
                            break;
                        case 4:
                            echo $lang['productTitle4'];
                            break;
                    }
                    echo '</h4>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    <script id="VLBar" title="Path Traversal" category-id="15" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
