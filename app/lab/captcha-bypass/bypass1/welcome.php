<?php require("../../../lang/lang.php");
$strings = tr();
session_start();

if ($_SESSION['dogrulama'] != true)
 {
   header("location:/lab/captcha-bypass/bypass1/index.php");
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>BYPASS BASARILI</title>
</head>
<body>
<h2 class="text-center"> <?php echo $strings['finish']; ?></h2>
</body>
</html>
<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>

