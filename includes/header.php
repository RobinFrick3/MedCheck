<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #92C5FC;">
        <div class="container-fluid">
            <a href="index.php"> <img src="images/MedCheck-Logo.png" id="image"></a>
            <a href="index.php"> <img src="images/MedCheck-Name.png" id="image"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" style="color: white; " aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php" style="color: white; font-size:bold;">Startseite</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" style="color: white; font-size:bold;">Warenkorb</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " style="color: white; font-size:bold;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategorien
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="color: white; font-size:bold;">
                            <li><a class="dropdown-item " href="search.php?cat=Medikament">Medizin</a></li>
                            <li><a class="dropdown-item" href="search.php?cat=Zubehör">Selbstpflege</a></li>
                            <li><a class="dropdown-item" href="search.php?cat=Gerät">Maschinen</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index.php" style="color: white; font-size:bold;">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consult.php" style="color: white; font-size:bold;">Beratung</a>
                    </li>
                </ul>
                <?php

                if (!isset($_SESSION['user_id'])) {
                    echo "<a class='nav-link' href='login.php' style='color: white; font-size:bold;'>Anmelden</a>";
                } else {
                    $check_user_id = check_user($_SESSION['user_id']);
                    if ($check_user_id == 1) {
                        echo "<a class='nav-link' href='logout.php' style='color: white; font-size:bold;'>Abmelden</a>  ";
                    } else {
                        post_redirect("logout.php");
                    }
                }
                ?>


                <form class="d-flex" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Suchen" name="search_text">
                    <button class="btn btn-outline-light" type="submit" value="go" name="search"><i class="fas fa-search"></i></button>
                </form>

            </div>
        </div>
    </nav>
</header>
