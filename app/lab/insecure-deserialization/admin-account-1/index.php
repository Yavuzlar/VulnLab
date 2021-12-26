<?php
 
include("user.php");
require("../../../lang/lang.php");
$strings = tr();
error_reporting(0);
ini_set('display_errors', 0);

if( isset($_COOKIE['V2VsY29tZS1hZG1pbgo']) ){
    try{
    $user = unserialize( base64_decode( $_COOKIE['V2VsY29tZS1hZG1pbgo'] ));
    }catch(Exception $e){
        header("Location: login.php?msg=3");
        exit;
    } 
    $text = "";
    if( $user->username === "admin"){
        $text = $strings['welcome-admin'];
    } else if ( $user->username === "test"){
        $text = $strings['welcome-test'];
    }else{
        $text =  $strings['welcome-another'];
    }

}else{
    header("Location: login.php?msg=2");
    exit;
}

?>


 
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html><html lang='en' class=''>
<head>
<style>
h1{
    text-align: center;
 }
</style>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 
</head><body>

<?php echo '<h2 style="text-align: center; color:red; margin-top: 100px;">'.$text.'</h2>'; ?>

</body>
<script id="VLBar" title="<?= $strings['title']; ?>" category-id="9" src="/public/assets/js/vlnav.min.js"></script>
</html>