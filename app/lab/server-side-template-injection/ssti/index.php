<?php
    require("../../../lang/lang.php");
    $strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <title><?= $strings['title'] ?></title>
</head>
<body>

<div class="container mt-4">
        <div class="row text-center">
            <h1><?= $strings['titleTwo'] ?></h1>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
                        <button type="button" class="btn btn-outline-primary"><?= $strings['button'] ?></button>
                    </div>
                </form>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto mt-4 text-center">

            

            <?php

                use LDAP\Result;

                // require 'vendor/autoload.php';

                include 'vendor/twig/twig/lib/Twig/Autoloader.php';
                Twig_Autoloader::register();

                if(isset($_GET['search'])){
                    
                    $search = $_GET['search'];

                    try {
                        // specify where to look for templates
                        $loader = new Twig_Loader_String();
                        
                        // initialize Twig environment
                        $twig = new Twig_Environment($loader);
                    // set template variables
                    // render template
                    $result= $twig->render($search);
                    echo "<div class='alert alert-danger' role='alert'> "  . $result . $strings['result'] . " </div>";
                        
                    } catch (Exception $e) {
                        die ('ERROR: ' . $e->getMessage());
                    }

                }

            ?>

           

            </div>
        </div>
    </div>
    
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="11" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>