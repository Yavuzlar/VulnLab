<?php
require("../../../lang/lang.php");
$strings = tr();
session_start();
session_unset();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifre doğrulaması yapılır (örneğin sadece admin ve admin olarak kabul ediliyor)
    if ($username === 'admin' && $password === 'admin') {
        $randomCode = rand(10000, 99999);

        // 2FA doğrulama kodu kullanıcıya gönderilir (örneğin burada oturumda saklanıyor)
        $_SESSION['2fa_code'] = $randomCode;
        $_SESSION['username'] = $username;

        // 2FA doğrulama sayfasına yönlendirme yapılır
        header('Location: 2fa.php');
        exit();
    } else {
        $errorMessage = 'Kullanıcı adı veya şifre hatalı!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings["login"]; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="padding-top:5%;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-auto">
                    <div class="card-header bg-primary text-white text-center">
                        <h2><?= $strings["login"]; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <?php if (isset($errorMessage)) : ?>
                                <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
                            <?php endif; ?>
                        </div>
                        <form action="index.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label"><?= $strings["ka"]; ?></label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><?= $strings["pass"]; ?></label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <p class="text-center"><?= $strings["not"]; ?></p>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= $strings["submit"]; ?></button>
                        </form>
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