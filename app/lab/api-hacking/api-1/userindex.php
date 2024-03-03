<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings["userAccount"] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 500px; margin: 10% auto;">
        <h2><?php echo $strings["userAccount"] ?></h2>
        <p><?php echo $strings["userLogin"] ?></p>
        <p><?php echo $strings["welcomeSystem"] ?></p>
        <div class="update-password">
            <form action="Indexupdatepassword.php" method="POST">
            <input type="hidden" name="username" value="user">
                <button type="submit"><?php echo $strings["updatePassword"] ?></button>
            </form>
            <a href="index.php" class="btn mt-3" style="background-color: #f00c3d;color: white; width:250px;"><?php echo $strings["logOut"] ?></a>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
