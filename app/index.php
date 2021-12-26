<?php 

include "./config/config.php";
include "./lang/lang.php";
include "./lang/functions.php";
$lang = getLang();
$tr = tr('./lang');
require "./head.php";

$Raw_Json = file_get_contents("./main.json");

$data = json_decode($Raw_Json,true);


?>
<script>
  function setLanguage(lang) {
    document.cookie = "lang="+lang+";path=/";
    location.reload();
  }
</script>
    <!--    Main Content-->
      <section id="labs">
        <div class="container">
          <h1 class="display-6 fw-semi-bold"> <?php echo $tr["vulns"]; ?></h1>
          <p class="fs-2"><?php echo $tr["description"]; ?></p>

          <div class="row mb-4 mt-6">
          <?php foreach ($data as $key=> $val) { ?>
            <div class="col-md-6 mb-4">
              <a href="/vuln/<?=$val['id'] ?>" class="text-decoration-none text-muted">
              <div class=" border rounded-1 border-700 h-100 features-items">
                <div class="p-5">
                <img src="<?=$val['imgURL']; ?>" alt="Dashboard" style="width:48px;height:48px;" />
                  <h3 class="pt-3 lh-base" ><?=$val['title'][$lang]; ?>
                  <span class="badge bg-secondary"><?=count($val["labs"]); ?> lab</span>
                  </h3>
                  <p class="mb-0"><?=$val['description'][$lang]; ?></p>
                </div>
              </div>
            </a>
            </div>
            <?php } ?>  
        </div>
        <!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- <section> begin ============================-->
        <section>

          <div class="container">
            <div class="py-md-3">
              <hr class="mt-1 text-1000" />
            </div>

            <div class="row mx-md-5 px-md-5 d-flex justify-content-evenly">
                  <div class="col-6 col-lg-auto mt-5 mt-lg-0"><img src="public/assets/img/gallery/brands/sibervatangray.png" alt="Yavuzlar" style="height:35px;" /></div>
                  <div class="col-4 col-lg-auto mt-5 mt-lg-0"><img src="public/assets/img/gallery/brands/cyropslogo.png" alt="Cyrops" style="height:35px;" /></div>
                  <div class="col-6 col-lg-auto mt-5 mt-lg-0"><img src="public/assets/img/gallery/brands/yavuzlargray.png" alt="Siber Vatan" style="height:35px;" /></div>
             </div>
          </div>
          <!-- end of .container-->
        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
<?php
  require "./footer.php";
?>