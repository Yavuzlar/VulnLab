<?php

require("../../../lang/lang.php");
$strings = tr();

$db = new PDO('sqlite:database.db');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
      
exec ('echo ' . $_SERVER["HTTP_USER_AGENT"] . ' >> /tmp/userAgent.log');

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <title><?php echo $strings['title']; ?></title>
</head>

<body>
    <div class="container">
        <div class=" d-flex justify-content-center " style="flex-direction: column;align-items:center;margin-top:20vh;">
            <div class="alert alert-info col-md-6  " role="alert" style="text-align:center;">
                <h5><?= $strings["text"]; ?></h5>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="tbl" style="margin-top: 30px;">

        </div>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="4" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>