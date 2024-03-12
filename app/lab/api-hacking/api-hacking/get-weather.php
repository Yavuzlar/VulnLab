<?php

require("../../../lang/lang.php");
$strings = tr();

$city = $_GET['city'];
if (empty($city)) {
    echo $strings['please'];
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings['weather']?> - <?php echo $city; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        iframe {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title"><?php echo $city; ?> <?php echo $strings['for']?></h1>
            </div>
            <div class="card-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="api.php?city=<?php echo $city; ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


