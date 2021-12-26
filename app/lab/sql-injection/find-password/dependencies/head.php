<?php
session_start();

if (isset($_SESSION['username'])){
    header("Location: giris.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
      Vulnerability-1

    </title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>

        <div class="container">
            <div class="header-wrapper mt-5">
                <div class="row header-align">
                    <div class="header-left col-md-6">                        
                       
                    </div>

                    <div class="header-right col-md-6">
                        <ul>
                            <li><b><a href="login1.php" target="_blank">Login1</a></b> </li>
                            <li> <b><a href="login2.php"target="_blank">Login2</a></b></li>
                            <li><b><a href="login.php"target="_blank">Login3</a></b> </li>                          
                                                     
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </header>
	

	<form class="login-form">
	<h2>Login</h2>
	<input type="text" class="tbox" placeholder="Enter your e-mail address">
	<input type="password" class="tpbox" placeholder="Enter your password">	
	<input type="button" class="btn" value="Login">


	
</form>
	
</body>
</html>

