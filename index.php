<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php"
?>

<body>
  <!----------------         Karussell                     --------->

  <?php

  include "includes/header.php";
  ?>

  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/carousel2.jpg" class="d-block w-100" style="height: 270px;">
      </div>
      <div class="carousel-item">
        <img src="images/carousel3.jpg" class="d-block w-100" style="height: 270px;">
      </div>
      <div class="carousel-item">
        <img src="images/carousel4.jpg" class="d-block w-100" style="height: 270px;">
      </div>
      <div class="carousel-item">
        <img src="images/carousel1.jpg" class="d-block w-100" style="height: 270px;">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Vorherige</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Nächste</span>
    </button>
  </div>
  <!----------------       Ende des Karussells                     --------->
  <div class="container-fluid ">

    <!-- Kategorien-->

    <div class="row" id="cards">
  <div class="col-sm-3">
    <div class="card text-center" style="background-color: #F7F7F7;">
      <div class="card-body">
        <h5 style="font-weight:bold; color: #092435;">Medizinprodukte</h5>
        <a href="search.php?cat=Medikament">
          <img src="images/Medikamente.png" style="height: 100px; width: 100px;" class="d-block mx-auto" alt="...">
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card text-center" style="background-color: #F7F7F7;">
      <div class="card-body">
        <h5 style="font-weight:bold; color: #092435;">Selbstpflegeprodukte</h5>
        <a href="search.php?cat=Medizinprodukt">
          <img src="images/Pflegeprodukte.png" style="height: 100px; width: 100px;" class="d-block mx-auto" alt="...">
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card text-center" style="background-color: #F7F7F7;">
      <div class="card-body">
        <h5 style="font-weight:bold; color: #092435;">Maschinenprodukte</h5>
        <a href="search.php?cat=Gerät">
          <img src="images/Maschine.png" style="height: 100px; width: 100px;" class="d-block mx-auto" alt="...">
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card text-center" style="background-color: #F7F7F7;">
      <div class="card-body">
        <h5 style="font-weight:bold; color: #092435;">Unsere Geschäfte</h5>
        <a href="https://www.google.de/maps/search/apotheken+mannheim/@49.4836492,8.4783884,14.1z?entry=ttu" target="_blank">
          <img src="images/Standort.png" style="height: 100px; width: 100px;" class="d-block mx-auto" alt="...">
        </a>
      </div>
    </div>
  </div>
</div>

    <!----------------         Produkte, die Ihnen gefallen könnten                    --------->

    <h2 style="margin-top: 10px;">Unsere Empfehlungen: </h2>

  <div class="container">
  <div class="row justify-content-center">
    <?php
    $data = all_products();
    $num = sizeof($data);
    for ($i = 0; $i < $num; $i++) {
    ?>
      <div class="col-sm-3 mb-4">
        <div class="card" style="border: 2px solid #92C5FC;">
          <img src="images/<?php echo $data[$i]['bild'] ?>" class="card-img-top" style="width: 300px; height: 300px;">
          <div class="card-body">
            <?php
            $title = $data[$i]['titel'];
            if (strlen($title) > 20) {
              $title = substr($title, 0, 20) . "...";
            }
            ?>
            <h5 class="card-title"><?php echo $title ?></h5>
            <strong>
              <h3 style="color: #82E0AA;" class="card-text"> €<?php echo $data[$i]['preis'] ?></h3>
            </strong>
            <small class="text-muted" style="font-weight: bold;">Markenname: <?php echo $data[$i]['marke'] ?></small><br><br>
            <a href="product.php?product_id=<?php echo $data[$i]['produkt_id'] ?>" class="btn btn-outline-info">Mehr Details</a>
          </div>
        </div>
      </div>
    <?php
      if ($i == 7) {
        break;
      }
    }
    ?>
  </div>
</div>


    <!----------------        Ende der Produkte, die Ihnen gefallen könnten                    --------->
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4" style="padding-left: 20px;">
          <img src="images/Benutzer.svg">
          <h1 style="color:  rgb(47,79,79); font-weight: bold;"> 10 Tausend</h1>
          <h5 style="color:  rgb(47,79,79);">Registrierte Benutzer bis zum April 2024</h5>

        </div>
        <div class="col-sm-4" style="padding-left: 20px; border-bottom-right-radius: 2px;">
          <img src="images/Bestellungen.svg">
          <h1 style="color:  rgb(47,79,79); font-weight: bold;"> 100.000 Reservierungen</h1>
          <h5 style="color:  rgb(47,79,79);">MedCheck Bestellungen im ersten Geschäftsjahr</h5>
        </div>
        <div class="col-sm-4" style="padding-left: 60px;">
          <img src="images/Medikamente.svg">
          <h1 style="color:  rgb(47,79,79); font-weight: bold;"> ÜBER 200</h1>
          <h5 style="color:  rgb(47,79,79);">Partnerschaften mit Apotheken</h5>
        </div>
      </div>
    </div>
    <h1 class="border border-2" style="width: 100%;"> </h1>
  </div>
  <!-- FOOTER -->
  <?php
  include "includes/footer.php"
  ?>
</body>

</html>