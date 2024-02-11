<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
    </style>
</head>
<body>

<header>
    <h1 id="page-title">Most Popular Hacker Groups</h1>
    <img src="/pathtraversal/images/yavuzlar.png" alt="Logo" width="60" height="55" class="d-inline-block align-text-top">
</header>

<div class="products-container">
<div class="product" onclick="goToProductPage(1)">
        <img src="/pathtraversal/images/clop.jpg" alt="Ürün 1 Resmi">
        <h2>Clop Hacker Group</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more
</button>
    </div>

 <div class="product" onclick="goToProductPage(2)">
        <img src="/pathtraversal/images/Anonymous.jpeg" alt="Ürün 2 Resmi">
        <h2>Anonymous</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more
</button>
    </div>

    <div class="product" onclick="goToProductPage(3)">
        <img src="/pathtraversal/images/LazarusGroup.jpg" alt="Ürün 3 Resmi">
        <h2>Lazarus Group</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>

    <div class="product" onclick="goToProductPage(4)">
        <img src="/pathtraversal/images/carbanak.jpg" alt="Ürün 4 Resmi">
        <h2>Carbanak</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>

    <div class="product" onclick="goToProductPage(5)">
        <img src="/pathtraversal/images/TheDarkOverlord.jpg" alt="Ürün 5 Resmi">
        <h2>The Dark Overlord</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>
        <div class="product" onclick="goToProductPage(6)">
        <img src="/pathtraversal/images/TheEquationGroup.jpg" alt="Ürün 5 Resmi">
        <h2>The Equation Group</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>
    <div class="product" onclick="goToProductPage(7)">
        <img src="/pathtraversal/images/ta505.jpg" alt="Ürün 5 Resmi">
        <h2>TA505 (Evil Corp)</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>
    <div class="product" onclick="goToProductPage(8)">
        <img src="/pathtraversal/images/darkside.jpg" alt="Ürün 5 Resmi">
        <h2>DarkSide</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>
    <div class="product" onclick="goToProductPage(9)">
        <img src="/pathtraversal/images/morpho.jpg" alt="Ürün 5 Resmi">
        <h2>Morpho</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>
        <div class="product" onclick="goToProductPage(10)">
        <img src="/pathtraversal/images/Lapsus.jpg" alt="Ürün 5 Resmi">
        <h2>Lapsus$</h2>
        <br>
        <button type="button" class="btn btn-success">Click for more</button>
    </div>
</div>

<script>
    function goToProductPage(productId) {
        window.location.href = "/pathtraversal/product.php?productId=" + productId;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
