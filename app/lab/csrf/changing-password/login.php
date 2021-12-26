<?php
    // Login Page
    session_start();

    if( isset($_SESSION['authority']) ){
        header("Location: index.php");
        exit;
    }

    $db = new PDO('sqlite:database.db');

    require("../../../lang/lang.php");
    $strings = tr();

    if( isset($_POST['username']) && isset($_POST['password']) ){

        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);


        $select = $db -> prepare("SELECT * FROM csrf_changing_password WHERE authority=:authority AND password=:password");
        $select -> execute(array('authority' => $username,'password' => $password));
        $_select = $select -> fetch();

        if( isset($_select['id']) ){
            $_SESSION['authority'] = $username;
            header("Location: index.php");
            exit;
        }else{
            $status = "unsuccess";
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

                        <?php
                            $selectUser = $db -> prepare("SELECT * FROM csrf_changing_password WHERE authority=:authority");
                            $selectUser -> execute(array('authority' => "user"));
                            $selectUser_Password = $selectUser -> fetch();
                        ?>

                        <?= $strings['card_username']; ?> <b>user</b>
                        <br>
                        <?= $strings['card_password']; ?> <b> <?= $selectUser_Password['password']?> </b>

                        </div>
                    </div>


                    <?php
                    if( isset($status) ){

                        if($status == "unsuccess"){
                            echo '<div class="alert alert-danger mt-2" role="alert">'
                            .$strings['login_unsuccess'].
                            '</div>';
                        }

                    }
                    ?>

                    <h3 class="mb-3"><?= $strings['login_middle_title']; ?></h3>

                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label"><?= $strings['login_input_username']; ?></label>
                            <input class="form-control" type="text" name="username" id="username"
                                placeholder="<?= $strings['login_input_username_label']; ?>" required>

                            <label for="password" class="form-label mt-2"><?= $strings['login_input_password']; ?></label>
                            <input class="form-control" type="text" name="password" id="password"
                                placeholder="<?= $strings['login_input_password_label']; ?>" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary mb-5" type="submit"><?= $strings['login_button']; ?></button>
                        </div>
                    </form>

                </div>
                <div class="col-md-3"></div>
            </div>

        </div>

    </div>
    
    
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="8" src="/public/assets/js/vlnav.min.js"></script>
    
</body>

</html>