<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php"
?>

<body>
    <?php
    include "includes/header.php";
    ?>

    </div>
    <!-- PRODUKT-Kopfzeile-->
    <div class="shopping" style="margin: 10px; border-bottom: 4px; font-weight: bold;">
        <h3> Warenkorb</h3>
        <h1 class="border border-1.5" style="width: 100%;"> </h1>
    </div>
    <!-- Ende der PRODUKT-Kopfzeile-->

    <!-- PRODUKTE-->
    <div class="container-fluid">
        <?php
        if (!empty($_SESSION['cart'])) {
            $data = get_cart();
            delete_from_cart();
            $num = sizeof($data);
            for ($i = 0; $i < $num; $i++) {
                if (isset($data[$i])) {
        ?>
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/<?php echo $data[$i][0]['bild'] ?>" class="img-fluid rounded-start" style="margin: 10px; width: 20.45rem; height: 15.45rem; " alt="...">
                            </div>

                            <!--KATALOG FÜR DAS PRODUKT-->
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data[$i][0]['titel'] ?></h5>

                                    <?php if ($data[$i][0]['menge'] > 0) {

                                    ?>
                                        <small style="color: rgb(58, 211, 58);">Auf Lager</small>
                                    <?php
                                    } else {
                                    ?>
                                        <small style="color: red;">Nicht auf Lager</small>

                                    <?php
                                    }
                                    ?>
                                    </p>
                                    <small style="font-weight: bold;">€<?php echo $data[$i][0]['preis'] ?></small><br>
                                    <small class="text-muted" style="font-weight: bold;">Markenname </small>
                                    <small style="color: rgb(80, 223, 80);font-weight: bold;padding:10px ;"><?php echo $data[$i][0]['marke'] ?></small><br>
                                    <small class="text-muted" style="font-weight: bold;">Menge </small>
                                    <small style="color: rgb(80, 223, 80);font-weight: bold;padding:10px ;"><?php echo $_SESSION['cart'][$i]['quantity'] ?></small><br><br>
                                    <a href="cart.php?delete=<?php echo $data[$i][0]['produkt_id'] ?>" class="btn btn-outline-danger">Löschen</a>

                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <!-- Ende der PRODUKTE -->
            <!-- GESAMT -->
            <div class="shopping" style="margin: 10px; border-bottom: 4px; font-weight: bold;">
                <h3> Gesamt </h3>
                <h1 class="border border-1.5" style="width: 100%;"> </h1>
            </div>
            <div style="margin-left: 460px;">
            <br>
                <h5>Gesamt (<?php
                            $total = total_price($data);
                            echo $num . " ";
                            if ($num == 1 or $num == 0) {
                                echo "Artikel";
                            } else {
                                echo "Artikel";
                            } ?>)</h5>

                <br>

            </div>
            <div style="margin-left: 350px; padding-right: 100px;">
                <a href="cart.php?delete_all=1" class="btn btn-outline-danger btn-lg"> Alle Produkte löschen!</a>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="final.php?order=done" class="btn btn-outline-info btn-lg"> &nbsp;Reservieren &nbsp;</a>
                <br><br>
            </div>
        <?php
        } else {
        ?>
            <h1 style="text-align: center; font-family: 'Fredoka One', cursive;">Keine Produkte im Warenkorb</h1>
            <p style="text-align: center; font-family: 'Fredoka One', cursive;">Bitte fügen Sie mindestens ein Produkt zum Kauf hinzu</p>
            <img style="width:46rem; margin-left: 330px;" src="images/nocart.png" alt="">
        <?php
        }
        ?>

    </div>
    <!-- Ende von GESAMT -->
    <!-- FOOTER -->
    <?php
    include "includes/footer.php"
    ?>

</body>

</html>