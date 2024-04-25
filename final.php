<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php";
?>

<body>
    <?php
    include "includes/header.php";
    ?>
    <div>
        <h1 style="text-align: center; font-family: 'Fredoka One', cursive;">WIR HABEN IHRE RESERVIERUNG ERHALTEN!</h1>
        <h5 style="text-align: center; font-family: 'Fredoka One', cursive;">Vielen Dank für Ihre Reservierung bei MedCheck!
           <br> Sie können Ihre Bestelldetails im Abschnitt Bestellungen überprüfen</h5>
        <img src="images/final.gif" alt="" style="width:30rem; margin-left: 400px;">
    </div>
    <a href="index.php"> <button style="margin-left: 530px; margin-top: -35px;" type="button" class="btn btn-outline-info btn-lg">Zurück zum Geschäft</button></a>
    <?php
    add_order();
    ?>
    <br>
    <!-- FUSSZEILE -->
    <?php
    include "includes/footer.php"
    ?>

</body>
