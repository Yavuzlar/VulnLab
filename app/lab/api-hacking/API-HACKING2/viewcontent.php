<?php
require("../../../lang/lang.php");
$strings = tr();
require_once "dbconnect.php";

if(isset($_GET['id'])) {
    $content_id = $_GET['id'];
    
    $sql = "SELECT contents.content, users.username 
            FROM contents 
            INNER JOIN users ON contents.userid = users.id
            WHERE contents.id = :content_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT);
    $stmt->execute();
    $content = $stmt->fetch(PDO::FETCH_ASSOC);

    if($content) { 
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card content-card">
            <div class="card-header">
                <?php echo $strings['author'] . $content['username']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $strings['article'] ?></h5>
                <p class="card-text"><?php echo $content['content']; ?></p>
            </div>
        </div>
    </div>
</body>
<script id="VLBar" title="<?= $strings['title'] ?>" category-id="13" src="/public/assets/js/vlnav.min.js"></script>
</html>
<?php
    } else {
        echo $strings['notfound'];
    }
} else {
    echo $strings['missid'];
}
?>
