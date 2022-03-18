<?php
require "./config/config.php";

function getVuln($vulnID) {
    $Raw_Json = file_get_contents("./main.json");

    $data = json_decode($Raw_Json,true);

    foreach($data as $key=> $val){
        if ($val['id']==$vulnID){
            return $val;
        }
      }

}

function getLabs($vulnID){
    $Raw_Json = file_get_contents("./main.json");

    $data = json_decode($Raw_Json,true);

    foreach($data as $key=> $val){
        if ($val['id']==$vulnID){
            return $val['labs'];
        }
      }
}
function getRes($vulnID){
    $Raw_Json = file_get_contents("./resources.json");

    $data = json_decode($Raw_Json,true);

    foreach($data as $key=> $val){
        if ($val['id']==$vulnID){
            return $val['res'];
        }
      }
}


?>