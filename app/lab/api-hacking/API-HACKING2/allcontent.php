<?php
require("../../../lang/lang.php");
$strings = tr();

require_once "dbconnect.php";

$sql = "SELECT id, content FROM contents";
$stmt = $pdo->query($sql);
$contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>API HACKING</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2><?php echo $strings['allcontent']; ?></h2>
        <div class="row">
            <?php foreach($contents as $content) : ?>
            <div class="col-md-4">
                <div class="card content-card">
                    <div class="card-body">
                        <p class="card-text"><?= substr($content['content'], 0, 100); ?>...</p>
                        <a href="viewcontent.php?id=<?= $content['id']; ?>" class="btn btn-primary"><?php echo $strings['view']; ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</html>
