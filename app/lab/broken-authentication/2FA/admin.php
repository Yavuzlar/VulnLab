<?php
require("../../../lang/lang.php");
$strings = tr();

session_start();
if ($_SESSION['username'] == '') { 
    header('Location: index.php');
    exit();
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sayfası</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="padding-top:5%;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-auto">
                    <div class="card-header bg-primary text-white text-center">
                        <h2><?php echo $strings['admin']; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading"><?php echo $strings["wel"]; ?>, <?= $_SESSION['username']; ?>!</h4>
                            <p><?php echo $strings["inp"]; ?></p>
                            <hr>
                            <p class="mb-0"><?php echo $strings["inp2"]; ?></p>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <form method="post" action="">
                            <button type="submit" name="logout" class="btn btn-danger"><?php echo $strings["logout"]; ?></button>
                        </form>
                        &copy; <?php echo $strings["bos"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="10" src="/public/assets/js/vlnav.min.js"></script>

    <!-- Bootstrap JS ve Popper.js (JavaScript kütüphaneleri) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
