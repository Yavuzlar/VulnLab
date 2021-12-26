<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--    Document Title-->
  <title>VulnLab</title>
  <!--    Favicons-->
  <link rel="shortcut icon" type="image/x-icon" href="/public/assets/img/favicons/favicon.png">
  <!--    Stylesheets-->
  <link rel="stylesheet" crossorigin="anonymous"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==">
  <link href="/public/assets/css/theme.css" rel="stylesheet" />
  <link href="/public/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>

<body>
  <main class="main" id="top">
    <!-- NAV START -->
    <nav class="navbar navbar-light sticky-top" data-navbar-darken-on-scroll="900">
      <div class="container"><a class="navbar-brand" href=""> <img
            src="/public/assets/img/gallery/logo.png" alt="..." /></a>
        <div class="navbar-nav ms-auto">
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <?php

      echo '<img src="/public/assets/img/'.$lang.'.png" style="width: 26px; margin-right:5px;" /> '.getLangName($lang).'';
    
    ?>
  </button>
  <ul class="dropdown-menu position-absolute w-100" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#" onclick="setLanguage('en')"><img src="/public/assets/img/en.png" style="width: 26px; margin-right:5px;" />English </a></li>
    <li><a class="dropdown-item" href="#" onclick="setLanguage('tr')"><img src="/public/assets/img/tr.png" style="width: 26px; margin-right:5px;" />Türkçe </a></li>
    <li><a class="dropdown-item" href="#" onclick="setLanguage('fr')"><img src="/public/assets/img/fr.png" style="width: 26px; margin-right:5px;" />Français </a></li>
  </ul>
</div>

        </div>
      </div>
    </nav>

        <!-- NAV END -->