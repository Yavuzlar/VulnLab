<?php
    // User Page
    ob_start();
    session_start();

    $_SESSION['authority'] = "user";

    $db = new PDO('sqlite:database.db');

    require("../../../lang/lang.php");
    $strings = tr();

    $selectUser = $db -> prepare("SELECT * FROM csrf_follow WHERE authority=:authority");
    $selectUser -> execute(array('authority' => $_SESSION['authority']));
    $selectUser_Info = $selectUser -> fetch();

    $selectFollowers = $db -> prepare("SELECT * FROM csrf_follow WHERE follow_status=:follow_status");
    $selectFollowers -> execute(array('follow_status' => 'true'));
    $selectFollowers_Infos = $selectFollowers -> fetchAll(PDO::FETCH_ASSOC);

    if( isset($_GET['follow']) ){

        if( $selectUser_Info['follow_status'] == "false" ){

            $follow_update = $db -> prepare("UPDATE csrf_follow SET follow_status=:follow_status WHERE authority=:authority");
            $status_follow_update = $follow_update -> execute(array(
                'authority' => $_SESSION['authority'],
                'follow_status' => 'true'
            ));


            if($status_follow_update){
                header("Location: index.php?status=success"); 
                exit;
            }else{
                header("Location: index.php?status=unsuccess");
                exit;
            }

        }else{

            header("Location: index.php?status=following");
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

                    <div class="alert-box" id="alert-box">
                    <?php

                    if( isset($_GET['status']) ){
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
                        if($_GET['status'] == "following"){
                            echo '<div class="alert alert-danger mt-2" role="alert">'
                            .$strings['alert_following'].
                            '</div>';
                        }

                    }

                    ?>
                    </div>

                    <h3 class="mb-3"><?= $strings['middle_title']; ?> <?= $_SESSION['authority']; ?></h3>

                    <form action="index.php" method="get">
                        <div class="d-grid gap-2">
                            <label for="" class="form-label"><?= $strings['button_label']; ?></label>
                            <button class="btn btn-primary mb-4" type="submit" name="follow" id="follow" value="follow"><?= $strings['button']; ?></button>
                        </div>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col"><?= $strings['table_followers']; ?></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php
                                $id = 1;
                                foreach($selectFollowers_Infos as $selectFollowers_Info){
                                    echo '<tr class="text-center">
                                    <th scope="row">'.$id.'</th>
                                    <td>'.$selectFollowers_Info['authority'].'</td>
                                    </tr>';
                                    $id++;
                                }

                            ?>
                        </tbody>
                    </table>
                    
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
            url: 'followers.php',
            success: function(incoming) { 

                $('#tbody').html(incoming);

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