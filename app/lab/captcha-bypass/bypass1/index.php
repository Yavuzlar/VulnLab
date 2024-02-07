<?php
session_start();
session_unset();
require("../../../lang/lang.php");
$strings = tr();

function generateCaptcha() {
    $length = 8; 
    $captcha = '';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    for ($i = 0; $i < $length; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $captcha;
}


$captcha = generateCaptcha();
$_SESSION['captcha'] = $captcha;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha Doğrulama</title>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center"> <?php echo $strings['text']; ?></h2>
                <form method="post" action="dogrulama.php">
                Captcha:  <label id="yusuf" for="captcha"><?php echo $captcha; ?></label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                    <button type="submit" class="btn btn-primary btn-block mt-3"> <?php echo $strings['button']; ?></button>
                </form>
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>

<script>
    
    function sayfaYenile() {
      location.reload(); 
    }

    
    setInterval(sayfaYenile, 2000); // 2000 milisaniye = 2 saniye
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
  </script>
  