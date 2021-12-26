

<?php



try { 
    
    $vt_kullanici_adi="sql_injection";
    $vt_sifre="";
    $vt_sunucu="localhost";
    $vt_adi="sql_injection";


    $mysqli = new mysqli($vt_sunucu,$vt_kullanici_adi,$vt_sifre,$vt_adi);
    mysqli_set_charset($mysqli,"utf8");
    mysqli_error ( $mysqli);

   
    
} catch (PDOException $e) {
    
    echo 'Veri tabanı bağlantı hatası: '.$e;

}
?>

