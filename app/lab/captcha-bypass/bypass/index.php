<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../../../lang/lang.php");
$strings = tr();

session_start();

$message = '';

// Yeni captcha değerlerini sadece sayfa ilk yüklendiğinde veya sayfa yenilendiğinde session'a kaydet
if (!isset($_SESSION['num1'], $_SESSION['num2'], $_SESSION['time_loaded'])) {
    $_SESSION['num1'] = rand(1, 10);
    $_SESSION['num2'] = rand(1, 10);
    $_SESSION['time_loaded'] = time();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = isset($_POST['captcha']) ? $_POST['captcha'] : null;
    $num1_posted = isset($_POST['num1']) ? $_POST['num1'] : null;
    $num2_posted = isset($_POST['num2']) ? $_POST['num2'] : null;

    if (isset($_SESSION['time_loaded']) && isset($num1_posted, $num2_posted)) {
        $time_loaded = $_SESSION['time_loaded'];
        $captchaResult = $captchaAnswer == ($num1_posted + $num2_posted);

        // Form gönderildiğinde captcha'yı güncelle
        $_SESSION['num1'] = rand(1, 10);
        $_SESSION['num2'] = rand(1, 10);
        $_SESSION['time_loaded'] = time();

        if ($captchaResult) {
            $message = "basarili";
        } else {
            $message = "basarisiz";
        }
    } else {
        $message = "indeks_tanimsiz";
    }
}

$num1 = isset($_SESSION['num1']) ? $_SESSION['num1'] : rand(1, 10);
$num2 = isset($_SESSION['num2']) ? $_SESSION['num2'] : rand(1, 10);

$sum = $num1 + $num2;
$imageText = "$num1 + $num2 = ?";
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
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="3" src="/public/assets/js/vlnav.min.js"></script>
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
            <textarea class="form-control col" id="customMessage" name="customMessage" rows="3"
                      placeholder="..."></textarea>
        </div>
        <div class="form-group">
            <label for="captcha"><?php echo $strings['captcha']; ?> <br></label>
            <?php
            if ($message !== "basarisiz") {
                // Yanlış cevap durumunda captcha'yı ekrana basma
                echo '<span>' . $imageText . '</span><br><br>';
            }
            ?>
            <input type="hidden" name="num1" value="<?php echo $num1; ?>">
            <input type="hidden" name="num2" value="<?php echo $num2; ?>">
            <input type="text" class="form-control" id="captcha" name="captcha">
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?php echo $strings['submit']; ?></button>
        <?php
        if ($message === "indeks_tanimsiz") {
            echo '<p class="mt-3">Hata: Form indeksleri tanımsız!</p>';
        } else {
            if ($message === "basarili") {
                echo '<p class="mt-3 text-success">' . $strings['basarili'] . '</p>';
            } else {
                echo '<p class="mt-3 text-danger">' . $strings['basarisiz'] . '</p>';
            }
        }
        ?>
    </form>
</div>
</body>
</html>
