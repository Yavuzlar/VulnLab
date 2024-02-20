<?php
session_start();
require("../../../lang/lang.php");
$strings = tr();


$db = new PDO('sqlite:comment.db');

$stmt1 = $db->prepare("SELECT id FROM comments WHERE id IN (1, 2)");
$stmt1->execute();
$selected_ids = $stmt1->fetchAll(PDO::FETCH_COLUMN);


if (count($selected_ids) != 2) {


    $stmt2 = $db->prepare("INSERT INTO comments (id, comment) VALUES (:id, :comment)");


    $comments = [$strings['comment1'], $strings['comment2']];
    $ids = [1, 2];
    foreach ($comments as $index => $comment) {
        $stmt2->bindParam(':id', $ids[$index]);
        $stmt2->bindParam(':comment', $comment);
        $stmt2->execute();
    }
}

$results = $db->prepare("SELECT comment FROM comments");
$results->execute();




function generateCaptcha($width, $height, $length = 6)
{

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $captcha = '';
    $image = imagecreatetruecolor($width, $height);


    $bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
    imagefill($image, 0, 0, $bgColor);

    for ($i = 0; $i < 500; $i++) {
        $pointColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imagesetpixel($image, rand(0, $width), rand(0, $height), $pointColor);
    }


    for ($i = 0; $i < 10; $i++) {
        $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
    }


    for ($i = 0; $i < $length; $i++) {
        $char = $characters[rand(0, $charactersLength - 1)];
        $captcha .= $char;
        $textColor = imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));
        imagestring($image, 5, 30 * $i + 10, rand(10, 20), $char, $textColor);
    }


    $imagePath = 'captcha.png';
    imagepng($image, $imagePath);
    imagedestroy($image);

    return array('captcha' => $captcha, 'imagePath' => $imagePath);
}


$captchaData = generateCaptcha(200, 50);
$captchaValue = $captchaData['captcha'];
$captchaImagePath = $captchaData['imagePath'];

if (!isset($_SESSION['captchas'])) {
    $_SESSION['captchas'] = array();
}

if (!isset($_SESSION['input'])) {
    $_SESSION['input'] = false;
}



array_push($_SESSION['captchas'], $captchaValue);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_captcha = $_POST['captcha'];
    $_SESSION['input'] = true;

    if (in_array($submitted_captcha, $_SESSION['captchas'])) {
        $comment = $_POST['user_comment'];
        $stmt = $db->prepare("INSERT INTO comments (comment) VALUES (:comment)");
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        header("location:/lab/captcha-bypass/bypass1/index.php?success=1");
        exit();
    } else {
        header("location:/lab/captcha-bypass/bypass1/index.php?error=1");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Captcha Bypass"; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: bold;
        }

        .captcha-container {
            text-align: center;
            margin-top: 20px;
        }

        .captcha-image {
            margin-bottom: 10px;
        }

        .table-container {
            margin-top: 50px;
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            border: none;
            padding: 12px 15px;
            text-align: left;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-submit {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-submit:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            border-radius: 10px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2 class="form-title"><?php echo $strings['text']; ?></h2>
                <?php if ($_GET["error"] == 1 && $_SESSION["input"]) : ?>
                    <div class='alert alert-danger text-center' role='alert'>
                        <strong><?php echo $strings['notfinish']; ?></strong>
                        <?php $_SESSION['input'] = false; ?>
                    </div>
                <?php elseif ($_GET["success"] == 1 && $_SESSION["input"]) : ?>
                    <div class='alert alert-success text-center' role='alert'>
                        <strong><?php echo $strings['finish']; ?></strong>
                        <?php $_SESSION['input'] = false; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="index.php" class="post">
                    <div class="form-group">
                        <label for="user_comment"><?php echo $strings['comment']; ?></label>
                        <textarea class="form-control" id="user_comment" name="user_comment" rows="4" placeholder="<?php echo $strings['herecomment']; ?>"></textarea>
                    </div>
                    <div class="captcha-container">
                        <img src="<?= $captchaImagePath ?>" alt="Captcha Resmi" class="captcha-image"><br>
                        <input placeholder="<?php echo $strings['captcha']; ?>" type="text" class="form-control" id="captcha" name="captcha" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 btn-submit"><?php echo $strings['button']; ?></button>
                </form>
            </div>
        </div>
    </div>

    <div class="container table-container">
        <form method="post" action="reset_table.php" style="margin-bottom: 8px">
            <button type="submit" class="btn btn-danger"><?php echo $strings['reset']; ?></button>
        </form>
        <table class='table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo $strings['comments']; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $index => $comment) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($comment['comment']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>


<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>