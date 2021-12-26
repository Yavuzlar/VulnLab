<?php
error_reporting(0);
ini_set('display_errors', 0);
include("user.php");
require("../../../lang/lang.php");
$strings = tr();
$user;
$randomNames;


if( isset($_COOKIE['Session']) ){
    
    try{
    $user = unserialize(base64_decode ( $_COOKIE['Session'] ) );
    $randomNames = $user -> generatedStrings;
    if(empty($randomNames))
    array_push($randomNames,"test");

   
    if( is_null($randomNames) ){
        $randomNames = ["test"];
    }

    }catch(Exception $e){
        header("Location: login.php?msg=3");
        exit;
    }
 
    if( isset($_GET['generate'] ) ){
        ob_start();
        array_push($randomNames,$user->getRandomString());
        ob_end_clean();
        $user -> generatedStrings = $randomNames;
        $serializedStr = serialize($user);
        setcookie('Session', base64_encode($serializedStr), time()+3600, '/');

    }
 
    

}else{
    header("Location: login.php?msg=2");
    exit;
}




?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html><html lang='en' class=''>
<head>
<style>
 h1{
    text-align: center;
 }
</style>
<link rel='stylesheet prefetch' href='css/normalize.min.css'><script src='js/prefixfree.min.js'></script>
</head><body>
<div style = "text-align:middle">
<?php
  echo "<h1>";
  echo $strings['welcome-test'];
  echo "</h1>"; 
?>
</div>
<div class="container">
  <h2></h2>     
  <table class="table">
    <thead>
      <tr>
        <th><?= $strings['generated-names'];?></th>
      </tr>
    </thead>
    <tbody>
   <?php foreach( $randomNames as $randomName ){

       echo "<tr>";
       echo "<td>".$randomName."</td>";
       echo "</tr>";
   }
   
   ?>
  
    </tbody>
  </table>

  <div style = "text-align:center;" >
  <form>
  <input value="generate" type ="hidden" name="generate">
<button  type="submit"><?= $strings['generate-nick'];?></button>
</form>
</div>
</div>
</body>
<script id="VLBar" title="<?= $strings['title']; ?>" category-id="9" src="/public/assets/js/vlnav.min.js"></script>
</html>