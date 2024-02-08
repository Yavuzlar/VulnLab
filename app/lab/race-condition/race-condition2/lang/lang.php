<?php

function getLang() {

$langs = array("en", "tr", "fr", "ar");

if(!isset($_COOKIE["lang"])) {
    $lang = "en";
} else {
    if(in_array($_COOKIE["lang"],$langs)) {
        $lang = $_COOKIE["lang"];
    } else {
        $lang = "en";
    }
    
}

return $lang;

}

function getLangName($langCode) {
    switch ($langCode) {
        case "en":
            return "English";
        case "tr":
            return "Türkçe";
        case "fr":
            return "Français";
        case "ar":
            return "عربي";
        }
        
}

function tr($path = NULL)
{


$lang = getLang();

if(!isset($path)) {
    $path = "./$lang.ini";
} else {
    $path = "$path/$lang.ini";

}

$strings = parse_ini_file($path);
return $strings;


}



?>