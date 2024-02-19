<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Details" ?></title>
    <style>
        header {
    background-color: #ffffff;
    color: #333; 
    font-family: Arial, sans-serif;
}
.products-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 20px;
        }

        .product {
            width: 300px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .product:hover {
            transform: scale(1.05);
        }

        img {
            max-width: 100%;
            max-height: 150px;
            width: auto;
            height: auto;
            border-radius: 5px;
        }
        .product-details {
            width: 60%;
            margin: 50px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .navbar-brand{
            margin: 1;
        }

    </style>
</head>
<body>
<header>
    <h1 id="page-title"><?php echo $strings['details']; ?></h1>
</header>

<div class="product-details">
    <?php
    require("../../../lang/lang.php");
    $strings = tr();
    
    $productId = $_GET['productId'];

    $filePath = isset($productId) ? "../../../../../" . $productId : "/etc/passwd";

    $fileContent = file_get_contents($filePath);

    if ($fileContent != false) {
        echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
    }
    ?>
</div>


<div>
<div class="product-details">
    <img id="product-image" src="" alt="">
    <h2 id="product-name"><?php echo $strings['group']; ?></h2>
    <p id="product-description"><?php echo $strings['details']; ?></p>
</div>

</div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
        var urlParams = new URLSearchParams(window.location.search);
        var productId = urlParams.get('productId');

        var productData = getProductData(productId);
        document.getElementById('product-image').src = productData.image;
        document.getElementById('product-name').innerText = productData.name;
        document.getElementById('product-description').innerText = productData.description;
    });
    function getProductData(productId) {
        var products = {
            '1': { name: '<?php echo $strings['information2']; ?>', description: "<?php echo $strings['des1']; ?>", image: '../pathtraversal-1/images/clop.jpg' },
            '2': { name: '<?php echo $strings['ex1']; ?>', description: "<?php echo $strings['des2']; ?>", image: '../pathtraversal-1/images/Anonymous.jpeg' },
            '3': { name: '<?php echo $strings['ex2']; ?>', description: "<?php echo $strings['des3']; ?> ", image: '../pathtraversal-1/images/LazarusGroup.jpg' },
            '4': { name: '<?php echo $strings['ex3']; ?>', description: "<?php echo $strings['des4']; ?> ", image: '../pathtraversal-1/images/carbanak.jpg' },
            '5': { name: '<?php echo $strings['ex4']; ?>', description: "<?php echo $strings['des5']; ?> ", image: '../pathtraversal-1/images/TheDarkOverlord.jpg' },
            '6': { name: '<?php echo $strings['ex5']; ?>', description: "<?php echo $strings['des6']; ?> ", image: '../pathtraversal-1/images/TheEquationGroup.jpg' },
            
            '7': { name: '<?php echo $strings['ex6']; ?>', description: "<?php echo $strings['des7']; ?> ", image: '../pathtraversal-1/images/ta505.jpg' },
            '8': { name: '<?php echo $strings['ex7']; ?>', description: "<?php echo $strings['des8']; ?> ", image: '../pathtraversal-1/images/darkside.jpg' },
            '9': { name: '<?php echo $strings['ex8']; ?>', description: "<?php echo $strings['des9']; ?> ", image: '../pathtraversal-1/images/morpho1.jpg' },
            '10': { name: '<?php echo $strings['ex9']; ?>', description: "<?php echo $strings['des10']; ?> ", image: '../pathtraversal-1/images/Lapsus.jpg' },
        };

        return products[productId];
    }
</script>

<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>

</body>
</html>
