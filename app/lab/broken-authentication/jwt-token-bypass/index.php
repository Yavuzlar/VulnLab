<?php
require("../../../lang/lang.php");
$strings = tr();
require_once("DBconnect.php"); 
require_once('config.php'); 
$jwt = (new JWT); 
$q = array(); 
$error = null;
if (isset($_COOKIE['auth_type'])) { 
    if ($validate = $jwt->is_valid($_COOKIE['auth_type'])) { 
        $jwt->get_username($_COOKIE['auth_type']);
    } else{
        $error=TRUE;
    }
} else { 
    header("Location: login.php"); 
    exit; 
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

    <title><?= $strings["title"]; ?></title>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="shadow p-3 mb-5 rounded column" style="text-align: center; max-width: 1000px;margin-top:15vh;">
            <h3><?= $strings["login"]; ?></h3>

            <form action="#" method="POST" class="justify-content-center" style="text-align: center;margin-top: 20px;padding:30px;">
                <div class="justify-content-center row mb-3">
                        <?php 
                        if(is_null($error)){
                            echo $jwt->get_username($_COOKIE['auth_type']);

                        ?>
                    <div class="col-sm-10">
                    <label for="inputUsername3" class=" text-center col-form-label"><?= $strings["look"]?></label>
                    </div>
                        <?php
                            } else{
                                echo $strings["error"];
                            }
                        ?>
                </div>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="10" src="/public/assets/js/vlnav.min.js"></script>


</body>

</html>