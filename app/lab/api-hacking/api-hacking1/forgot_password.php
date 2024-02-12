<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnlab</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Forgot Password</h2>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <?php
                    session_start();

                    // Kullanıcı bilgilerini içeren JSON dosyasını oku
                    $usersData = file_get_contents('users.json');
                    $users = json_decode($usersData, true);

                    // Kullanıcı adı ve şifre kontrolü
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $username = $_POST['username'];

                        // Kullanıcı var mı kontrol et
                        $foundUser = null;
                        foreach ($users as $user) {
                            if ($user['username'] === $username) {
                                $foundUser = $user;
                                break;
                            }
                        }

                        if ($foundUser) {
                            $email = $foundUser['email'];
                            echo '<div class="alert alert-success" role="alert">';
                            echo "Şifre sıfırlama bağlantısı $email adresine gönderildi.";
                            echo '</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo "'$username' isimli kullanıcı bulunamadı.";
                            echo '</div>';
                        }
                    }
                ?>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Send Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript plugins) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Your missing script -->
<script>
    $(document).ready(function() {
        $('#forgotPasswordForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'api.php',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({ action: 'forgot_password', username: $('#username').val() }),
                success: function(response) {
                    if (response.error) {
                        // Eğer bir hata varsa
                        $('.alert').removeClass('alert-success').addClass('alert-danger').html(response.message).show();
                    } else {
                        // Başarılı cevap
                        $('.alert').removeClass('alert-danger').addClass('alert-success').html('Şifre sıfırlama bağlantısı ' + response.result + ' adresine gönderildi.').show();
                    }
                },
                error: function() {
                    // AJAX isteği sırasında hata olursa
                    $('.alert').removeClass('alert-success').addClass('alert-danger').html('An error occurred while processing your request.').show();
                }
            });
        });
    });
</script>

</body>
</html>
