<?php
    ob_start();
    session_start();
    
    $_SESSION['authority'] = "user";
    
    $db = new PDO('sqlite:database.db');
    
    require("../../../lang/lang.php");
    $strings = tr();
    
    $selectFollowers = $db -> prepare("SELECT * FROM csrf_follow WHERE follow_status=:follow_status");
    $selectFollowers -> execute(array('follow_status' => 'true'));
    $selectFollowers_Infos = $selectFollowers -> fetchAll(PDO::FETCH_ASSOC);
    
    sleep(1);
    
    $id = 1;
    foreach($selectFollowers_Infos as $selectFollowers_Info){
        echo '<tr class="text-center">
        <th scope="row">'.$id.'</th>
        <td>'.$selectFollowers_Info['authority'].'</td>
        </tr>';
        $id++;
    }

?>