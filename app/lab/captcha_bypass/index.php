<?php
require("../../lang/lang.php");
$strings = tr();

session_start(); 

$message = '';

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$sum = $num1 + $num2;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = $_POST['captcha'];
    $num1_posted = $_POST['num1'];
    $num2_posted = $_POST['num2'];
    $time_loaded = $_SESSION['time_loaded']; 

    $time_now = time();
    $time_diff = $time_now - $time_loaded;

    if ($time_diff < 1 && $captchaAnswer == ($num1_posted + $num2_posted)) {
        $message = "basarili";
    } else {
        $message = "basarisiz";
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $sum = $num1 + $num2;
    }
}

$imageText = "$num1 + $num2 = ?";
$image = imagecreatetruecolor(120, 40);
$bgColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
imagestring($image, 5, 10, 12, $imageText, $textColor);

ob_start();
imagepng($image);
$imageData = ob_get_clean();
imagedestroy($image);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Captcha Bypass</title>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f8f9fa;
    }
    .login-form {
      max-width: 400px;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="login-form">
    <h2 class="text-center mb-4"><?php echo $strings['message']; ?></h2>
    <form method="post">
      <div class="form-group">
        <label for="username"><?php echo $strings['name']; ?></label>
        <input type="text" class="form-control" id="username" name="username" placeholder="...">
      </div>
      <div class="form-group">
        <label for="customMessage"><?php echo $strings['sendmessage']; ?></label>
        <textarea class="form-control col" id="customMessage" name="customMessage" rows="3" placeholder="..."></textarea>
      </div>
      <div class="form-group">
        <label for="captcha"><?php echo $strings['captcha']; ?> <br></label>
        <img src="data:image/png;base64,<?php echo base64_encode($imageData); ?>" alt="Captcha Image"><br><br>
        <input type="hidden" name="num1" value="<?php echo $num1; ?>">
        <input type="hidden" name="num2" value="<?php echo $num2; ?>">
        <?php $_SESSION['time_loaded'] = time(); ?> 
        <input type="text" class="form-control" id="captcha" name="captcha">
      </div>
      <button type="submit" class="btn btn-primary btn-block"><?php echo $strings[$message]; ?></button>
      <p class="mt-3"><?php echo $message; ?></p>
    </form>
  </div>
</body>
</html>
