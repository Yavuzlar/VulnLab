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
    <div class="container d-flex justify-content-center p-4">
        <div class="wrapper d-flex flex-column justify-content-center align-items-center shadow rounded p-5 mb-5" style="margin-top: 15vh;max-width: 50vw;">
            <div class="headerx row">
                <h4><?php echo $strings['text']; ?></h4>
            </div>
            <div class="bodyx row p-4">
                <form action="#" method="get" class="">
                    <label for="name" class="form-label"><?php echo $strings['name']; ?></label>
                    <input type="text" name="name" class="form-control">
                    <button type="submit" class="btn btn-success " style="margin-top: 10px;"><?php echo $strings['button']; ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center ">
        <?php
        if (isset($_GET['name'])) {
            $ticketname = $_GET['name'];
            $ticketname = encodeB($ticketname);
            echo '<div class="ticket alert alert-primary" style="max-width: 50vw;"><h6><a href="ticket.php?name=' . $ticketname . '"> ' . $strings['gate'] . ' </a></h6></div>';
        }


        ?>

    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>