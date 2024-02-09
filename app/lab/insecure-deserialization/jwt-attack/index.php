<?php
    
    require "function.php";
    require("../../../lang/lang.php");
    // setcookie("jwt","",time()-1);
    if(isset($_COOKIE["jwt"])){
        try{
            $decodedJWT = DecodeJWT($_COOKIE["jwt"]);
            
        }catch(Exception $e){
            print_r("Hata");
            header("Location:index.php");
        }
    }
    
    $lang = tr();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["usernameInput"]) && isset($_POST["passwordInput"]) && $_POST["usernameInput"] != "" && $_POST["passwordInput"] != ""){
            
            $username = htmlspecialchars($_POST["usernameInput"]);
            $password = htmlspecialchars($_POST["passwordInput"]);
            
            if($username == "administrator" && $password == "YavuzlarVulnlab"){
                    
                $jwt = CreateJWT($username);
                setcookie("jwt",$jwt);
                header("Location:index.php");
            }else if($username == "Yavuzlar" && $password == "Vulnlab"){
            
                $jwt = CreateJWT($username);

                setcookie("jwt",$jwt);
                header("Location:index.php");
            }

        }
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang["AttackTitle"]?></title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>

<body>
    <a href="https://github.com/danielmiessler/SecLists/blob/master/Passwords/darkweb2017-top100.txt" class="btn btn-primary mt-3 ml-3">Word List</a>
    <?php if(isset($_COOKIE["jwt"]) && $decodedJWT["username"] == "administrator"):?>
        <a href="clearJWT.php" class="btn btn-primary mt-3 ml-3"><?php echo $lang["Cookie"]?></a>
        <div class="d-flex justify-content-center" style="margin-top: 100px;">
            <h1><?php echo $lang["WelcomeAdmin"]?></h1>
        </div>

    <?php elseif(isset($_COOKIE["jwt"]) && $decodedJWT["username"] == "Yavuzlar"):?>
        <a href="clearJWT.php" class="btn btn-primary mt-3 ml-3"><?php echo $lang["Cookie"]?></a>
        <div class="d-flex justify-content-center" style="margin-top: 100px;">
            <h1><?php echo $lang["WelcomeDefault"]?></h1>
        </div>
        
    <?php else:?>
        <div class="d-flex justify-content-center" style="margin-top: 20vh;text-align:center;">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang["Login"]?></h5>
                    <p class="card-text"><?php echo $lang["LoginWith"]?></p>
                    <div class="row">
                        <form method="post">
                            <div>
                                <label for="" class="form-label"><?php echo $lang["Username"]?></label>
                                <input type="text" class="form-control" name="usernameInput">
                            </div>
                            <div>
                                <label for="" class="form-label"><?php echo $lang["Password"]?></label>
                                <input type="password" class="form-control" name="passwordInput">
                            </div>
                            <button class="btn btn-primary mt-3" name="loginButton">
                                <?php echo $lang["Login"]?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="9" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>