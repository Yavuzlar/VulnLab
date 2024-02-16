<?php
    setcookie("jwt","",time()-1);
    header("Location:index.php");
    exit();
?>