<?php
    // User Page
    ob_start();
    session_start();

    $_SESSION['authority'] = "user";

    $db = new PDO('sqlite:database.db');

    require("../../../lang/lang.php");
    $strings = tr();


    $selectUser = $db -> prepare("SELECT * FROM csrf_money_transfer WHERE authority=:authority");
    $selectUser -> execute(array('authority' => $_SESSION['authority']));
    $selectUser_Info = $selectUser -> fetch();

    $selectUsers = $db -> prepare("SELECT * FROM csrf_money_transfer");
    $selectUsers -> execute();
    $selectUsers_Infos = $selectUsers -> fetchAll(PDO::FETCH_ASSOC);

    if( isset($_GET['transfer_amount']) && isset($_GET['receiver']) ){

        if( $_GET['transfer_amount'] > 0 ){

            if( $selectUser_Info['money'] >= $_GET['transfer_amount'] ){

                $sender_new_money = $selectUser_Info['money'] - $_GET['transfer_amount'];

                $sender_update = $db -> prepare("UPDATE csrf_money_transfer SET money=:money WHERE authority=:authority");
                $status_sender_update = $sender_update -> execute(array(
                    'authority' => $_SESSION['authority'],
                    'money' => $sender_new_money 
                ));
    
                $selectReceiver = $db -> prepare("SELECT * FROM csrf_money_transfer WHERE authority=:authority");
                $selectReceiver  -> execute(array('authority' => $_GET['receiver']));
                $selectReceiver_Info = $selectReceiver  -> fetch();
    
                $receiver_new_money = $selectReceiver_Info['money'] + $_GET['transfer_amount'];
    
                $receiver_update = $db -> prepare("UPDATE csrf_money_transfer SET money=:money WHERE authority=:authority");
                $status_receiver_update = $receiver_update -> execute(array(
                    'authority' => $_GET['receiver'],
                    'money' => $receiver_new_money
                ));
    
                if($status_receiver_update && $status_sender_update){
                    header("Location: index.php?status=success"); 
                    exit;
                }else{
                    header("Location: index.php?status=unsuccess");
                    exit;
                }
    
            }else{
    
                header("Location: index.php?status=no_money");
                exit;
    
            }

        }else{
            header("Location: index.php?status=wrong_entry");   
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/chat.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/typing.css">
</head>

<body>

    <div class="container">

        <div class="container-wrapper">

            <div class="row pt-4 mt-5 mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <h1><?= $strings['title']; ?></h1>

                    <a href="reset.php"><button type="button" class="btn btn-secondary btn-sm"><?= $strings['reset_button']; ?></button></a>

                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row pt-2">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <div class="card border-primary mb-3">
                        <div class="card-header text-primary">

                            <div class="user-money" id="user-money"> <!-- user-money -->
                            <?= $strings['card_money']; ?>  <b> <?= $selectUser_Info['money']; ?> <?= $strings['card_money_symbol']; ?> </b>
                            </div>

                        </div>
                    </div>

                    <div class="alert-box" id="alert-box">
                    <?php

                    if( isset($_GET['status']) ){
                        if($_GET['status'] == "wrong_entry"){
                            echo '<div class="alert alert-danger mt-2" role="alert">'
                            .$strings['alert_wrong_entry'].
                            '</div>';
                        }
                        if($_GET['status'] == "success"){
                            echo '<div class="alert alert-success mt-2" role="alert">'
                            .$strings['alert_success'].
                            '</div>';
                        }
                        if($_GET['status'] == "unsuccess"){
                            echo '<div class="alert alert-danger mt-2" role="alert">'
                            .$strings['alert_unsuccess'].
                            '</div>';
                        }
                        if($_GET['status'] == "no_money"){
                            echo '<div class="alert alert-danger mt-2" role="alert">'
                            .$strings['alert_no_money'].
                            '</div>';
                        }

                    }

                    ?>
                    </div>

                    
                    <h3 class="mb-3"><?= $strings['middle_title']; ?> <?= $_SESSION['authority']; ?></h3>

                    <form action="index.php" method="get">
                        <div class="mb-3">
                            <label for="transfer_amount" class="form-label"><?= $strings['input_label']; ?></label>
                            <input class="form-control" type="number" name="transfer_amount" id="transfer_amount"
                                placeholder="<?= $strings['input_placeholder']; ?>" required>
                        </div>

                        <label for="receiver" class="form-label"><?= $strings['select_input_label']; ?></label>
                        <div class="input-group mb-3">
                                <select class="form-select" id="receiver" name="receiver" aria-label="Example select with button addon">
                                    <option selected disabled><?= $strings['select_input_selected']; ?></option>
                                        <?php
                                            foreach($selectUsers_Infos as $selectUsers_Info){
                                                if($selectUsers_Info['authority'] == $_SESSION['authority']){
                                                    echo "<option value=".$selectUsers_Info['authority']." disabled>".$selectUsers_Info['authority']."</option>";
                                                }else{
                                                    echo "<option value=".$selectUsers_Info['authority'].">".$selectUsers_Info['authority']."</option>";
                                                }
                                                
                                            }

                                        ?>
                                </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary mb-5" type="submit"><?= $strings['button']; ?></button>
                        </div>
                    </form>

                </div>
                <div class="col-md-3"></div>
            </div>

        </div>

        <div class="chatbox">
            <div class="chatbox__support">

                <div class="chatbox__header">
                    <div class="chatbox__content--header">
                        <h4 class="chatbox__heading--header"><?= $strings['chatbox_heading']; ?></h4>
                        <p class="chatbox__description--header"><?= $strings['chatbox_description']; ?></p>
                    </div>
                </div>

                <div class="chatbox__messages" id="chatbox__messages"> 
                    <?php
                        $select = $db -> prepare("SELECT * FROM csrf_chat ORDER BY id DESC");
                        $select -> execute();
                        $db_messages = $select -> fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($db_messages as $db_message){
  
                            if($db_message['authority'] == "user"){
                                echo '<div class="messages__item messages__item--operator">'.$db_message['message'].'</div>';
                            }
                            if($db_message['authority'] == "admin"){
                                echo '<div class="messages__item messages__item--visitor">'.$db_message['message'].' <pre class="m-0 mt-1 text-danger">admin</pre> </div> ';
                            }
                            
                            }

                    ?>
                </div>

                <form method="post" id="form" onsubmit="return false">
                    <div class="chatbox__footer">
                        <input type="text" name="chat-input" id="chat-input" class="form-control" placeholder="<?= $strings['chatbox_footer_placeholder']; ?>" style="border-radius:30px;">
                        <input class="btn btn-warning mx-2" name="chat-button" style="border-radius:25px;" onclick="Post()" type="submit" value="<?= $strings['chatbox_footer_button']; ?>">
                    </div>
                </form>

            </div>
            <div class="chatbox__button">
            <button>button</button>
            </div>
        </div>

    </div>
    
    

    <script type="text/javascript">
    function Post() {
        $.ajax({
            type: 'POST',   
            url: 'post.php',  
            data: $('form#form').serialize(), 
            success: function(incoming) { 

                $('#chatbox__messages').html(incoming);

                document.getElementById("form").reset();
                
                Money();

            }
        });
    }

    function Money() {
        $.ajax({
            type: 'POST',   
            url: 'money.php',  
            success: function(incoming) { 

                $('#user-money').html(incoming);

            }
        });
    }
    </script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/Chat.js"></script>
    <script src="assets/js/app.js"></script>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="8" src="/public/assets/js/vlnav.min.js"></script>
    
</body>

</html>