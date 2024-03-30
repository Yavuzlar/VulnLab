<?php require("../../../lang/lang.php"); 
$lang = tr();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Path Traversal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-card {
            margin-bottom: 20px;
            cursor: pointer;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
        }

        .product-card-header {
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
                    echo '<div class="product-card">';
                    echo '<a href="product-detail.php?productId=' . $productId . '.png' . '">';
                    echo '<img src="img/' . $imageName . '">';
                    echo '<h4 class="product-card-header">';
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
