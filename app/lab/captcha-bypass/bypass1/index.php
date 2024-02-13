<?php
session_start();
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


if (!isset($_SESSION['captchas'])) {
    $_SESSION['captchas'] = array();
}


$captcha = generateCaptcha();

array_push($_SESSION['captchas'], $captcha);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_captcha = $_POST['captcha'];
  
    if (in_array($submitted_captcha, $_SESSION['captchas'])) {
        echo "Giriş başarılı!";
        header("location:/lab/captcha-bypass/bypass1/welcome.php");
    } else {
        echo "Captcha doğrulaması başarısız!";
        
    }
}
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
                <form method="post" action="index.php">
                    Captcha:  <label id="yusufnas" for="captcha"><?php echo $captcha; ?></label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                    <button type="submit" class="btn btn-primary btn-block mt-3"> <?php echo $strings['button']; ?></button>
                </form>
            </div>
        </div>
    </div>

    
   
</body>
</html>
<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
