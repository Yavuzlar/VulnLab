<?php 
require("../../../lang/lang.php");
$strings = tr();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $strings['weather']; ?></title>
    <!-- Bootstrap CSS dosyasını ekleyin -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $strings['info']; ?></h1>
                        <form action="get-weather.php" method="GET">
                            <div class="form-group">
                                <?php echo $strings['city']; ?>: <input type="text" name="city" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <!-- Butonun class'ını 'btn btn-primary' yaparak primary stile sahip olmasını sağlayın -->
                                <button type="submit" class="btn btn-primary"><?php echo $strings['get_weather']; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>



