<?php

require("lang/lang.php");
$strings = tr();

session_start(); // Oturumu başlat

// Sepet işlemleri
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ürünlerin eklendiği form gönderildiğinde
if (isset($_POST['add_to_cart'])) {
    $product_price = $_POST['product'];
    // Sepet durumunu al
    $cart = $_SESSION['cart'];
    // Yeni ürünü sepete ekle
    $cart[] = $product_price;
    // Sepet durumunu güncelle
    $_SESSION['cart'] = $cart;
}
// İndirim kodu işlemleri
if (isset($_POST['apply_discount'])) {
    $coupon_code = $_POST['coupon_code'];

    // İndirim kodu kullanılmadıysa ve doğru indirim kodu girildiyse
    if (!isset($_SESSION['discount_applied']) && $coupon_code === "sbrvtn50") {
        // Kısa bir süre bekletme 
        sleep(1);

        // Sepetin toplam tutarını sakla
        $_SESSION['old_total'] = isset($_SESSION['old_total']) ? $_SESSION['old_total'] : array_sum($_SESSION['cart']);
        
        // Toplam tutar 50 TL'den büyük veya eşitse, indirimi uygula
        if ($_SESSION['old_total'] >= 50) {
            $_SESSION['cart'][] = -50; // Sepete indirim olarak ekle
            sleep(1);
            $_SESSION['discount_applied'] = true; // İndirim uygulandı işareti
            $_SESSION['discount_amount'] = 50; // Uygulanan indirim miktarını sakla
            echo "<script>alert("<?php echo $strings['successful']; ?>")</script>";
        } else {
            echo "<script>alert("<?php echo $strings['warning']; ?>")</script>";
        }
    } else {
        echo "<scriptalert("<?php echo $strings['unsuccessful']; ?>")</script>";
    }
}

// İndirim kodu temizleme işlemi
if (isset($_POST['clear_discount'])) {
    unset($_SESSION['discount_applied']);
    $discount_amount = isset($_SESSION['discount_amount']) ? $_SESSION['discount_amount'] : 0;
    // Sepetten indirim miktarını çıkararak eski toplamı geri getir
    if ($discount_amount > 0) {
        $cart_index = array_search(-$discount_amount, $_SESSION['cart']);
        if ($cart_index !== false) {
            unset($_SESSION['cart'][$cart_index]);
            sleep(1);
        }
    }
    unset($_SESSION['discount_amount']); // İndirim miktarını temizle
    unset($_SESSION['old_total']); // Önceki toplamı temizle
    sleep(1);
    // İndirim uygulanmamış toplamı hesapla
    $old_total = isset($_SESSION['old_total']) ? $_SESSION['old_total'] : array_sum($_SESSION['cart']);
    
}




// Sepeti temizleme işlemi
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = []; // Sepeti boşalt

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Race Condition" ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .info-bar {
            background-color: #4caf50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .discount-code {
            margin-top: 20px;
        }

        .discount-code input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .discount-info {
            margin-top: 20px;
        }

        /* İndirim Yazısı Stili */
        .discount-message {
            margin-top: 10px;
            text-align: center;
            color: #4caf50;
        }
    </style>
</head>
<body>
    <!-- Bilgilendirme Mesajı -->
    <div class="info-bar">
    <?php echo $strings['text']; ?>
    </div>

    <div class="container">
    <h2><?php echo $strings['information']; ?></h2>
        <!-- Ürünler -->
        <div class="product">
        <h3><?php echo $strings['product1']; ?></h3>
            <form method="post">
                <input type="hidden" name="product" value="100">
                <button type="submit" name="add_to_cart" value="<?php echo $strings['add']; ?>"></button>
            </form>
        </div>

        <div class="product">
        <h3><?php echo $strings['product2']; ?></h3>
            <form method="post">
                <input type="hidden" name="product" value="150">
                <button type="submit" name="add_to_cart" value="<?php echo $strings['add']; ?>"></button>
            </form>
        </div>

        <div class="product">
        <h3><?php echo $strings['product3']; ?></h3>
            <form method="post">
                <input type="hidden" name="product" value="200">
                <button type="submit" name="add_to_cart" value="<?php echo $strings['add']; ?>"></button>
            </form>
        </div>

        <div>
            <form method="post">
                <button type="submit" name="clear_cart" value="<?php echo $strings['clr']; ?>"></button>
            </form>
        </div>

        <!-- İndirim Kodu -->
        <div class="discount-code">
            <form method="post">
                <label for="coupon_code" <?php echo $strings['code']; ?>>:</label>
                <input type="text" id="coupon_code" name="coupon_code">
                <button type="submit" name="apply_discount" value="<?php echo $strings['apply']; ?>"></button>
                <button type="submit" name="clear_discount" value="<?php echo $strings['clr2']; ?>"></button>
            </form>
        </div>

        <!-- İndirim Bilgisi ve Toplam -->
        <div class="discount-info">
            <?php
            if (isset($_SESSION['discount_applied']) && $_SESSION['discount_applied']) {
                echo "<p><?php echo $strings['discount']; ?> {$_SESSION['discount_amount']}<?php echo $strings['unit']; ?></p>";
            } elseif (isset($_SESSION['old_total'])) {
                echo "<p><?php echo $strings['oldamount']; ?>  {$_SESSION['old_total']} <?php echo $strings['unit']; ?></p>";
            }
            
            // Toplam tutarı hesapla ve göster
            $total = array_sum(array_filter($_SESSION['cart'], 'is_numeric')); 
            echo "<p>Toplam: $total TL</p>";
            ?>
            <!-- İndirim Kodu Mesajı -->
            <?php if (isset($_SESSION['discount_applied']) && $_SESSION['discount_applied'] && $_SESSION['discount_amount'] == 50) : ?>
                <p class="discount-message"><?php echo $strings['message']; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

