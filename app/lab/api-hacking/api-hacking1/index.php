<?php
require("../../../lang/lang.php");
$strings = tr();
session_start();

// Read users json
$usersData = file_get_contents('api/users.json');
$users = json_decode($usersData, true);

// Username and Password Check
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

$foundUser = null;
foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $foundUser = $user;
        break;
    }
}
if ($foundUser) {
    
    $_SESSION['username'] = $foundUser['username'];
    header('Location: dashboard.php');
    exit;
} else {
    $errorMessage = $strings['incorrect'];
}
}
?>

<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Hacking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'api.php',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({ action: 'login', id: $('#username').val(), password: $('#password').val() }),
                success: function(response) {
                    alert(response.error || response.message);
                    if (response.success) {
                        window.location.href = 'dashboard.php';
                    }
                },
                error: function() {
                    alert($strings['requesterr']);
                }
            });
        });
    });
</script>

</head>
<body>

<div class="container mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center"><?php echo($strings['login']); ?></h2>
                <?php if (isset($errorMessage)) { ?>
                    <div class="mb-3 text-center text-danger"><?= $errorMessage ?></div>
                <?php } ?>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label"><?php echo($strings['username']); ?></label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><?php echo $strings['password']; ?></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary"><?php echo $strings['login']; ?></button>
                        <a href="api/all_wallpapers.php" class="btn btn-secondary"><?php echo $strings['allwallpapers']; ?></a>
                    </div>
                    <div class="mb-3 text-center">
                        <h4><?php echo $strings['username']; ?> user</h4>
                        <h4><?php echo $strings['password']; ?> user</h4>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript plugins) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
