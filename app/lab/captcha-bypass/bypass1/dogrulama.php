<?php
session_start();

// Kullanıcının girdiği captcha değeri
$userCaptcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';

// Kaydedilmiş captcha değeri
$storedCaptcha = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';
$yusuf;

if ($userCaptcha == $storedCaptcha) {
    $_SESSION['dogrulama'] = true ;
    header("location:/lab/captcha-bypass/bypass1/welcome.php");
 
} else {
    echo "Captcha doğrulanamadı. Lütfen tekrar deneyin.";
}
?>