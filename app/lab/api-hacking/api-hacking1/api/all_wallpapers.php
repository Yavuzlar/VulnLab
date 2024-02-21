<?php
$uploadDirectory = '../api/uploads/';
$images = scandir($uploadDirectory);

$images = array_diff($images, array('..', '.'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Hacking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <p></p>
    <div class="row">
        <?php foreach ($images as $image) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= $uploadDirectory . $image ?>" class="card-img-top" alt="<?= $image ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $image ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-3">
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript plugins) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
