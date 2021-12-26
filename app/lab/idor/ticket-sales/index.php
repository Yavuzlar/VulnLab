<?php
    
    require("../../../lang/lang.php");
    $strings = tr();

    $db = new PDO('sqlite:database.db');

    $query = $db -> prepare("SELECT * FROM idor_buy_tickets WHERE id=1");
    $query -> execute();
    $account = $query -> fetch();
    $money_in_account = $account['money'];
    $ticket_price = $account['ticket'];


    if( isset($_POST['amount']) ){
        
        if($_POST['amount'] <= 0){

            $message0 = '<div class="alert alert-danger" role="alert">'.$strings["alert_danger"].'</div>';
            
        }else{

            $total = (int)$_POST['ticket_money']*(int)$_POST['amount'];

            if($total < 0){
                $total = -1 * $total;
            }
            
            if( $account['money'] >= $total ){
                $money_in_account = $money_in_account - $total;
    
                $query2 = $db -> prepare("UPDATE idor_buy_tickets SET money=:new_money WHERE id=1");
                $update = $query2 -> execute(array(
                    'new_money' => $money_in_account
                ));
                
                if($update){
                    $message1 = '<div class="alert alert-success" role="alert"> <b>'.$strings["alert_success"].'</b> <br> <hr>'.
                    $strings["alert_number_of_tickets"].'<b> '.$_POST['amount'].'</b> <br>'.
                    $strings["alert_money"].'<b> '.$total.' '.$strings["money_symbol"].'</b> </div>';
                }
            }else{
                $message2 = '<div class="alert alert-danger" role="alert">'.$strings["alert_danger2"].'</div>';
            }

        }

    }


?>


<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings["title"]; ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    
    <div class="container">

        <div class="container-wrapper">
        
            <div class="row pt-5 mt-5 mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <h1> <?= $strings["title"]; ?> </h1>

                    <a href="reset.php"><button type="button" href="" class="btn btn-secondary btn-sm"><?= $strings["reset"]; ?></button></a>
                    
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row pt-2">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <div class="card border-primary mb-3">
                        <div class="card-header text-primary">
                            <?= $strings["ticket_price"]; ?> <b> <?php echo $ticket_price; ?> <?= $strings["money_symbol"]; ?> </b> 
                            <br>
                            <?= $strings["money_in_account"]; ?> <b> <?php echo $money_in_account; ?> <?= $strings["money_symbol"]; ?> </b>
                        </div>
                    </div>

                    <h3 class="mb-3"><?= $strings["middle_title"]; ?></h3>

                    <?php 
                    if( isset($message0) ){
                        echo $message0;
                    }
                    if( isset($message1) ){
                        echo $message1;
                    }
                    if( isset($message2) ){
                        echo $message2;
                    }
                    ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="amount" class="form-label"><?= $strings["input_label"]; ?></label>
                            <input class="form-control" type="number" name="amount" id="amount" placeholder="<?= $strings["input_placeholder"]; ?>" required>
                            <input class="form-control" type="hidden" name="ticket_money" value="<?php echo $ticket_price; ?>">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit"><?= $strings["button"]; ?></button>
                        </div>
                    </form>

                </div>
                <div class="col-md-3"></div>
            </div>

        </div>

    </div>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="3" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>


