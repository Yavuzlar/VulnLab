<?php
// Veri gönderme işlemi için cURL kullanarak API'ye istek yapılır
function sendRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// API endpoint'i
$apiUrl = "http://localhost/API/api.php";

// HTTP metodu
$method = $_SERVER['REQUEST_METHOD'];

// Kullanıcı güncelleme (PATCH)
if ($method === 'POST') {
    $username = $_POST['username'];
    $newPassword = $_POST['newpassword'];

    // API'ye gönderilecek veriler
    $data = array(
        'username' => $username,
        'newpassword' => $newPassword
    );

    // API'ye istek gönder
    $response = sendRequest($apiUrl, $data);

    // API'den gelen yanıtı ekrana yazdır
    echo $response;
}
?>
