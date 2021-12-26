<?php 
    error_reporting(0);
    require("../../../lang/lang.php");
    $strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <title><?php echo $strings['title']; ?></title>
    <style>
        p{
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-wrapper">
            <div class="row pt-5">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="index.php" method="GET">
                        <div class="mb-3">
                            <label for="country" class="form-label"><?php echo $strings['label']; ?></label>
                            <select name="country" id="country" class="form-select">
                                <option value="france.php"><?php echo $strings['paris']; ?></option>
                                <option value="germany.php"><?php echo $strings['berlin']; ?></option>
                                <option value="north_korea.php"><?php echo $strings['pyongyang']; ?></option>
                                <option value="turkey.php"><?php echo $strings['ankara']; ?></option>
                                <option value="england.php"><?php echo $strings['london']; ?></option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit"><?php echo $strings['button']; ?></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="mb-3">
                    <p><?php 
                        if(isset($_GET['country'])){
                            $page = $_GET['country'];
                            $page = str_replace( array( "http://", "https://" ), "", $page ); 
                            $page = str_replace( array( "../", "..\"" ), "", $page );
                            include($page);
                        }
                    ?>
                    </p>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="6" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>