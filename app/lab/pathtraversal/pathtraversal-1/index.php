<?php
require("../../../lang/lang.php");
$strings = tr();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Path Traversal" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        body {
            background-color: white;
        }
        header {
            background-color: white;
        }
        h1 {
            color: black;
        }
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        .button-container2 {
            display: flex;
            justify-content: center;
            align-items: center; 
            margin-top: 10px;
        }


    </style>
</head>
<body>

<header>
    <h1 id="page-title"><?php echo $strings['information']; ?></h1>
    <img src="../pathtraversal-1/images/yavuzlar.png" alt="Logo" width="100" height="100" class="d-inline-block align-text-top">
</header>

<div class="products-container">
    <div class="product" onclick="goToProductPage(1)">
        <img src="../pathtraversal-1/images/clop.jpg" alt="Ürün 1 Resmi" width="300" height="240">
        <h2><?php echo $strings['information2']; ?></h2>
        <br>
        <br>
        <div class="button-container">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>

    <div class="product" onclick="goToProductPage(2)">
        <img src="../pathtraversal-1/images/Anonymous.jpeg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex1']; ?></h2>
        <br>
        <br>
        <div class="button-container">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(3)">
        <img src="../pathtraversal-1/images/LazarusGroup.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex2']; ?></h2>
        <br>
        <br>
        <div class="button-container">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(4)">
        <img src="../pathtraversal-1/images/carbanak.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex3']; ?></h2>
        <br>
        <br>
        <div class="button-container">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(5)">
        <img src="../pathtraversal-1/images/TheDarkOverlord.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex4']; ?></h2>
        <br>
        <br>
        <div class="button-container">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(6)">
        <img src="../pathtraversal-1/images/TheEquationGroup.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex5']; ?></h2>
        <br>
        <div class="button-container2">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(7)">
        <img src="../pathtraversal-1/images/ta505.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex6']; ?></h2>
        <br>
        <div class="button-container2">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(8)">
        <img src="../pathtraversal-1/images/darkside.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex7']; ?></h2>
        <br>
        <div class="button-container2">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(9)">
    
        <img src="../pathtraversal-1/images/morpho1.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex8']; ?></h2>
        <br>
        
    
        <div class="button-container2">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>
    <div class="product" onclick="goToProductPage(10)">
        <img src="../pathtraversal-1/images/Lapsus.jpg" alt="Ürün 2 Resmi" width="300" height="240">
        <h2><?php echo $strings['ex9']; ?></h2>
        <br>
        <div class="button-container2">
            <button type="button" class="btn btn-success"><?php echo $strings['click']; ?></button>
        </div>
    </div>

</div>

<script>
    function goToProductPage(productId) {
        window.location.href = "../pathtraversal-1/product.php?productId=" + productId;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
