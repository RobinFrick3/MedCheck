<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php"
?>

<body>

    <?php

    include "includes/header.php";

    ?>
    <div class="container-fluid ">
        <br><br>
        <div class="row">
            <?php
            $daten = search();
            if (!empty($daten)) {
                $anzahl = sizeof($daten);
                for ($i = 0; $i < $anzahl; $i++) {

            ?>
                    <div class="col-sm-2" id="karten" style="width: 20.45rem; ">
                        <div class="card" style="border: 2px solid #92C5FC;">
                            <img src="images/<?php echo $daten[$i]['bild'] ?>" class="card-img-top" style="width: 300px; height: 300px ;">
                            <div class="card-body">
                                <?php
                                if (strlen($daten[$i]['titel']) <= 20) {
                                ?>
                                    <h5 class="card-title"><?php echo $daten[$i]['titel'] ?></h5>

                                <?php
                                } else {
                                ?>
                                    <h5 class="card-title"><?php echo substr($daten[$i]['titel'], 0, 20) . "..." ?></h5>
                                <?php
                                }
                                ?>
                                <br>
                                <strong>
                                    <h3 style="color :#82E0AA;" class="card-text"> €<?php echo $daten[$i]['preis'] ?></h3>
                                </strong>
                                <br>
                                <small class="text-muted" style="font-weight: bold;">Markenname: <?php echo $daten[$i]['marke'] ?></small><br><br>
                                <a href="product.php?product_id=<?php echo $daten[$i]['produkt_id'] ?>" class="btn btn-outline-info">Weitere Details</a>

                            </div>
                        </div>
                    </div>
                <?php
                }
                unset($daten);
                if ($anzahl < 8) {
                    $daten = all_products();
                    $anzahl = sizeof($daten);

                ?>

                    <h2>Vielleicht gefällt Ihnen auch: </h2>
                    <?php
                    for ($i = 0; $i < $anzahl; $i++) {

                    ?>
                        <div class="col-sm-2" id="karten" style="width: 20.45rem;">
                            <div class="card" style="border: 2px solid #92C5FC;">
                                <img src="images/<?php echo $daten[$i]['bild'] ?>" class="card-img-top" style="width: 300px; height: 300px ;">
                                <div class="card-body">
                                    <?php
                                    if (strlen($daten[$i]['titel']) <= 20) {
                                    ?>
                                        <h5 class="card-title"><?php echo $daten[$i]['titel'] ?></h5>

                                    <?php
                                    } else {
                                    ?>
                                        <h5 class="card-title"><?php echo substr($daten[$i]['titel'], 0, 20) . "..." ?></h5>
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <strong>
                                        <h3 style="color :#82E0AA;" class="card-text"> €<?php echo $daten[$i]['preis'] ?></h3>
                                    </strong>
                                    <br>
                                    <small class="text-muted" style="font-weight: bold;">Markenname: <?php echo $daten[$i]['marke'] ?></small><br><br>
                                    <a href="product.php?product_id=<?php echo $daten[$i]['produkt_id'] ?>" class="btn btn-outline-info">Weitere Details</a>

                                </div>
                            </div>
                        </div>
                <?php
                        if ($i == 3) {
                            break;
                        }
                    }
                }
            } else {
                ?>

                <img src="images/1.gif" style="height: auto; width:auto; margin-left: auto; margin-right: auto;">
                <h2 style="margin-top: 13px;">Vielleicht gefällt Ihnen auch: </h2>
                <?php
                $daten = all_products();
                $anzahl = sizeof($daten);
                for ($i = 0; $i < $anzahl; $i++) {
                ?>
                    <div class="col-sm-2" id="karten" style="width: 20.45rem;">
                        <div class="card" style="border: 2px solid #92C5FC;">
                            <img src="images/<?php echo $daten[$i]['bild'] ?>" class="card-img-top" style="width: 300px; height: 300px ;">
                            <div class="card-body">
                                <?php
                                if (strlen($daten[$i]['titel']) <= 20) {
                                ?>
                                    <h5 class="card-title"><?php echo $daten[$i]['titel'] ?></h5>

                                <?php
                                } else {
                                ?>
                                    <h5 class="card-title"><?php echo substr($daten[$i]['titel'], 0, 20) . "..." ?></h5>
                                <?php
                                }
                                ?>

                                <br>
                                <strong>
                                    <h3 style="color :#82E0AA;" class="card-text"> €<?php echo $daten[$i]['preis'] ?></h3>
                                </strong>
                                <br> <small class="text-muted" style="font-weight: bold;">Markenname: <?php echo $daten[$i]['marke'] ?></small><br><br>
                                <a href="product.php?product_id=<?php echo $daten[$i]['produkt_id'] ?>" class="btn btn-outline-info">Weitere Details</a>

                            </div>
                        </div>
                    </div>
            <?php
                    if ($i == 3) {
                        break;
                    }
                }
            }

            ?>
        </div>
    </div>

    <!-- FUSSZEILE -->
    <?php
    include "includes/footer.php"
    ?>
</body>

</html>
