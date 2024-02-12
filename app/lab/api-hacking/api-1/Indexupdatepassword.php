<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Güncelleme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="width:97%; margin-top: 10%; ">
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
