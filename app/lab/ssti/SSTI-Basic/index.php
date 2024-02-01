<?php
require("../../../lang/lang.php");
$strings = tr();


try {
    $db = new PDO('sqlite:database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Blog</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container" style="padding-top:5%;">
        <h1 class="mb-2 text-center"><?php echo $strings['welcome']; ?></h1><br>

        <form method="POST" class="text-center">
            <div class="mb-2">
                <label for="content" class="form-label"><?php echo $strings['blog_post']; ?></label>
                <textarea class="form-control" id="content" name="content" rows="6" placeholder="<?php echo $strings['who']; ?>" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit"><?php echo $strings['submit']; ?></button>
        </form><br>
        <?php

        if (isset($_POST['submit'])) {
            try {
                require '../../../public/vendor/autoload.php';
                $loader = new Twig_Loader_String();
                $twig = new Twig\Environment($loader);
                $userInput = strip_tags($_POST["content"]);
                $escapedInput = $twig->render($userInput);
            } catch (Exception $e) {
                echo ('ERROR:' . $e->getMessage());
            }

            $query = "INSERT INTO blog_entries (content) VALUES (:content)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':content', $escapedInput, PDO::PARAM_STR);
            $stmt->execute();
        }


        $query = "SELECT * FROM blog_entries ORDER BY id DESC ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <h2 class="mt-2 text-center"><?php echo $strings['latest_entries']; ?></h2>
        <div id="blogEntries" class="row">
            <?php
            foreach ($entries as $entry) {
                echo '<div class="col-md-12 mb-4">';
                echo '<div class="card shadow">';
                echo '<div class="card-body">';
                echo '<p class="card-text">' . $entry['content'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script id="VLBar" title="<?= $strings["title"]; ?>" category-id="12" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>