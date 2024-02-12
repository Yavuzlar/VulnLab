<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../../../lang/lang.php");
$strings = tr();

session_start();

$message = '';
$httpStatus = 200; 

if (!isset($_SESSION['num1'], $_SESSION['num2']) || empty($_POST)) {
    $_SESSION['num1'] = rand(1, 10);
    $_SESSION['num2'] = rand(1, 10);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = isset($_POST['captcha']) ? (int)$_POST['captcha'] : null;
    $num1_posted = isset($_POST['num1']) ? (int)$_POST['num1'] : null;
    $num2_posted = isset($_POST['num2']) ? (int)$_POST['num2'] : null;

    $oncekiNum1 = $_SESSION['num1'];
    $oncekiNum2 = $_SESSION['num2'];

    $_SESSION['num1'] = rand(1, 10);
    $_SESSION['num2'] = rand(1, 10);

    if (isset($num1_posted, $num2_posted)) {
        $captchaSonuc = $captchaAnswer == ($num1_posted + $num2_posted);

        $message = $captchaSonuc ? "basarili" : "basarisiz";

        if ($captchaSonuc) {
            $httpStatus = 200; 
        } else {
            $httpStatus = 400; 
            $_SESSION['num1'] = $oncekiNum1;
            $_SESSION['num2'] = $oncekiNum2;
        }
    } else {
        $message = $strings['basarisiz'];
    }
}

$num1 = $_SESSION['num1'];
$num2 = $_SESSION['num2'];

$sum = $num1 + $num2;

http_response_code($httpStatus);
?>

<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .captcha-answer {
            display: block;
        }

        .wrong-answer .captcha-answer {
            display: block;
        }

        .refresh-button {
            float: right;
        }
    </style>
    <title><?= $strings['title']; ?></title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4"><?= $strings['message']; ?></h2>
                <form method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="username"><?= $strings['name']; ?></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="customMessage"><?= $strings['sendmessage']; ?></label>
                        <textarea class="form-control" id="customMessage" name="customMessage" rows="3"
                            placeholder="..."></textarea>
                    </div>
                    <div class="form-group <?php echo ($message === "basarisiz") ? 'wrong-answer' : ''; ?>">
    <label for="captcha"><?= $strings['captcha']; ?> <br></label>
    <div class="d-flex justify-content-between align-items-center">
        <?php
        echo '<div class="captcha-answer" id="captcha-result"><label>' . $num1 . ' + ' . $num2 . ' = ?</label></div>';
        ?>
        <div>
            <button type="button" class="btn btn-secondary btn-sm" onclick="refreshCaptcha()"><?= $strings['yenile']; ?></button>
        </div>
    </div>
    <input type="hidden" name="num1" value="<?= $num1; ?>">
    <input type="hidden" name="num2" value="<?= $num2; ?>">
    <input type="text" class="form-control" id="captcha" name="captcha"
        placeholder="<?= $strings['captcha']; ?>" value="<?= isset($_POST['captcha']) ? htmlspecialchars($_POST['captcha']) : '' ?>">
</div>
                    <button type="submit" class="btn btn-primary btn-block"><?= $strings['submit']; ?></button>
                    <?php
                    if ($message === "basarili") {
                        echo '<p class="mt-3 text-success">' . $strings['basarili'] . '</p>';
                    } elseif ($message === "basarisiz") {
                        echo '<p id="error-message" class="mt-3 text-danger">' . $strings['basarisiz'] . '</p>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
    <script>
       function refreshCaptcha() {
    var newNum1 = Math.floor(Math.random() * 10) + 1;
    var newNum2 = Math.floor(Math.random() * 10) + 1;

    document.getElementById('captcha-result').innerHTML = newNum1 + ' + ' + newNum2 + ' = ?';

    document.getElementsByName('num1')[0].value = newNum1;
    document.getElementsByName('num2')[0].value = newNum2;

    document.getElementById('captcha').value = '';

    document.getElementById('error-message').innerHTML = '';
}

 function validateForm() {
    var captchaAnswer = document.getElementById('captcha').value;
    if (!captchaAnswer) {
        // 'empty' ifadesini kullanarak mesajı al
        var errorMessage = '<?= $strings["empty"]; ?>';
        document.getElementById('error-message').innerHTML = errorMessage;
        return false;
    }
    return true;
 }
    </script>
</body>
</html>
