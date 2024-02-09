<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ürün Listesi</title>
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
                $resimSayisi = 4;

                for ($i = 1; $i <= $resimSayisi; $i++) {
                    $urunId = $i;
                    $resimAdi = $i . ".png";

                    echo '<div class="col-md-3">';
                    echo '<div class="urun-karti">';
                    echo '<a href="urun-detay.php?urunId=' . $urunId . '.png' . '">';
                    echo '<img src="img/' . $resimAdi . '" alt="Ürün ' . $urunId . '">';
                    echo '<h4 class="urun-karti-baslik">Ürün ' . $urunId . ' Başlık</h4>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
