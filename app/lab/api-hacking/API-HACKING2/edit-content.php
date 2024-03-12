<?php
require("../../../lang/lang.php");
$strings = tr();

session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once "dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $content_id = $_POST['content_id'];
    $content = $_POST['content'];

    $sql = "UPDATE contents SET content = :content WHERE id = :content_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: content.php");
    exit;
}

$content_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$sql = "SELECT content FROM contents WHERE id = :content_id AND userid = :userid";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT);
$stmt->bindParam(':userid', $user_id, PDO::PARAM_INT);
$stmt->execute();
$content = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$content) {
    echo $strings['contentnotfound'];
    exit;
}
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
        <h2><?php echo $strings['editarticle']; ?></h2>
        <form method="post" action="">
            <input type="hidden" name="content_id" value="<?= $content_id; ?>">
            <div class="form-group">
                <label for="content"><?php echo $strings['content']; ?>:</label>
                <textarea class="form-control" id="content" name="content" rows="5"><?= $content['content']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $strings['save'] ?></button>
        </form>
    </div>

    <!-- Add Bootstrap JS (optional, only if you need Bootstrap JS features) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>

