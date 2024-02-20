<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings["login"] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="width:30%; margin-top: 5%;">
        <h2><?php echo $strings["login"] ?></h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username"><?php echo $strings["username"] ?></label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password"><?php echo $strings["password"] ?></label>
                <input type="password" id="password" name="password" required>
            </div>
            <button class="btn btn-primary" type="submit"><?php echo $strings["login"] ?></button>
            <p style="margin-top: 10px; font-weight: bold;"><?php echo $strings["defaultLogin"] ?><br>user / user</p>
        </form>
        <form action="reset.php" method="POST">
        <button class="btn btn-primary" type="submit" style="width: 200px;"><?php echo $strings["reset"] ?></button>
        </form>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
