<?php
    require("../../../lang/lang.php");
    $strings = tr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings['title'] ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>   
        <div class="col-md-6">
            <h1 class="mt-4 text-grey"><?= $strings['title'] ?></h1>
            <p class="mt-4"><button class="w-75 btn btn-primary" type="button" onclick="xmlLoad()"><?= $strings['button'] ?></button></p>
        </div>
        <div class="col-md-3"></div> 
    </div>
</div>

<script id="VLBar" title="<?= $strings['title']; ?>" category-id="5" src="/public/assets/js/vlnav.min.js"></script>

<script type="text/javascript">

function xmlLoad(){
  var xhttp = new XMLHttpRequest();
 
  xhttp.open("POST", "test.php", "true");
  xhttp.setRequestHeader("Content-type","text/xml; charset=UTF-8");
  xhttp.send( `
  <city><title>Karabuk</title><amount>293</amount></city>`);
}

</script>

</body>
</html>