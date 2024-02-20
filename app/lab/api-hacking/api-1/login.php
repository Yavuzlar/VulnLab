<?php

// POST isteğini kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı ve şifreyi POST verilerinden al
    $username = $_POST['username'];
    $password = $_POST['password'];

    // main.json dosyasını oku ve içeriği al
    $data = file_get_contents('main.json');
    $users = json_decode($data, true);

    // Kullanıcıları kontrol et
    foreach ($users as $user) {
        // Kullanıcı adı ve şifre eşleşirse
        if ($user['username'] === $username && $user['password'] === $password) {
            // Kullanıcı yönlendirme yap
            if ($username == 'admin') {
                header("Location: adminindex.php");
                exit();
            } elseif ($username == 'user') {
                header("Location: userindex.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }
    // Eğer eşleşme yoksa tekrar login sayfasına yönlendir
    header("Location: index.php");
    exit();
}

