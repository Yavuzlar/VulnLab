<?php
require("../../../lang/lang.php");
$strings = tr();

session_start();

if (isset($_POST['uname']) && isset($_POST['passwd'])) {
    $db = new PDO('sqlite:database.db');
    $q = $db->prepare("SELECT * FROM users WHERE username=:user AND password=:pass");
    $q->execute(array(
        'user' => $_POST['uname'],
        'pass' => $_POST['passwd']
    ));
    $_select = $q -> fetch();
    
    if ( isset($_select['id'])) {

        session_start();
        $_SESSION['username'] = $_POST['uname'];



        header("Location: user_agent_stored.php");

        exit;
    } else {
        echo '<h1>wrong username or pass</h1>';
    }

}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="shadow p-3 mb-5 rounded column" style="text-align: center; max-width: 1000px;margin-top:15vh;">
            <h4>VULNLAB</h4>

            <form action="#" method="POST" style="text-align: center;margin-top: 20px;padding:30px;">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="uname" id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Pass</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="passwd" id="inputPassword3">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><?= $strings["submit"]; ?></button>
                <p class="mt-3">mandalorian / mandalorian </p>
            </form>


        </div>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>


</body>

</html>