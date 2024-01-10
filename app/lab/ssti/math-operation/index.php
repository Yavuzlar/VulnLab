<?php   
include './vendor/autoload.php';
require("../../../lang/lang.php");
$strings = tr();
?>
<!DOCTYPE html>
<html lang="<?= $strings['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Blog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h1 class="mb-2 text-center"><?= $strings['welcome']; ?></h1>

        <form method="GET" class="text-center">
            <div class="mb-2">
                <label for="content" class="form-label"><?= $strings['blog_post']; ?></label>
                <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit"><?= $strings['submit']; ?></button>
        </form>

        <h2 class="mt-2 text-center"><?= $strings['latest_entries']; ?></h2>
        <div id="blogEntries" class="text-center">
            <?php
          require 'vendor/autoload.php';

          if (isset($_GET['submit'])) {
              $loader = new Twig_Loader_String();
              $twig = new Twig\Environment($loader);
              $userInput = $_GET["content"];
              $escapedInput = $twig->getFilter('escape')->getCallable()($twig, $userInput);
              echo $twig->render($escapedInput);
          }
          
          ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="11" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>