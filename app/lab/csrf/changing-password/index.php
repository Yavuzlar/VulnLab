<?php
    // User Page
    ob_start();
    session_start();

    if( !isset($_SESSION['authority']) ){
        header("Location: login.php");
        exit;
    }
    
    $db = new PDO('sqlite:database.db');

    require("../../../lang/lang.php");
    $strings = tr();

    $selectUser = $db -> prepare("SELECT * FROM csrf_changing_password WHERE authority=:authority");
    $selectUser -> execute(array('authority' => "user"));
    $selectUser_Password = $selectUser -> fetch();

    $selectAdmin = $db -> prepare("SELECT * FROM csrf_changing_password WHERE authority=:authority");
    $selectAdmin -> execute(array('authority' => "admin"));
    $selectAdmin_Password = $selectAdmin -> fetch();

    if( isset($_GET['new_password']) && isset($_GET['confirm_password']) ){
        if( $_GET['new_password'] == $_GET['confirm_password'] ){

            $insert = $db -> prepare("UPDATE csrf_changing_password SET password=:password WHERE authority=:authority");
            $status_insert = $insert -> execute(array(
                'authority' => $_SESSION['authority'],
                'password' => $_GET['new_password']
            ));

            if($status_insert){
                header("Location: index.php?status=success"); 
                exit;
            }else{
                header("Location: index.php?status=unsuccess");
                exit;
            }

        }else{

            header("Location: index.php?status=not_the_same");
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
                    <a href="logout.php"><button type="button" class="btn btn-danger btn-sm"><?= $strings['logout_button']; ?></button></a>

                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row pt-2">
                <div class="col-md-3"></div>
                <div class="col-md-6">

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
                        if($_GET['status'] == "not_the_same"){
                            echo '<div class="alert alert-danger mt-2" role="alert">'
                            .$strings['alert_not_the_same'].
                            '</div>';
                        }
                    }
                ?>

                    <h3 class="mb-3"><?= $strings['middle_title']; ?> <?= $_SESSION['authority']; ?></h3>

                    <form action="index.php" method="get">
                        <div class="mb-3">
                            <label for="new_password" class="form-label"><?= $strings['new_password_input']; ?></label>
                            <input class="form-control" type="text" name="new_password" id="new_password"
                                placeholder="<?= $strings['new_password_input_placeholder']; ?>" required>

                            <label for="confirm_password" class="form-label mt-2"><?= $strings['confirm_password_input']; ?></label>
                            <input class="form-control" type="text" name="confirm_password" id="confirm_password"
                                placeholder="<?= $strings['confirm_password_input_placeholder']; ?>" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary mb-5" type="submit"><?= $strings['confirm_button']; ?></button>
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

                            if($_SESSION['authority'] == "user"){
                                if($db_message['authority'] == "user"){
                                    echo '<div class="messages__item messages__item--operator">'.$db_message['message'].'</div>';
                                }
                                if($db_message['authority'] == "admin"){
                                    
                                    echo '<div class="messages__item messages__item--visitor">'.$db_message['message'].' <pre class="m-0 mt-1 text-danger">admin</pre> </div> ';
    
                                }
                            }

                            if($_SESSION['authority'] == "admin"){
                                if($db_message['authority'] == "admin"){
                                    echo '<div class="messages__item messages__item--operator">'.$db_message['message'].'</div>';
                                }
                                if($db_message['authority'] == "user"){
                                    
                                    echo '<div class="messages__item messages__item--visitor">'.$db_message['message'].'<pre class="m-0 mt-1 text-danger">user</pre></div> ';
    
                                }
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