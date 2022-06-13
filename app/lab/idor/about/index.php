<?php

require("../../../lang/lang.php");
$strings = tr();

try {
    $db = new PDO('sqlite:database.db');
} catch (PDOException $e) {
    echo $e->getMessage();
}
$cookiepath = "/";

ob_start();
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    $control = 1;
    setcookie("userid", "", time() - 3600, "$cookiepath");
} else {
    $userid = 3;
    $control = 0;
}

$query = $db->prepare("SELECT * FROM profiles WHERE id=?");
$query->execute([$userid]);
// row count
if ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $userid = $result['id'];
    $name = $result['namesurname'];
    $job = $result['job'];
    $about = $result['about'];
    $email = $result['email'];
    $phone = $result['phone'];
    $location = $result['location'];
    $picture_url = $result['picture_url'];
} else {
    $name = "";
    $job = "";
    $about = $strings['user_notfound'];
    $email = "";
    $phone = "";
    $location = "";
    $picture_url = "";
}
?>


<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings["title"]; ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>

    <div class="container">

        <div class="container-wrapper">
            <?php
            if ($control == 0) {
            ?>
                <div class="row pt-5 mt-5 mb-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <h1> <?= $strings["title"]; ?> </h1>

                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <div class="card border-primary mb-3 text-center">
                            <div class="card-header text-primary" style="color: #000 !important;">
                                <img src="./info/pp/<?= $picture_url ?>" alt="" class="rounded-circle" style="max-width: 150px;">
                                <br />
                                <h3><?= $name ?></h3>
                                <button class="btn btn-primary mt-3" id="about-button">
                                    <?= $strings["edit_profile"]; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php } else if ($control == 1) {
                include("./profiles.php");
            }
            ?>

        </div>

    </div>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="3" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>

<script>
    let about_button = document.getElementById('about-button');
    // when clicked about button go to the ./info/ with create cookie
    about_button.addEventListener('click', () => {
        document.cookie = "userid=<?= $userid ?>;path=<?= $cookiepath ?>";
        window.location.href = "./";
    });
</script>