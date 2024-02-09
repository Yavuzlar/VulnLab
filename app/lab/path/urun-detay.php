<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ürün Detayı</title>
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
                //$urunId = isset($_GET['urunId']) ? $_GET['urunId'] : ''; 
                //$resimYolu = "img/" . $urunId;

                echo '<img src="img/' . $_GET['urunId'] . '" alt="Ürün Resmi">';
                
                switch ($_GET['urunId']) {
                    case '1.png':
                        echo '<h2>Ürün 1 Başlığı</h2>';
                        echo '<p>Ürün 1 Açıklaması</p>';
                        break;
                    case '2.png':
                        echo '<h2>Ürün 2 Başlığı</h2>';
                        echo '<p>Ürün 2 Açıklaması</p>';
                        break;
                    case '3.png':
                        echo '<h2>Ürün 3 Başlığı</h2>';
                        echo '<p>Ürün 3 Açıklaması</p>';
                        break;    
                    case '4.png':

                        echo '<h2>Ürün 4 Başlığı</h2>';
                        echo '<p>Ürün 4 Açıklaması</p>';
                        break;
                    default:
                        echo '<h2>bir hata oluştu</h2>';
                        break;
                }

            ?>
            <a href="index.php" class="btn btn-primary mt-3">Listeye Dön</a>
        </div>
    </div>
</body>
</html>
