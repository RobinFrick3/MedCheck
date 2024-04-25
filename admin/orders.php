<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php";
?>

<body>
    <?php
    include "includes/header.php"
    ?>


    <?php
    include "includes/sidebar.php";
    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php
        message();
        ?>
        <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <br>
                    <h2>Bestelldetails</h2>
                    <br>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <br>
                    <form class="d-flex" method="GET" action="orders.php">
                        <input class="form-control me-2 col" type="search" name="search_order_id" placeholder="Nach Bestellung suchen (ID)" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit" name="search_order" value="search">Suche</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Benutzer-ID</th>
                        <th scope="col">Produkt-ID</th>
                        <th scope="col">Produktmenge</th>
                        <th scope="col">Bestelldatum</th>
                        <th scope="col">Bestellstatus</th>
                </thead>

                <tbody>
                    <?php
                    $data = all_orders();
                    $data2 = all_items();
                    delete_order();
                    if (isset($_GET['search_order'])) {
                        $query = search_order();
                        if (!empty($query)) {
                            $data = $query;
                        } else {
                            get_redirect("orders.php");
                        }
                    }
                    $num = sizeof($data);
                    for ($i = 0; $i < $num; $i++) {
                        for($j = 0; $j < sizeof($data2); $j++){
                            if($data2[$j]['produkt_id'] == $data[$i]['produkt_id'] && $data2[$j]['verwaltung_id'] == $_SESSION['admin_id']){
                                ?>
                                <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $data[$i]['bestell_id'] ?></td>
                                <td><?php echo $data[$i]['benutzer_id'] ?></td>
                                <td><?php echo $data[$i]['produkt_id'] ?></td>
                                <td><?php echo $data[$i]['menge'] ?></td>
                                <td><?php echo $data[$i]['bestelldatum'] ?></td>
                                <?php 
                                    if ($data[$i]['status'] == 1) {
                                ?>
                                    <td style="color: green;">
                                        Versandt
                                    </td>
                                <?php
                                } else {
                                ?>
                                <td style="color: red;">
                                    Ausstehend
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                                <button type="button" class="btn  btn-outline-danger"><a style="text-decoration: none; color:black;" href="orders.php?delete=<?php echo $data[$i]['bestell_id'] ?>">Löschen</a></button>
                            </td>

                            <?php if ($data[$i]['status'] == 1) {
                            ?>
                                <td>
                                    <button type="button" class="btn  btn-outline-danger"><a style="text-decoration: none; color:black;" href="orders.php?undo=<?php echo $data[$i]['bestell_id'] ?>">&nbsp;Rückgängig machen&nbsp;</a></button>
                                </td>
                            <?php
                            } else {
                            ?>
                                <td>
                                    <button type="button" class="btn  btn-outline-success"><a style="text-decoration: none; color:black;" href="orders.php?done=<?php echo $data[$i]['bestell_id'] ?>">&nbsp;Erledigt&nbsp;</a></button>

                                </td>
                            <?php
                            }
                            ?>
                            <td>
                                <button type="button" class="btn  btn-outline-info"><a style="text-decoration: none; color:black;" href="customers.php?id=<?php echo $data[$i]['benutzer_id'] ?>"> &nbsp;Benutzerdetails&nbsp; </a></button>
                            </td>
                            <td>
                                <button type="button" class="btn  btn-outline-info"><a style="text-decoration: none; color:black;" href="products.php?id=<?php echo $data[$i]['produkt_id'] ?>">Produktdetails</a></button>

                            </td>
                            </tr>
                            <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br><br>
        <?php
        edit_admin($_SESSION['admin_id']);
        if (isset($_GET['edit'])) {
            $_SESSION['admin_id'] = $_GET['edit'];
            $data = get_admin($_SESSION['admin_id']);

        ?>
            <br>
            <h2>Admin-Details bearbeiten</h2>
            <form action="admin.php" method="POST">
                <div class="form-group">
                    <label>Vorname</label>
                    <input pattern="[A-Za-z_]{1,15}" type="text" class="form-control" placeholder="<?php echo $data[0]['vorname'] ?>" name="vorname">
                    <div class="form-text">Bitte geben Sie den Vornamen im Bereich von 1-30 Zeichen ein, Sonderzeichen & Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="validationTooltip01">Nachname</label>
                    <input pattern="[A-Za-z_]{1,15}" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['nachname'] ?>" name="nachname">
                    <div class="form-text">Bitte geben Sie den Nachnamen im Bereich von 1-30 Zeichen ein, Sonderzeichen & Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail-Adresse</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $data[0]['email'] ?>" name="email">
                    <div class="form-text">Bitte geben Sie die E-Mail-Adresse im Format ein: beispiel@gmail.com.</div>
                </div>
                <button type="submit" class="btn btn-outline-primary" value="update" name="admin_update">Absenden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="admin_cancel">Abbrechen</button>
                <br> <br>
            </form>

        <?php
        }
        add_admin();
        if (isset($_GET['add'])) {

        ?>
            <h2>Neuen Administrator hinzufügen</h2>
            <form action="admin.php" method="POST">
                <div class="form-group">
                    <label>Vorname</label>
                    <input pattern="[A-Za-z_]{1,15}" type="text" class="form-control" placeholder="Vorname" name="admin_fname">
                    <div class="form-text">Bitte geben Sie den Vornamen im Bereich von 1-30 Zeichen ein, Sonderzeichen & Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="validationTooltip01">Nachname</label>
                    <input pattern="[A-Za-z_]{1,15}" id="validationTooltip01" type="text" class="form-control" placeholder="Nachname" name="admin_lname">
                    <div class="form-text">Bitte geben Sie den Nachnamen im Bereich von 1-30 Zeichen ein, Sonderzeichen & Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail-Adresse</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail-Adresse" name="admin_email">
                    <div class="form-text">Bitte geben Sie die E-Mail-Adresse im Format ein: beispiel@gmail.com.</div>
                </div><br>
                <div class="form-group">
                    <label for="exampleInputPassword1">Passwort</label>
                    <input type="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" class="form-control" placeholder="Passwort" name="admin_password">
                    <div class="form-text">
                        <ul>
                            <li>Muss mindestens 8 Zeichen lang sein</li>
                            <li>Muss mindestens 1 Zahl enthalten</li>
                            <li>Muss mindestens ein Großbuchstabe enthalten</li>
                            <li>Muss mindestens ein Kleinbuchstabe enthalten</li>
                        </ul>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="add_admin">Absenden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="admin_cancel">Abbrechen</button>
                <br> <br>
            </form>

        <?php
        }

        ?>
    </main>
    </div>
    </div>
    <?php
    include "includes/footer.php"
    ?>
</body>
