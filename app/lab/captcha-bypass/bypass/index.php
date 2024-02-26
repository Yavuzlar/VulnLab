<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../../../lang/lang.php");
$strings = tr();

session_start();

$message = '';
$httpStatus = 200;

if (!isset($_SESSION['num1'], $_SESSION['num2'])) {
    $_SESSION['num1'] = rand(1, 10);
    $_SESSION['num2'] = rand(1, 10);
}

function generateCaptchaImage($num1, $num2)
{
    $image = imagecreatetruecolor(150, 50);

    $bgColor = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $bgColor);

    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagestring($image, 5, 10, 15, "$num1 + $num2 = ?", $textColor);

    ob_start();
    imagepng($image);
    $image_data = ob_get_contents();
    ob_end_clean();

    return base64_encode($image_data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captchaAnswer = isset($_POST['captcha']) ? (int)$_POST['captcha'] : null;
    $num1_posted = isset($_POST['num1']) ? (int)$_POST['num1'] : null;
    $num2_posted = isset($_POST['num2']) ? (int)$_POST['num2'] : null;

    $oncekiNum1 = $_SESSION['num1'];
    $oncekiNum2 = $_SESSION['num2'];

    if (isset($num1_posted, $num2_posted)) {
        $captchaSonuc = $captchaAnswer == ($num1_posted + $num2_posted);

        $message = $captchaSonuc ? "basarili" : "basarisiz";

        if ($captchaSonuc) {
            $httpStatus = 200;
            $_SESSION['num1'] = rand(1, 10);
            $_SESSION['num2'] = rand(1, 10);
        } else {
            $httpStatus = 400;
            $_SESSION['num1'] = $oncekiNum1;
            $_SESSION['num2'] = $oncekiNum2;
        }
    } else {
        $message = $strings['basarisiz'];
    }
}

$num1 = isset($_POST['num1']) ? (int)$_POST['num1'] : $_SESSION['num1'];
$num2 = isset($_POST['num2']) ? (int)$_POST['num2'] : $_SESSION['num2'];

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
        .captcha-answer img {
            display: block;
        }

        .wrong-answer .captcha-answer img {
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
                        <textarea class="form-control" id="customMessage" name="customMessage" rows="3" placeholder="..."></textarea>
                    </div>
                    <div class="form-group <?php echo ($message === "basarisiz") ? 'wrong-answer' : ''; ?>">
                        <label for="captcha"><?= $strings['captcha']; ?> <br></label>
                        <div class="d-flex justify-content-between align-items-center captcha-answer" id="captcha-result">
                            <img src="data:image/png;base64,<?= generateCaptchaImage($num1, $num2) ?>" alt="Captcha Resmi" id="captcha-image">
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm refresh-button" id="refresh-button"><?= $strings['yenile']; ?></button>
                            </div>
                        </div> <br>
                        <input type="hidden" name="num1" id="num1" value="<?= $num1; ?>">
                        <input type="hidden" name="num2" id="num2" value="<?= $num2; ?>">
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="<?= $strings['captcha']; ?>" value="<?= isset($_POST['captcha']) ? htmlspecialchars($_POST['captcha']) : '' ?>">
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
        function generateCaptchaImage(num1, num2) {
            var image = document.createElement('canvas');
            image.width = 150;
            image.height = 45;

            var context = image.getContext('2d');
            context.fillStyle = '#ffffff';
            context.fillRect(0, 0, 150, 50);

            context.fillStyle = '#000000';
            context.font = '20px Arial';
            context.fillText(num1 + ' + ' + num2 + ' = ?', 10, 30);

            return image;
        }

        function refreshCaptcha() {
            var num1 = Math.floor(Math.random() * 10) + 1;
            var num2 = Math.floor(Math.random() * 10) + 1;

            var captchaImageContainer = document.getElementById('captcha-image');
            captchaImageContainer.src = generateCaptchaImage(num1, num2).toDataURL();

            document.getElementById('num1').value = num1;
            document.getElementById('num2').value = num2;

            document.getElementById('captcha').value = '';

            var errorMessageElement = document.getElementById('error-message');
            if (errorMessageElement) {
                errorMessageElement.innerHTML = '';
            }
        }

        function validateForm() {
            var captchaAnswer = document.getElementById('captcha').value;
            if (!captchaAnswer) {
                var errorMessage = '<?= $strings["empty"]; ?>';
                var errorMessageElement = document.getElementById('error-message');
                if (errorMessageElement) {
                    errorMessageElement.innerHTML = errorMessage;
                }
                return false;
            }

            var errorMessageElement = document.getElementById('error-message');
            if (errorMessageElement) {
                errorMessageElement.innerHTML = '';
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function () {

            <?php if ($message !== 'basarisiz') { ?>
                refreshCaptcha();
            <?php } ?>

            var refreshButton = document.getElementById('refresh-button');
            if (refreshButton) {
                refreshButton.addEventListener('click', function () {
                    refreshCaptcha();
                });
            }

            var errorMessageElement = document.getElementById('error-message');
            var message = '<?= $message; ?>';

            if (message === 'basarisiz' && errorMessageElement) {
                errorMessageElement.innerHTML = '<?= $strings["basarisiz"]; ?>';
            }
        });
    </script>
</body>

</html>