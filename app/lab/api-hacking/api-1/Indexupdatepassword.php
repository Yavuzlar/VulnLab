<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings["updatePassword"] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 500px; margin: 10% auto;">
        <h2><?php echo $strings["updatePassword"] ?></h2>
        <p><?php echo $strings["enterNewPassword"] ?></p>
        <form action="updatepassword.php" method="POST">
        <input type="hidden" name="username" value="<?php echo isset($_REQUEST['username']) ? $_REQUEST['username'] : 'default_username'; ?>">
            <input type="text" name="newpassword" placeholder="Yeni Şifre" required><br>
            <button type="submit"><?php echo $strings["updatePassword"] ?></button>
        </form>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
