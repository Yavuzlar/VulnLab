<?php
require("../../../lang/lang.php");
$strings = tr();
$db = new PDO('mysql:host=localhost; dbname=sql_injection', 'sql_injection', '');

$id_limit = $db->query("SELECT COUNT(*) FROM images")->fetchColumn();

if (!isset($_GET['img'])) {
    header("Location: index.php?img=1");
    exit;
}

if (isset($_POST['next'])) {
    $next=$_GET['img'];
    $next += 1;
    if ($next > $id_limit) {
        $next = 1;
    }
    header("Location: index.php?img=" . $next . "");
    exit;
}
if (isset($_POST['prev'])) {
    $_GET['img'] -= 1;
    if ($_GET['img'] < 1) {
        $_GET['img'] = $id_limit;
    }
    header("Location: index.php?img=" . $_GET['img'] . "");
    exit;
}

if (isset($_GET['img'])) {
    $img = $_GET['img'];

    $user = $db->query("SELECT * FROM images WHERE id = $img");
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">

    <title><?php echo $strings['title']; ?></title>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="upper justify-content-center" style="text-align: center;margin: 2vh 0vh 6vh 0vh;">
                <h1>
                    <?php echo $strings['header']; ?>
                </h1>
                <form action="" method="POST" class="row justify-content-center" style="margin: 2vh 0vh 6vh 0vh;">
                    <div class="col-md-10 button-con row justify-content-evenly ">
                        <div class="bottom justify-content-center" style="text-align: center;">
                            <?php
                            if (isset($_GET['img'])) {

                                $error = $db->errorInfo();
                                if (!empty($error[2])) {
                                    echo $error[2];
                                } else {
                                    $data = $user->fetch();
                                }

                                if(isset($data)){
                                    echo '<img class="shadow bg-body rounded img-fluid" style="width:765px; height: 400px; object-fit: cover; padding : 0; margin-bottom: 0;" src="' . $data['path'] . '"/>';
                                }
                                
                            }
                            ?>
                        </div>
                        <div class="btn-group w-75 mt-3">
                            <button class="btn btn-primary" type="submit" name="prev"><?php echo $strings['back']; ?></button>
                            <button class="btn btn-warning" type="submit" name="next"><?php echo $strings['next']; ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="2" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>
