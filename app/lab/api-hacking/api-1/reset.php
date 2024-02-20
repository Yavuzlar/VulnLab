<?php
// main.json dosyasındaki kullanıcı bilgilerini varsayılan değerlere geri döndürmek için

// Varsayılan kullanıcı adı ve şifreleri tanımlayın
$defaultUsers = array(
    array("username" => "admin", "password" => "admin"),
    array("username" => "user", "password" => "user")
);

// JSON formatına dönüştürün
$defaultData = json_encode($defaultUsers, JSON_PRETTY_PRINT);

// main.json dosyasına yazın
file_put_contents('main.json', $defaultData);

// Index sayfasına yönlendirin
header("Location: index.php");
exit;
