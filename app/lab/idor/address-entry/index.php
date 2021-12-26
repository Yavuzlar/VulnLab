<?php
    require("../../../lang/lang.php");
    $strings = tr();

    $db = new PDO('sqlite:database.db');

    $my_addressID = 1; //fixed address my_address

    $query = $db -> prepare("SELECT * FROM idor_address_entry WHERE id=:id");
    $query -> execute(array(
        'id' => $my_addressID
    ));
    $my_address = $query -> fetch();


    if( isset($_POST['update']) && isset($_POST['address']) ){

        if( !empty(trim($_POST['address'])) ){ //address not empty
            $update = $db -> prepare("UPDATE idor_address_entry SET address=:address WHERE id=:id");
            $update -> execute(array(
                'id' => $my_addressID,
                'address' => $_POST['address']
            ));
    
            $update_status = $update -> RowCount();
    
            if($update_status){ // success
                header("Location: index.php?msg=success");
                exit;
            }
        }else{
            $status = 1;
        }


    }

    if( isset($_POST['order']) ){

        if( empty(trim($my_address['address'])) ){ //if empty

            $status = 2;

        }else{

            $query = $db -> prepare("SELECT * FROM idor_address_entry WHERE id=:id");
            $query -> execute(array(
                'id' => $_POST['addressID']
            ));
            $order_address = $query -> fetch();

            $status = 3;

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
        
            <div class="row pt-5 mt-5 mb-3">
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
                        <?= $strings['card_my_name']; ?> <b> <?php echo $my_address['name']; ?> </b> 
                        <br>
                        <?= $strings['card_my_address']; ?> <b> <?php echo $my_address['address']; ?> </b> 
                        </div>
                    </div>

                    <h3 class="mb-3"><?= $strings['middle_title']; ?></h3>

                    <?php   
                        if( isset($_GET['msg']) ){
                            if($_GET['msg'] == "success"){
                                echo '<div class="alert alert-success" role="alert"> <b>'.$strings['alert_success'].'</b> </div>';
                            }
                        }

                        if( isset($status)){
                            if($status == 1){
                                echo '<div class="alert alert-warning" role="alert"> <b>'.$strings['alert_address_empty'].'</b> </div>';
                            }
                            elseif($status == 2){
                                echo '<div class="alert alert-warning" role="alert"> <b>'.$strings['alert_register_address'].'</b> </div>';
                            }
                            elseif($status == 3){
                                echo '<div class="alert alert-success" role="alert">  <b>'.$strings['alert_order_success'].'</b> <hr>'
                                .$strings['alert_order_address'].' <b> '.$order_address['address'].' </b> 
                                <br>'
                                .$strings['alert_order_name'].' <b> '.$order_address['name'].' </b> 
                                </div>';
                            }
                        }
                    ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="address" class="form-label"><?= $strings['textarea_label']; ?></label>
                            <textarea class="form-control" type="text" name="address" id="address" placeholder="<?= $strings['textarea_placeholder']; ?>"></textarea>
                            <input class="form-control" type="hidden" name="addressID" value="<?php echo $my_addressID; ?>">
                            
                        </div>
                        <div class="btn-group w-100 mb-5">
                            <button class="btn btn-warning" type="submit" name="update"><?= $strings['update_button']; ?></button>
                            <button class="btn btn-primary" type="submit" name="order"><?= $strings['order_button']; ?></button>
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


