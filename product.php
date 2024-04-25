<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php"
?>

<body>
  <?php
  include "includes/header.php";
  $daten = get_item();
  add_cart($_SESSION['product_id']);
  ?>
  <br>
  <div class="container-fluid bg-3 text-center">

    <div class="row">
      <div class="col">
        <img src="images/<?php echo $daten[0]['bild'] ?>" alt="Bild" width="450" height="585">
      </div>
      <div class="col">
        <br>
        <h4 style="font-weight: bold;"><?php echo $daten[0]['titel'] ?><br></h4>
        <br>
        <h1 class="border border-1" style="width: 100%;"> </h1>
        <div class="container">
          <div class="row">
            <div class="col-6 col-sm-4" style="font-weight:bold">Marke</div>
            <div class="col-6 col-sm-4"><?php echo $daten[0]['marke'] ?></div><br>
            <div class="w-100 d-none d-md-block"></div>
            <div class="col-6 col-sm-4" style="padding-top: 20px;font-weight:bold">Kategorie </div>
            <div class="col-6 col-sm-4" style="padding-top: 20px;font-weight: bold"> <?php echo $daten[0]['kategorie'] ?></div>
            <br><br>
          </div>
        </div>
        <h1 class="border border-1" style="width: 100%;  "> </h1>
        <br>
        <h5 style="width: 100%; padding-right: 200px; font-weight: bold;">Über diesen Artikel :</h5>
        <br>
        <p style="font-weight: bold;">
          <?php echo $daten[0]['details'] ?>
        </p>
        </p>
        <h1 class="border border-1" style="width: 100%;  "> </h1>
        <br>
        <p style="font-weight: bold;">
        <?php 
          $pharmacies = get_pharmacies_for_product($daten[0]['titel']);
          if($pharmacy['menge'] < 101){
            $mengenstatus = 'Stückzahl ausreichend';
          } elseif ($pharmacy['menge'] < 51) {
            $mengenstatus = 'Stückzahl wenig';
          } else {
            $mengenstatus = 'Stückzahl wenig';
          }
          if (!empty($pharmacies)) {
            foreach ($pharmacies as $pharmacy) {
              echo "<a href='" . $pharmacy['link'] . "' target='_blank'>" . $pharmacy['name'] . "</a> : " . $mengenstatus . "<br>";
            }
          }
        ?>
        </p>
        <h1 class="border border-1" style="width: 100%;  "> </h1>
      </div>
      <div class="col-sm-4" style="padding-left:5rem;">
        <div class="card" style="width: 18rem;  ">
          <div class="card-body">
            <h5 class="card-title" style="color: rgb(211, 79, 79);"> € <?php echo $daten[0]['preis'] ?></h5>
            <?php if ($daten[0]['menge'] > 0) { ?>

              <h6 style="color: rgb(58, 211, 58);">Auf Lager</h6>
            <?php } else {
              $ausverkauft = 1; ?>
              <small style="color: red;">Ausverkauft</small>

            <?php } ?>
            <p class="card-text">
              <span style="color: blue;">Apotheken in der Nähe :</span>
              <form action="product.php" method="POST">
                <select name="pharmacy" class="form-select" onchange="window.location.href=this.value;">
                  <?php
                    $pharmacies = get_pharmacies_for_product($daten[0]['titel']);
                    if (!empty($pharmacies)) {
                      foreach ($pharmacies as $pharmacy) {
                        $selected = '';
                        if (isset($_GET['product_id']) && $_GET['product_id'] == $pharmacy['produkt']) {
                          $selected = 'selected';
                        }
                        echo "<option value='product.php?product_id=" . $pharmacy['produkt'] . "' $selected>" . $pharmacy['name'] . " - " . $pharmacy['adresse'] . "</option>";
                      }
                    } else {
                      echo "<option value='' disabled>Keine Apotheken gefunden</option>";
                    }
                  ?>
                </select>
                <br>
                <?php if ($ausverkauft != 1) { ?>
                  <div class="form-group">
                    <input value="1" type="number" class="form-control" placeholder="" name="quantity" min="1" max="999">
                  </div>
                  <br>
                  <button type="submit" value="buy" name="buy" class="btn btn-info " style="margin: 5px;">&nbsp; Jetzt reservieren &nbsp;</button>
                  <br>
                  <button type="submit" value="" name="cart" class="btn btn-outline-info " style="margin: 5px;">In den Warenkorb legen</button>
                <?php } ?>
              </form>
            </p>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
  </div>
  <?php
  include "includes/footer.php"
  ?>
</body>

</html>
