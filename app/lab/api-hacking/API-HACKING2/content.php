<?php
require("../../../lang/lang.php");
$strings = tr();

session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once "dbconnect.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT id, content FROM contents WHERE userid = :userid";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userid', $user_id, PDO::PARAM_INT);
$stmt->execute();
$contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>API HACKING</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Optional: Add custom CSS for styling */
        .content-card {
            margin-bottom: 20px;
        }
        .btn-primary a,
.btn-danger a {
    color: white;
}
    </style>
</head>
<body>
    <div class="container">
    <button class="btn btn-danger"><a href="logout.php"><?php echo $strings['logout']; ?></a></button>
<button class="btn btn-primary"><a href="allcontent.php"><?php echo $strings['allcontent']; ?></a></button>

        <h2><?php echo $strings['articles']; ?></h2>
        <div class="row">
            <?php foreach($contents as $content) : ?>
            <div class="col-md-4">
                <div class="card content-card">
                    <div class="card-body">
                        <p class="card-text"><?= $content['content']; ?></p>
                        <a href="edit-content.php?id=<?= $content['id']; ?>" class="btn btn-primary"><?php echo $strings['edit'] ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Add Bootstrap JS (optional, only if you need Bootstrap JS features) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</html>
