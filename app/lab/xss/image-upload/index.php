<?php
require("../../../lang/lang.php");
$strings = tr();
// DB connection etc.
$db = new PDO('sqlite:database.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$img_pth = $db->prepare("SELECT * FROM images WHERE username=:user");
$img_pth->execute(array(
    'user' => "mandalorian",
));
$path = $img_pth->fetch(PDO::FETCH_ASSOC);
//Uploads and db update
if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "You dont need to upload a shell for this question.";
    $uploadOk = 0;
    }
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //updating database
            $pth_update = $db->prepare("UPDATE images SET path=:pth WHERE username=:user");
            $pth_update->execute(array(
                'pth' => urldecode($target_file),
                'user' => "mandalorian",
            ));
            header("Location: index.php");
            exit;
        } else {
          echo "Sorry, there was an error uploading your file.";
        }}
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings['title']; ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>

    <div class="container">

        <div class="container-wrapper">
            <div class="row pt-5 mt-5 mb-3 d-flex justify-content-center">
                <div class="row col-md-4 text-center d-flex justify-content-center shadow-lg p-3 mb-5 rounded">
                    <img src="<?php echo $path['path'] ?>
                            " style="width: 300px;margin-top: 8px;" class="rounded-circle" alt="" srcset="">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="">
                            <label for="input_image" class="form-label mt-1"><?php echo $strings['text']; ?></label>
                            <input class="form-control" type="file" id="image" name="image">
                            <input class="btn btn-primary mt-2" type="submit" value="<?= $strings['button']; ?>" name="submit">
                        </div>
                    </form>
                    <table class="mt-4 table table-striped table-hover" style="border-radius: 10px;">
                        <thead>
                            <th colspan="2">
                                <h3><?php echo $strings['welcome']; ?> <?php
                                            $q = $db->prepare("SELECT * FROM users WHERE username=:user");
                                            $q->execute(array(
                                                'user' => "mandalorian",
                                            ));
                                            $result = $q->fetch(PDO::FETCH_ASSOC);
                                            echo $result["username"]; ?></h3>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $strings['name']; ?>:</td>
                                <td style="border-left: 1px black solid;">
                                    <?php echo $result["name"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $strings['surname']; ?>:</td>
                                <td style="border-left: 1px black solid;">
                                    <?php echo $result["surname"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $strings['age']; ?>:</td>
                                <td style="border-left: 1px black solid;">
                                    <?php echo $result["age"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $strings['profession']; ?>:</td>
                                <td style="border-left: 1px black solid;">
                                    <?php echo $result["prof"]; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>