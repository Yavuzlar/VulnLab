<?php
// Şehir adını al
$city = $_GET['city'];

// Şehir adı boşsa hata döndür
if (empty($city)) {
    echo "Lütfen bir şehir adı girin.";
    exit;
}

// Şehir adına göre hava durumu verisi oluştur
$weatherData = array(
    'city' => $city,
    'temperature' => rand(-10, 40), // Rastgele sıcaklık oluştur
    'description' => 'Parçalı bulutlu', // Sabit bir hava durumu açıklaması
    'humidity' => rand(0, 100), // Rastgele nem oluştur
    'wind_speed' => rand(0, 30) // Rastgele rüzgar hızı oluştur
);

// JSON formatında hava durumu bilgisini döndür
header('Content-Type: application/json');
echo json_encode($weatherData);
?>
