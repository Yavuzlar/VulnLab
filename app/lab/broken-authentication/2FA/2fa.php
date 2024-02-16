<?php
require("../../../lang/lang.php");
$strings = tr();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEnteredCode = $_POST['verification_code'];

    if (isset($_SESSION['2fa_code']) && isset($_SESSION['attempts'])) {
        $correctCode = $_SESSION['2fa_code'];
        $attempts = $_SESSION['attempts'];

        if ($userEnteredCode == $correctCode) {
            // Doğrulama kodu doğruysa, admin sayfasına yönlendir.
            header('Location: admin.php');
            exit();
        } else {
            // Doğrulama kodu hatalı, deneme sayısını arttır.
            $attempts++;

            // 3 deneme hakkını aştıysa, index.php sayfasına yönlendir.
            if ($attempts >= 3) {
                header('Location: index.php');
                exit();
            }

            // Hatalı giriş sayısını oturumda sakla.
            $_SESSION['attempts'] = $attempts;
            $errorMessage = 'Doğrulama kodu hatalı! Kalan deneme hakkınız: ' . (3 - $attempts);
        }
    } else {
        // Oturum bilgileri eksikse, index.php sayfasına yönlendir.
        header('Location: index.php');
        exit();
    }
} else {
    // Sayfa ilk defa yüklendiğinde deneme sayısını sıfırla.
    $_SESSION['attempts'] = 0;

    // Yeni 2FA kodu oluştur ve kullanıcıya göster.
    $newCode = rand(10000, 99999);
    $_SESSION['2fa_code'] = $newCode;
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $strings["twofa"]; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5"style="padding-top:5%;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-auto">
                    <div class="card-header bg-primary text-white text-center">
                        <h2><?= $strings["twofa"]; ?></h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($errorMessage)) : ?>
                            <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
                        <?php else : ?>
                            <p class="text-center"><?= $strings["kod"]; ?></p>
                        <?php endif; ?>
                        <form action="2fa.php" method="post">
                            <div class="mb-3">
                                <label for="verification_code" class="form-label"><?= $strings["dogk"]; ?></label>
                                <input type="text" id="verification_code" name="verification_code" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= $strings["dog"]; ?></button>
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