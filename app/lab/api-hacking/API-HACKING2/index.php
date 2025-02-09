<?php
require("../../../lang/lang.php");
$strings = tr();

session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: content.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "dbconnect.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: content.php");
        exit;
    } else {
        $error = $strings['loginerror'];
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>API HACKING</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Stil düzenlemeleri */
        .container {
            margin-top: 50px; /* Formun sayfanın ortasında olması için boşluk bırak */
        }
        .card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .card-body {
            width: 100%;
        }
        .btn-primary {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username"><?php echo $strings['username'];?>:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo $strings['password'];?>:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group text-center">
                                <h3><?php echo $strings['username'];?>: user1</h3>
                                <h3><?php echo $strings['password'];?>: password1</h3>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $strings['login'];?></button>
                        </form>
                        <?php if(isset($error)) { echo '<div class="alert alert-danger mt-3" role="alert">' . $error . '</div>'; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS ve jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>







