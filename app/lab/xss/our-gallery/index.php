<?php
require("../../../lang/lang.php");
$strings = tr();
function encodeB($char){

    $replace = array(urlencode("<"),urlencode(">"));
    $char=str_replace("<",urlencode("<"), $char);
    $encoded=str_replace(">",urlencode(">"), $char);
    return $encoded;

}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">

    <title><?php echo $strings['title']; ?></title>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="upper justify-content-center" style="text-align: center;margin: 2vh 0vh 6vh 0vh;">
                <h3><?php echo $strings['text']; ?></h3>
                <form action="#" method="get" class="row justify-content-center" style="margin: 2vh 0vh 6vh 0vh;">
                    <div class="col-md-10 button-con row justify-content-evenly ">
                        <button class="col-md-2 btn btn-primary" type="submit" name="img" value="1"><?php echo $strings['image']; ?></button>
                        <button class="col-md-2 btn btn-primary" type="submit" name="img" value="2"><?php echo $strings['image']; ?></button>
                        <button class="col-md-2 btn btn-primary" type="submit" name="img" value="3"><?php echo $strings['image']; ?></button>
                        <button class="col-md-2 btn btn-primary" type="submit" name="img" value="4"><?php echo $strings['image']; ?></button>
                    </div>
                </form>
            </div>
            <div class="bottom justify-content-center" style="text-align: center;">
                <?php
                if (isset($_GET['img'])) {
                    echo '<img class="shadow-lg bg-body rounded" style="width:500px;padding : 0; margin-bottom: 0;" src="' . encodeB($_GET['img']) . '.jpg"/>';
                }
                ?>
            </div>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>