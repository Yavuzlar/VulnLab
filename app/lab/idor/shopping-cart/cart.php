<?php
require("../../../lang/lang.php");
$strings = tr();

require 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $strings['title']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .showbox {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 200px;
            display: none;
            z-index: 1000;
        }

        .showbox .alert {
            margin-bottom: 0;
        }
    </style>
</head>
<body cz-shortcut-listen="true" style="background-color: #F8F9FD;">
    <section class="ftco-section">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div style=" display: flex;
                                align-items: center;">
                        <h4 class="mb-3" style="margin-right: 20px;"><?php echo $strings['balance'] . ' : $' . $globalBalance; ?></h4>
                        <a href="index.php" class="btn mb-3" style="background-color: #7ca8a6; color:#F8F9FD; margin-right: 15px;"><?php echo $strings['go_back']; ?></a>
                        <a href="verify.php" class="btn mb-3" style="background-color: #7ca8a6; color:#F8F9FD;"><?php echo $strings['buy_cart']; ?></a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th><?php echo $strings['table_product']; ?></th>
                                    <th><?php echo $strings['table_price']; ?></th>
                                    <th><?php echo $strings['piece']; ?></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $productsDB = $conn->prepare("SELECT * FROM products ORDER BY id");
                                $productsDB->execute();
                                $products = $productsDB->fetchAll(PDO::FETCH_ASSOC);
                                $title = "";
                                $details = "";
                                foreach ($products as $product) {
                                    if ($product["isCart"] == 0) {
                                        continue;
                                    }
                                    if($product["id"] == 1){
                                        $title = $strings["p1_title"];
                                        $details = $strings["p1_detail"];
                                    }else if($product["id"] == 2){
                                        $title = $strings["p2_title"];
                                        $details = $strings["p2_detail"];
                                    }else if($product["id"] == 3){
                                        $title = $strings["p3_title"];
                                        $details = $strings["p3_detail"];
                                    }
            
                                    echo ' <tr class="alert" role="alert" >
                                        <td>
                                        <div class="img" style="background-image: url(img/' . $product["imageName"] . '); width: 100px; height: 100px;"></div>
                                        </td>
                                        <td>
                                            <div class="email">
                                                <span>' . $title  . '</span>
                                                <span>' . $details . '</span>
                                            </div>
                                        </td>
                                        <td>$' . $product["price"] * $product["piece"] . '</td>
                                        <td>' . $product["piece"] . '</td>
                                        
                                        <td>
                                        <a href="delete.php?bm90IGhlcmU=' . $product["id"] . '" class="btn" style="background-color: #99B19C; color:#F8F9FD;">' . $strings["delete_button"] . '</a>
                                        </td>
                                        </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!---------------------------------------------- Alert Func -------------------------------------------------->

    <div class="showbox" id="notification">
        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'success') { ?>
            <div class="alert alert-success" role="alert">
            <?php echo $strings['alert_successDelete']; ?>
            </div>
        <?php }
        if (isset($_GET['mess']) && $_GET['mess'] == 'priceError') { ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $strings['alert_priceError']; ?>
            </div>
        <?php }
        if (isset($_GET['mess']) && $_GET['mess'] == 'emptyCart') { 
            ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $strings['alert_emptyCart']; ?>
            </div>
        <?php }
        if (isset($_GET['mess']) && $_GET['mess'] == 'buySuccess') { 
            ?>
            <div class="alert alert-success" role="alert">
            <?php echo $strings['alert_buySuccess']; ?>
            </div>
        <?php } elseif (isset($_GET['mess']) && $_GET['mess'] == 'deleteError') { ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $strings['alert_deleteError']; ?>
            </div>
        <?php } ?>

    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var notificationDiv = document.getElementById("notification");
            if (notificationDiv.children.length > 0) {
                notificationDiv.style.display = "block";
                setTimeout(function() {
                    notificationDiv.style.display = "none";
                }, 3000); 
            }
        });
    </script>
<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="11" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>