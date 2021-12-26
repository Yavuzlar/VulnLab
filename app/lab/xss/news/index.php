<?php
require("../../../lang/lang.php");
$strings = tr();
$db = new PDO('sqlite:hackernews.db');

if (isset($_POST['link'])){
    $ink = $_POST['link'];
    $title = $_POST['title'];
    $ink=htmlspecialchars($ink);
    $title =htmlspecialchars($title);
    //$q=$db->prepare("INSERT INTO links(link) VALUES :link");
    $q=$db->prepare("INSERT INTO links(title,link) VALUES (:title,:link)");
    $q->execute([
        'link'=>$ink,
        'title'=>$title,

    ]);


}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="flaticon.css">
        <style>
          a:hover{
            color:yellow
          };
          
          
        </style>
    <title><?php echo $strings['title'] ?></title>
</head>

<body>
    <div class="container d-flex justify-content-center flex-column mt-4" style="text-align: center; color: aliceblue;">
        <div class="col-md-12 row justify-content-center" style="background-color: #212529;">
            <div class=" d-flex row justify-content-center" style="align-items: center;justify-content: center;">
                <h3 class="m-4">You Can Add News too</h3>
              <form action="#" method="POST">
                <div class="mb-3 row ">
                    <label for="title" class="col-sm-2 col-form-label">News Title</label>
                    <div class="col-md-8 ">
                      <input type="text"  class="form-control" id="title" name="title">
                    </div>
                  </div>
                  <div class="mb-3 row ">
                    <label for="url" class="col-sm-2 col-form-label">News Url</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="url" name="link">
                    </div>
                    <div class="justify-content-center row ">
                        <button type="submit" class="btn btn-primary col-md-4 m-4">Submit</button>
                    </div>
                  </div>
                  </form>
            </div>
        </div>
        <div class="news row col-md-12 mt-5">
        <table class="table table-dark table-hover shadow-lg">
            <thead>
            <tr>
                <th class="pb-4" style="text-align: center;"><h1>#</h1></th>
                <th class="p-4" colspan="1"><h1>News All Around The World</h1></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$i = 1;
$q=$db->query("SELECT * FROM links");

    if ($q) {
        while ($cikti = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<th>' . $i++ . '</th>';
            echo '<td><a href="'.$cikti['link'].'"style="text-decoration: none;">' . $cikti['title'] . '</a></td>';
            echo '<td><a href="" style="text-align: right;text-decoration: none;"><i style="color: aliceblue;margin-right: 5px; " class="flaticon-up-arrow buton"></i></a><a href="" style="text-align: right;text-decoration: none;"><i style="color: aliceblue; " class="flaticon-down-arrow buton"></i></a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<form action="#" method="POST">';
        echo '<button type="submit" class="btn btn-danger" name="del">' . $strings['delete-all'] . '</button>';
        echo '</form>';
        echo '</div>';
    }
if (isset($_POST['del'])) {
    $q = $db->prepare("DELETE FROM links");
    $q->execute();
    header("Location: index.php");
    exit;
}

?>
    </div>
    </div>
    
    <script id="VLBar" title="<?php echo $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>

</body>

</html>