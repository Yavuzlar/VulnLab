<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordinary panel of ordinary people</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="width:97%; margin-top: 10%; ">
        <h2><?php echo $strings["userAccount"] ?></h2>
        <p><?php echo $strings["userLogin"] ?></p>
        <p><?php echo $strings["welcomeSystem"] ?></p>
        <div class="update-password">
            <form action="Indexupdatepassword.php" method="GET">
            <input type="hidden" name="username" value="test">
                <button type="submit"><?php echo $strings["updatePassword"] ?></button>
            </form>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
