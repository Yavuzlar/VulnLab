<?php
require("../../../lang/lang.php");
$strings = tr();

$db = new PDO('sqlite:database.db');

?>
<!DOCTYPE html>
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
    <div class="alert alert-primary d-flex justify-content-center" style="text-align: center;width: fit-content;margin: auto;margin-top: 3vh;">
        <h6><?php echo $strings['text']; ?></h6>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="wrapper col-md-6  shadow-lg" style="border-radius: 15px; margin-top: 4vh;">
            <div class="shadow-sm m-2 scrollspy-example chat-log d-flex flex-column justify-content-end align-items-end overflow-auto" style="min-height: 350px;border: rgb(206, 206, 206) 1px solid; border-radius: 15px;" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0">
                <?php
                session_start();
                if (!isset($_SESSION['username'])) {
                    header("Location: index.php");
                    exit;
                }
                $uname = $_SESSION['username'];

                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $q = $db->query("SELECT * FROM mandalorian_content");

                if ($q) {
                    while ($cikti = $q->fetch(PDO::FETCH_ASSOC)) {

                        echo '<div class="msg col-md-6 m-3 px-4 bg-primary text-wrap " style="border-radius: 20px; padding: 5px;width: fit-content;color: aliceblue;">';
                        echo $cikti['content'];
                        echo '</div>';
                    }
                }
                #}

                ?>
            </div>
            <div class="p-3 pb-0" style="text-align: center;">
                <form action="#" method="POST" style="margin: 0;">
                    <textarea placeholder="<?php echo $strings['message']; ?>" class="form-control" rows="3" name="mes"></textarea>
                    <button type="submit" class="btn btn-primary m-3"><?php echo $strings['submit']; ?></button>
                </form>
            </div>
        </div>
    </div>
    <form action="#" method="post">
        <button type="submit" name="del" class="btn btn-primary m-3"><?php echo $strings['delete']; ?></button>
    </form>

    <?php

    if (isset($_POST['del'])) {
        $q = $db->prepare("DELETE FROM `mandalorian_content`");
        $q->execute();

        header("Location: stored.php");
        exit;
    }
    if (isset($_POST['mes'])) {
        $q = $db->prepare("INSERT INTO mandalorian_content (username,content) VALUES (:username,:message)");
        $q->execute(array(
            "username" => $_SESSION['username'],
            "message" => $_POST['mes'],
        ));
        header("Location: stored.php");
        exit;
    }

    ?>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>