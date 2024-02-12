<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="width:97%; margin-top: 10%; ">
        <h2><?php echo $strings["adminAccount"] ?></h2>
        <p><?php echo $strings["adminLogin"] ?></p>
        <p><?php echo $strings["welcomeSystem"] ?></p>
        <div class="update-password">
            <form action="Indexupdatepassword.php" method="GET">
            <input type="hidden" name="username" value="admin">
                <button type="submit"><?php echo $strings["updatePassword"] ?></button>
            </form>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>

