<?php

require("../../../lang/lang.php");
$strings = tr();

$db = new PDO('mysql:host=localhost; dbname=sql_injection', 'sql_injection', '');

if (isset($_POST['search'])) {
    $search = $_POST['search'];


    try {
        $query = $db->prepare("SELECT * FROM stocks WHERE name = '" . $search . "'");
    } catch (PDOException $e) {
    }
    $query->execute();
    $list = $query->fetch(PDO::FETCH_ASSOC);


    if (!empty($list['name'])) {
        $result = "true";
    } else {
        $result = "false";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $strings['title'] ?></title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>

    <div class="container d-flex justify-content-center flex-column">
        <div class="header-wrapper d-flex justify-content-center" style="margin-top: 20vh;">
            <h1><?php echo $strings['header'] ?></h1>
        </div>
        <div class="body-wapper d-flex justify-content-center mt-5">
            <form action="#" method="POST">
                <div class=" mt-3 fs-5" style="margin-left: 2px;"><?php echo $strings['text'] ?> </div>
                <select class="form-select form-select-lg  mt-2" name="search" style="width: 500px;" id="opt">
                    <option selected><?php echo $strings['selected'] ?></option>
                    <option value="iphone11"><?php echo $strings['select1'] ?></option>
                    <option value="airpodspro"><?php echo $strings['select2'] ?></option>
                    <option value="applewatch7"><?php echo $strings['select3'] ?></option>
                    <option value="iphone6s"><?php echo $strings['select4'] ?></option>
                    <option value="iphone13"><?php echo $strings['select5'] ?></option>
                    <option value="apple20w"><?php echo $strings['select6'] ?></option>
                    <option value="ipad9"><?php echo $strings['select7'] ?></option>
                    <option value="iphonese"><?php echo $strings['select8'] ?></option>
                </select>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning mt-5 "><?php echo $strings['check'] ?></button>
                </div>
            </form>
        </div>
        <?php

        if (!empty($result)) {
            if ($result == "true") {
                echo '<div class="alert-div d-flex justify-content-center mt-5">
                        <div class="alert alert-success text-center" style="width: 500px;" role="alert">';
                echo $strings['success'];
                echo '</div>
                    </div>';
            } else {
                echo '<div class="alert-div d-flex justify-content-center mt-5">
                        <div class="alert alert-danger text-center" style="width: 500px;" role="alert">';
                    
                echo $strings['failed'];
                echo '</div>
                    </div>';
            }
        }
        ?>
    </div>
    <script id="VLBar" title="<?= $strings['title'] ?>" category-id="2" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>