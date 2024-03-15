<?php
require("../../../lang/lang.php");
$strings = tr();

require 'conn.php';

if (isset($_GET['resetBalance'])) {
    $id = $balance['id']; //balance degeri conn.php den geliyor.
    $query = $conn->prepare("UPDATE temp SET balance=1000 WHERE id = ?");
    $query->execute(array($id));
    header("Location: index.php");
}
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
                        <h4 style="margin-right: 20px;" class=" mb-3"><?php echo $strings['balance'] . ' : $' . $globalBalance; ?></h4>
                        <a href="cart.php" class="btn mb-3" style="background-color: #7ca8a6; color:#F8F9FD;"><?php echo $strings['go_cart']; ?></a>
                        <a href="index.php?resetBalance=1" class="btn mb-3" style="background-color: #7ca8a6; color:#F8F9FD; margin-left: auto;"><?php echo $strings['reset_balance']; ?></a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th><?php echo $strings['table_product']; ?></th>
                                    <th><?php echo $strings['table_price']; ?></th>
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
                                    if ($product["id"] == 1) {
                                        $title = $strings["p1_title"];
                                        $details = $strings["p1_detail"];
                                    } else if ($product["id"] == 2) {
                                        $title = $strings["p2_title"];
                                        $details = $strings["p2_detail"];
                                    } else if ($product["id"] == 3) {
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
                                        <td>$' . $product["price"] . '</td>
                                        
                                        <td>
                                        <a href="add.php?bm90IGhlcmU=' . $product["id"] . '" class="btn" style="background-color: #99B19C; color:#F8F9FD;">' . $strings["add_button"] . '</a>
                                        </td>
                                        </tr>';
                                }
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---------------------------------------------- Alert Func -------------------------------------------------->
    <div class="showbox" id="notification">
        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'success') { ?>
            <div class="alert alert-success mb-2" role="alert">
                <?php echo $strings['alert_successAdd']; ?>
            </div>
        <?php }
        if (isset($_GET['text'])) { ?>
            <div class="alert alert-success mb-2" role="alert">
                <?php $text = $_GET['text'];
                      echo $strings['alert_purchased'] .$text; ?>
            </div>
        <?php }
        if (isset($_GET['flag']) && $_GET['flag'] == 'R3DT3AM') { ?>
            <div class="alert alert-success mb-2" role="alert">
                R3DT3AM
            </div>
        <?php } elseif (isset($_GET['mess']) && $_GET['mess'] == 'addError') { ?>
            <div class="alert alert-danger mb-2" role="alert">
                <?php echo $strings['alert_addError']; ?>
            </div>
        <?php } ?>
    </div>
    <!-- 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var notificationDiv = document.getElementById("notification");
            if (notificationDiv.children.length > 0) {
                notificationDiv.style.display = "block";
                setTimeout(function() {
                    notificationDiv.style.display = "none";
                }, 5000);
            }
        });
    </script>



    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="3" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>