<?php
require("../../../lang/lang.php");
$strings = tr();

require 'conn.php';
$verificationCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

$query = $conn->prepare("INSERT INTO shopMessage(content,corner) VALUES (?,?)");
$query->execute(array(
    $verificationCode,
    0,
));


?>

<head>
    <meta charset="UTF-8">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $strings['title']; ?></title>
    <style>
        .showbox {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 200px;
            display: none;
            z-index: 1000;
        }


        .showbox .alert {
            margin-bottom: 0;
        }
    </style>
</head>

<body style="background-color: #F8F9FD;">

    <div class="d-flex justify-content-center align-items-center container " style="margin-top: 150px; ">
        <div class="card py-4 px-3">
            <div>
                <a href="messageBox.php" class="btn mb-3" style="background-color: #7ca8a6; color:#F8F9FD;" target="_blank"><?php echo $strings['message_box_txt']; ?></a>
            </div>

            <h5 class="d-flex justify-content-center align-items-center"><?php echo $strings['3D_title']; ?></h5>
            <span class="mobile-text"><?php echo $strings['3D_detail']; ?> <b style="color: #db6464;"><?php echo $strings['3D_number']; ?></b></span>

            <form action="code.php?hesoyam=JGJhbGFuY2U9MTAw" method="POST" autocomplete="off">
                <div class="d-flex justify-content-center align-items-center flex-row mt-5">
                    <input type="text" class="input-box" name="inputCode" required>
                </div>
                <div class="text-center mt-5"><span class="d-block mobile-text"><?php echo $strings['3D_ask']; ?></span>
                    <a href="verify.php" class="btn" style="background-color: #db6464; color:#F8F9FD;"><?php echo $strings['resend_button']; ?></a>
                    <button type="submit" class="btn" style="background-color: #99B19C; color:#F8F9FD;"><?php echo $strings['submit_button']; ?></button>
                </div>
            </form>
        </div>
    </div>
    <!---------------------------------------------- Alert Func -------------------------------------------------->

    <div class="showbox" id="notification">
        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $strings['alert_error']; ?>
            </div>
        <?php } elseif (isset($_GET['mess']) && $_GET['mess'] == 'wrongCode') { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $strings['alert_wrongCode']; ?>
            </div>
        <?php } ?>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var notificationDiv = document.getElementById("notification");
            if (notificationDiv.children.length > 0) {
                notificationDiv.style.display = "block";
                setTimeout(function() {
                    notificationDiv.style.display = "none";
                }, 5000);
            }
        });
    </script>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="3" src="/public/assets/js/vlnav.min.js"></script>
</body>