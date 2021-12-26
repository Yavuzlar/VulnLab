<?php
    require("../../../lang/lang.php");
    $strings = tr();

    $db = new PDO('sqlite:database.db');

    $user_id = 1;
    $query = $db -> prepare("SELECT * FROM idor_money_transfer WHERE id=:user_id");
    $query -> execute(array(
        'user_id' => $user_id
    ));
    $active_row = $query -> fetch();
    $account_name = $active_row['name'];
    $account_money = $active_row['money']; //active account


    $query2 = $db -> prepare("SELECT * FROM idor_money_transfer");
    $query2 -> execute();
    $rows = $query2 -> fetchAll(PDO::FETCH_ASSOC); //table info 


    if( isset($_POST['transfer_amount']) && isset($_POST['recipient_id']) ){

        $transfer_amount = $_POST['transfer_amount'];
        $recipient_id = $_POST['recipient_id'];
        $sender_id = $_POST['sender_id'];

        $query3 = $db -> prepare("SELECT * FROM idor_money_transfer WHERE id=:sender_id");
        $query3 -> execute(array(
            'sender_id' => $sender_id
        ));
        $sender_row = $query3 -> fetch();
        $sender_money = $sender_row['money']; //sender_id account

        if( $transfer_amount > 0 ){
            if($sender_money >= $transfer_amount){
                // RECIPIENT TRANSACTIONS START
                $query4 = $db -> prepare("SELECT * FROM idor_money_transfer WHERE id=:recipient_id");
                $query4 -> execute(array(
                    'recipient_id' => $recipient_id
                ));
                $recipient_row = $query4 -> fetch();
                $recipient_money = $recipient_row['money']; //recipient_id account
    
                $new_recipient_money = $recipient_money + $transfer_amount;
    
    
                $query5 = $db -> prepare("UPDATE idor_money_transfer SET money=:new_recipient_money WHERE id=:recipient_id");
                $query5 -> execute(array(
                    'recipient_id' => $recipient_id,
                    'new_recipient_money' => $new_recipient_money
                ));
    
                $control5 = $query5 -> rowCount();
    
                if(!$control5){ // error id not found!
                    header("Location: index.php?message=no_id");
                    exit;
                }
                // RECIPIENT TRANSACTIONS END
    
    
                // SENDER TRANSACTIONS START
    
                $new_sender_money = $sender_money - $transfer_amount;
            
    
                $query6 = $db -> prepare("UPDATE idor_money_transfer SET money=:new_sender_money WHERE id=:sender_id");
                $query6 -> execute(array(
                    'sender_id' => $sender_id,
                    'new_sender_money' => $new_sender_money
                ));
    
                $control6 = $query6 -> RowCount();
    
                if($control6){ // success
                    header("Location: index.php?message=success");
                    exit;
                }
                // SENDER TRANSACTIONS END
       
            }else{
    
                header("Location: index.php?message=no_money");
                exit;
    
            }
        }else{
            header("Location: index.php?message=wrong_entry");
            exit;
        }

        
    }

?>


<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings['title']; ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    
    <div class="container">

        <div class="container-wrapper">
        
            <div class="row pt-4 mt-5 mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <h1><?= $strings['title']; ?></h1>

                    <a href="reset.php"><button type="button" href="" class="btn btn-secondary btn-sm"><?= $strings['reset_button']; ?></button></a>
                    
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row pt-2">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    
                    <div class="card border-primary mb-3">
                        <div class="card-header text-primary">
                            <?= $strings['card_name']; ?> <b> <?php echo $account_name; ?> </b> 
                            <br>
                            <?= $strings['card_money']; ?> <b> <?php echo $account_money; ?> <?= $strings['money_symbol']; ?> </b>
                        </div>
                    </div>

                    <h3 class="mb-3"><?= $strings['middle_title']; ?></h3>

                    <?php 
                        if( isset($_GET['message']) ){
                            if($_GET['message'] == "wrong_entry"){
                                echo '<div class="alert alert-danger mt-2" role="alert">'
                                .$strings['alert_wrong_entry'].
                                '</div>';
                            }
                            if($_GET['message'] == "success"){
                            echo '<div class="alert alert-success" role="alert"> <b>'.$strings['alert_success'].'</b> <br> </div>';
                            }
                            if($_GET['message'] == "no_id"){
                                echo '<div class="alert alert-danger" role="alert"> <b>'.$strings['alert_no_id'].'</b> <br> </div>';
                            }
                            if($_GET['message'] == "no_money"){
                                echo '<div class="alert alert-danger" role="alert"> <b>'.$strings['alert_no_money'].'</b> <br> </div>';
                            }
                        }
                    ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="transfer_amount" class="form-label"><?= $strings['transfer_input_label']; ?></label>
                            <input class="form-control" type="number" name="transfer_amount" id="transfer_amount" placeholder="<?= $strings['transfer_input_placeholder']; ?>" required>

                            <label for="recipient_id" class="form-label mt-3"><?= $strings['receiver_input_label']; ?></label>
                            <input class="form-control" type="number" name="recipient_id" id="recipient_id" placeholder="<?= $strings['receiver_input_placeholder']; ?>" required>

                            <input class="form-control" type="hidden" name="sender_id" value="<?php echo $user_id; ?>">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary mb-5" type="submit"><?= $strings['button']; ?></button>
                        </div>
                    </form>

                    <table class="table mb-5">
                        <thead>
                            <tr>
                                <th scope="col"><?= $strings['table_id']; ?></th>
                                <th scope="col"><?= $strings['table_name']; ?></th>
                                <th scope="col"><?= $strings['table_money']; ?></th>
                            </tr>
                        </thead>

                        <tbody>
            
                            <?php
                                foreach($rows as $row){
                                    echo "<tr>";
                                    echo "<td scope='col'>".$row['id']."</td>";
                                    echo "<td scope='col'>".$row['name']."</td>";
                                    echo "<td scope='col'>".$row['money'].' '.$strings['money_symbol']."</td>";
                                    echo "</tr>";
                    
                                }
                            ?>
            
                        </tbody>
                    </table>

                </div>
                <div class="col-md-3"></div>
            </div>

        </div>

    </div>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="3" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>


