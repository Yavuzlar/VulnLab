<?php
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings["passwordUpdated"] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container" style="width: 500px; margin-top: 10%; ">
        <h2><?php echo $strings["SuccesfulPassword"] ?></h2>
        <p><?php echo $strings["NewSuccesfulPassword"] ?></p>
        <form action="login.php" method="POST">
            <button type="submit"><?php echo $strings["logOut"] ?></button>
        </form>
    </div>
    <script id="VLBar" title="title" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>