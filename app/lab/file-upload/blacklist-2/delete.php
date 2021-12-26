<?php

$uploads = glob('uploads/*');

foreach($uploads as $upload){
   if( is_file($upload) ){
      unlink($upload);
   }
}

header("Location: index.php");
exit;

?>