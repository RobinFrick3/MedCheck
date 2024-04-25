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
                    <h2>Produktdetails</h2>
                    <br>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <br>
                    <form class="d-flex" method="GET" action="products.php">
                        <input class="form-control me-2 col" type="search" name="search_item_name" placeholder="Produkt suchen" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit" name="search_item" value="search">Suche</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        <?php
        edit_item($_SESSION['id']);

        if (isset($_GET['edit'])) {
            $_SESSION['id'] = $_GET['edit'];
            $data = get_item($_SESSION['id']);

        ?>
            <br>
            <h2>Produktdetails bearbeiten</h2>
            <form action="products.php" method="POST">
                <div class=" form-group mb-3">
                    <label>Produktname</label>
                    <input pattern="[A-Za-z0-9_]{1,25}" id="exampleInputText1" type="text" class="form-control" placeholder="<?php echo $data[0]['titel'] ?>" name="name">
                    <div class="form-text">Bitte geben Sie den Produktnamen im Bereich von 1-25 Zeichen ein, Sonderzeichen sind nicht erlaubt!</div>
                </div>
                <div class="form-group">
                    <label>Markenname</label>
                    <input pattern="[A-Za-z0-9_]{1,25}" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['marke'] ?>" name="brand">
                    <div class="form-text">Bitte geben Sie den Markennamen im Bereich von 1-25 Zeichen ein, Sonderzeichen sind nicht erlaubt!</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <label class="input-group-text" for="inputGroupSelect01">Kategorie</label>
                    <select name="cat" class="form-select" id="inputGroupSelect01">
                        <option selected>Auswählen...</option>
                        <option value="Medizin">Medizin</option>
                        <option value="Körperpflege">Körperpflege</option>
                        <option value="Maschine">Maschine</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Produkt-Tags</label>
                    <input pattern="^[#.0-9a-zA-Z\s,-]+$" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['schlagworte'] ?>" name="tags">
                    <div class="form-text">Bitte geben Sie Tags für das Produkt im Bereich von 1-250 Zeichen ein, Sonderzeichen sind nicht erlaubt!</div>
                </div>
                <div class="form-group">
                    <label>Produktbild</label>
                    <input type="file" accept="image/*" class="form-control" placeholder="<?php echo $data[0]['bild'] ?>" name="image">
                    <div class="form-text">Bitte geben Sie ein Bild für das Produkt ein.</div>
                </div>
                <div class="form-group">
                    <label>Produktmenge</label>
                    <input type="number" class="form-control" placeholder="<?php echo $data[0]['menge'] ?>" name="quantity" min="1" max="999">
                    <div class="form-text">Bitte geben Sie die Menge des Produkts im Bereich von 1-999 ein.</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <span class="input-group-text">€</span>
                    <input pattern="[0-9]+" id="validationTooltip01" type="text" class="form-control" aria-label="Betrag (auf den nächsten Dollar)" name="price" placeholder="<?php echo $data[0]['item_price'] ?>">
                    <span class="input-group-text">.00</span>
                </div>
                <div class="form-text">Bitte geben Sie den Preis des Produkts ein.</div>
                <div class="form-group">
                    <label for="inputAddress2">Produktdetails</label>
                    <input type="text" class="form-control" placeholder="<?php echo $data[0]['details'] ?>" name="details">
                </div>
                <div class="form-text">Bitte geben Sie die Produktdetails ein.</div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="update">Absenden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="cancel">Abbrechen</button>
                <br> <br>
            </form>
        <?php
        }
        ?>
        <?php
        add_item();
        if (isset($_GET['add'])) {
        ?>
            <br>
            <h2>Produkt hinzufügen</h2>
            <form action="products.php" method="POST">
                <div class=" form-group mb-3">
                    <label>Produktname</label>
                    <input id="exampleInputText1" type="text" class="form-control" placeholder="Produktname" name="name">
                    <div class="form-text">Bitte geben Sie den Produktnamen im Bereich von 1-25 Zeichen ein, Sonderzeichen sind nicht erlaubt!</div>
                </div>
                <div class="form-group">
                    <label>Markenname</label>
                    <input id="validationTooltip01" type="text" class="form-control" placeholder="Markenname" name="brand">
                    <div class="form-text">Bitte geben Sie den Markennamen im Bereich von 1-25 Zeichen ein, Sonderzeichen sind nicht erlaubt!</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <label class="input-group-text" for="inputGroupSelect01">Kategorie</label>
                    <select name="cat" class="form-select" id="inputGroupSelect01">
                        <option value="" selected>Auswählen...</option>
                        <option value="Medizin">Medizin</option>
                        <option value="Körperpflege">Körperpflege</option>
                        <option value="Maschine">Maschine</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Produkt-Tags</label>
                    <input id="validationTooltip01" type="text" class="form-control" placeholder="Produkt-Tags" name="tags">
                    <div class="form-text">Bitte geben Sie Tags für das Produkt im Bereich von 1-250 Zeichen ein, Sonderzeichen sind nicht erlaubt!</div>
                </div>
                <div class="form-group">
                    <label>Produktbild</label>
                    <input type="file" accept="image/*" class="form-control" placeholder="Bild" name="image">
                    <div class="form-text">Bitte geben Sie ein Bild für das Produkt ein.</div>
                </div>
                <div class="form-group">
                    <label>Produktmenge</label>
                    <input type="number" class="form-control" placeholder="Produktmenge" name="quantity" min="1" max="999">
                    <div class="form-text">Bitte geben Sie die Menge des Produkts im Bereich von 1-999 ein.</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <span class="input-group-text">€</span>
                    <input type="text" class="form-control" aria-label="Betrag (auf den nächsten Dollar)" name="price" placeholder="Produktpreis">
                    <span class="input-group-text">.00</span>
                </div>
                <div class="form-text">Bitte geben Sie den Preis des Produkts ein.</div>
                <div class="form-group">
                    <label for="inputAddress2">Produktdetails</label>
                    <input type="text" class="form-control" placeholder="Produktdetails" name="details">
                </div>
                <div class="form-text">Bitte geben Sie die Produktdetails ein.</div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="add_item">Absenden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="cancel">Abbrechen</button>
                <br> <br>
            </form>
        <?php
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Marke</th>
                        <th scope="col">Kategorie</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Bild</th>
                        <th scope="col">Menge</th>
                        <th scope="col">Preis</th>
                        <th scope="col">Details</th>
                        <th>
                        <th>
                            <button type="button" class="btn btn-outline-primary"><a style="text-decoration: none; color:black;" href="products.php?add=1"> &nbsp;&nbsp;Hinzufügen&nbsp;&nbsp;</a></button>
                        </th>
                        </th>

                </thead>

                <tbody>
                    <?php
                        $data = all_items();
                        delete_item();
                        if (isset($_GET['search_item'])) {
                            $query = search_item();
                            if (isset($query)) {
                                $data = $query;
                            } else {
                                get_redirect("products.php");
                            }
                        } elseif (isset($_GET['id'])) {
                            $data = get_item_details();
                        }
                        if (isset($data)) {
                            $num = sizeof($data);
                            for ($i = 0; $i < $num; $i++) {
                                if($data[$i]['verwaltung_id'] == $_SESSION['admin_id']){
                                    ?>
                                    <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $data[$i]['produkt_id'] ?></td>
                                    <td><?php echo $data[$i]['titel'] ?></td>
                                    <td><?php echo $data[$i]['marke'] ?></td>
                                    <td><?php echo $data[$i]['kategorie'] ?></td>
                                    <td><?php echo $data[$i]['schlagworte'] ?></td>
                                    <td><?php echo $data[$i]['bild'] ?></td>
                                    <td><?php echo $data[$i]['menge'] ?></td>
                                    <td><?php echo $data[$i]['preis'] ?></td>
                                    <td><?php echo $data[$i]['details'] ?></td>
                                    <td>
                                        <button type="button" class="btn pull-left btn-outline-warning"><a style="text-decoration: none; color:black;" href="products.php?edit=<?php echo $data[$i]['produkt_id'] ?>">Bearbeiten</a></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn pull-left btn-outline-danger"><a style="text-decoration: none; color:black;" href="products.php?delete=<?php echo $data[$i]['produkt_id'] ?>">Löschen</a></button>
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
    </main>
    </div>
    </div>
    <?php
    include "includes/footer.php"
    ?>
</body>
